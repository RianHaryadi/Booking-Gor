<?php

namespace App\Http\Controllers;

use App\Models\LapanganMode;
use App\Models\Turnamen;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with tournaments and field availability.
     */
    public function index(Request $request)
    {
        // Set locale for Carbon for translated date formats
        Carbon::setLocale('id');

        // Get selected date and duration, default to today and 2 hours
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());
        $durasi = $request->input('durasi', 2); // Default duration for links on home page

        $parsedDate = Carbon::parse($tanggal)->setTimezone('Asia/Jakarta')->startOfDay();

        // Validate date is within 7 days from today
        $maxDate = Carbon::today()->addDays(7)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('home', ['tanggal' => Carbon::today()->toDateString(), 'durasi' => $durasi])
                            ->with('error', 'Tanggal tidak boleh lebih dari 7 hari ke depan.');
        }

        // Mengambil 4 turnamen paling baru ditambahkan, apapun statusnya
        $tournaments = Turnamen::latest()->take(4)->get();
        $allTournaments = $tournaments;
    

        // Fetch ALL fields to correctly build the schedule table headers and rows
        $allFields = LapanganMode::all();

        // Fetch top 4 rated fields for the "featured fields" section
        $fields = LapanganMode::orderBy('rating', 'desc')->take(4)->get();

        // Fetch all relevant bookings for the selected date across all fields
        $bookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->whereIn('lapangan_mode_id', $allFields->pluck('id'))
            ->whereIn('status', ['booked', 'pending'])
            ->select('lapangan_mode_id', 'jam_mulai', 'jam_selesai', 'nama_pemesan', 'nomor_telepon', 'email', 'total_harga', 'kode_booking', 'metode_pembayaran', 'durasi', 'status')
            ->get();

        // Add available time slots to each field object for display in the schedule
        $allFields->each(function ($field) use ($tanggal, $bookings, $durasi) {
            // Pass the 'bookings' collection and the 'durasi' (for link price calc) to the helper
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $tanggal, $bookings, $durasi);
        });

        // Pass $allFields to the view so it's always defined for table headers (even if 'fields' is a subset)
        return view('home', compact('tournaments', 'fields', 'allTournaments', 'allFields', 'tanggal', 'durasi'));
    }

    /**
     * Helper function to get available time slots for a specific field, date, and general bookings.
     * Always generates 2-hour display slots, regardless of requestedDurasi.
     * The requestedDurasi is used for the 'total_harga' and 'durasi' in the slot array for booking links.
     */
    private function getAvailableTimeSlots($field, $date, $allBookingsForDate, $requestedDurasi = 2)
    {
        $slots = [];
        $startHour = 8; // 8:00 AM operational start
        $endHour = 22;  // 10:00 PM operational end (last slot will be 20:00-22:00)
        $displayInterval = 2; // Fixed interval for displaying slots in the schedule table

        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();
        // Filter the overall bookings collection to only bookings for the current field
        $fieldBookings = $allBookingsForDate->where('lapangan_mode_id', $field->id);

        for ($hour = $startHour; $hour < $endHour; $hour += $displayInterval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $displayInterval);
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            // Check if this specific 2-hour display slot overlaps with ANY existing booking for this field
            $booking = $fieldBookings->first(function ($existingBooking) use ($slotStart, $slotEnd) {
                $existingBookingStart = Carbon::parse($existingBooking->jam_mulai);
                $existingBookingEnd = Carbon::parse($existingBooking->jam_selesai);
                // Overlap condition: (StartA < EndB) AND (EndA > StartB)
                return $slotStart->lt($existingBookingEnd) && $slotEnd->gt($existingBookingStart);
            });

            // Determine status
            $status = 'available';
            if ($booking) {
                $status = $booking->status; // If there's an overlapping booking, use its status
            } elseif ($parsedDate->isToday() && $slotStart->isPast()) {
                // Corrected condition to check if the slot is in the past only on the current day
                $status = 'soon'; 
            }

            $slots[] = [
                'time' => substr($startTime, 0, 5),
                'end_time' => substr($endTime, 0, 5),
                'status' => $status,
                'nama_pemesan' => $booking ? $booking->nama_pemesan : null,
                'nomor_telepon' => $booking ? $booking->nomor_telepon : null,
                'email' => $booking ? $booking->email : null,
                // Calculate total_harga based on the user's requestedDurasi, not the display interval
                'total_harga' => $field->original_price * ($requestedDurasi / 2),
                'kode_booking' => $booking ? $booking->kode_booking : null,
                'metode_pembayaran' => $booking ? $booking->metode_pembayaran : null,
                'durasi' => $requestedDurasi, // This duration is for the booking link, not the display slot size
            ];
        }

        return $slots;
    }
}