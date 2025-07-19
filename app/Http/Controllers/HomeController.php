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
        // Set locale for Carbon
        Carbon::setLocale('id');

        // Get selected date, default to today
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());
        $parsedDate = Carbon::parse($tanggal)->setTimezone('Asia/Jakarta')->startOfDay();

        // Redirect to next day if selected date is Sunday
        if ($parsedDate->isSunday()) {
            $tanggal = Carbon::tomorrow()->toDateString();
            $parsedDate = Carbon::tomorrow()->startOfDay();
            return redirect()->route('home', ['tanggal' => $tanggal])
                            ->with('warning', 'GOR tutup pada hari Minggu. Menampilkan jadwal untuk ' . $parsedDate->translatedFormat('l, d F Y') . '.');
        }

        // Validate date is within 7 days
        $maxDate = Carbon::today()->addDays(7)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('home', ['tanggal' => Carbon::today()->toDateString()])
                            ->with('error', 'Tanggal tidak boleh lebih dari 7 hari ke depan.');
        }

        // Fetch all upcoming tournaments and take top 4
        $allTournaments = Turnamen::where('status', 'upcoming')
            ->where('tanggal_mulai', '>=', Carbon::today())
            ->orderBy('tanggal_mulai')
            ->get();
        $tournaments = $allTournaments->take(4);

        // Fetch all fields
        $allFields = LapanganMode::all();
        $fields = LapanganMode::orderBy('rating', 'desc')->take(4)->get();

        // Fetch bookings for the selected date
        $bookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->whereIn('lapangan_mode_id', $allFields->pluck('id'))
            ->whereIn('status', ['booked', 'pending'])
            ->select('lapangan_mode_id', 'jam_mulai', 'jam_selesai', 'nama_pemesan', 'nomor_telepon', 'email', 'total_harga', 'kode_booking', 'metode_pembayaran', 'durasi', 'status')
            ->get();

        // Add available time slots to each field
        $allFields->each(function ($field) use ($tanggal, $bookings) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $tanggal, $bookings);
        });

        return view('home', compact('tournaments', 'fields', 'allTournaments', 'allFields', 'tanggal'));
    }

    private function getAvailableTimeSlots($field, $date, $bookings)
    {
        $slots = [];
        $startHour = 8; // 8:00 AM
        $endHour = 22;  // 10:00 PM
        $interval = 2;  // 2-hour slots

        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();
        $fieldBookings = $bookings->where('lapangan_mode_id', $field->id);

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $interval);
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            // Check if the slot is booked
            $booking = $fieldBookings->first(function ($booking) use ($slotStart, $slotEnd) {
                $bookingStart = Carbon::parse($booking->jam_mulai);
                $bookingEnd = Carbon::parse($booking->jam_selesai);
                return $bookingStart->lte($slotEnd) && $bookingEnd->gte($slotStart);
            });

            $status = $booking ? $booking->status : 'available';
            $slots[] = [
                'time' => substr($startTime, 0, 5),
                'end_time' => substr($endTime, 0, 5),
                'status' => $status,
                'nama_pemesan' => $booking ? $booking->nama_pemesan : null,
                'nomor_telepon' => $booking ? $booking->nomor_telepon : null,
                'email' => $booking ? $booking->email : null,
                'total_harga' => $booking ? $booking->total_harga : ($field->original_price * 2 / 2),
                'kode_booking' => $booking ? $booking->kode_booking : null,
                'metode_pembayaran' => $booking ? $booking->metode_pembayaran : null,
                'durasi' => $booking ? $booking->durasi : 2,
            ];
        }

        return $slots;
    }
}