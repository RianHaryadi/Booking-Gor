<?php

namespace App\Http\Controllers;

use App\Models\LapanganMode;
use App\Models\Turnamen;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());
        $durasi = $request->input('durasi', 2);

        $parsedDate = Carbon::parse($tanggal)->setTimezone('Asia/Jakarta')->startOfDay();

        $maxDate = Carbon::today()->addDays(30)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('home', ['tanggal' => Carbon::today()->toDateString(), 'durasi' => $durasi])
                            ->with('error', 'Tanggal tidak boleh lebih dari 30 hari ke depan.');
        }

        $tournaments = Turnamen::latest()->take(4)->get();
        $allTournaments = $tournaments;
    
        $allFields = LapanganMode::all();

        $fields = LapanganMode::orderBy('rating', 'desc')->take(4)->get();

        $bookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->whereIn('lapangan_mode_id', $allFields->pluck('id'))
            ->whereIn('status', ['booked', 'pending'])
            ->select('lapangan_mode_id', 'jam_mulai', 'jam_selesai', 'nama_pemesan', 'nomor_telepon', 'email', 'total_harga', 'kode_booking', 'metode_pembayaran', 'durasi', 'status')
            ->get();

        $allFields->each(function ($field) use ($tanggal, $bookings, $durasi) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $tanggal, $bookings, $durasi);
        });

        return view('home', compact('tournaments', 'fields', 'allTournaments', 'allFields', 'tanggal', 'durasi'));
    }

    private function getAvailableTimeSlots($field, $date, $allBookingsForDate, $requestedDurasi = 2)
    {
        $slots = [];
        $startHour = 8;
        $endHour = 22;
        $displayInterval = 2;

        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();
        $fieldBookings = $allBookingsForDate->where('lapangan_mode_id', $field->id);

        for ($hour = $startHour; $hour < $endHour; $hour += $displayInterval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $displayInterval);
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            $booking = $fieldBookings->first(function ($existingBooking) use ($startTime, $endTime) {
                $bookingStartTime = \Carbon\Carbon::parse($existingBooking->jam_mulai)->format('H:i:s');
                $bookingEndTime = \Carbon\Carbon::parse($existingBooking->jam_selesai)->format('H:i:s');
                return $bookingStartTime < $endTime && $bookingEndTime > $startTime;
            });

            $status = 'available';
            if ($booking) {
                if (strpos($booking->nama_pemesan, 'TOURNAMENT:') === 0) {
                    $status = 'event';
                } else {
                    $status = $booking->status;
                }
            } elseif ($parsedDate->isToday() && $slotStart->isPast()) {
                $status = 'soon';
            }

            $slots[] = [
                'time' => substr($startTime, 0, 5),
                'end_time' => substr($endTime, 0, 5),
                'status' => $status,
                'nama_pemesan' => $booking ? $booking->nama_pemesan : null,
                'nomor_telepon' => $booking ? $booking->nomor_telepon : null,
                'email' => $booking ? $booking->email : null,
                'total_harga' => $field->original_price * ($requestedDurasi / 2),
                'kode_booking' => $booking ? $booking->kode_booking : null,
                'metode_pembayaran' => $booking ? $booking->metode_pembayaran : null,
                'durasi' => $requestedDurasi,
            ];
        }

        return $slots;
    }
}