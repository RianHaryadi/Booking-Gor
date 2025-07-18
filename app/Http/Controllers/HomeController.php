<?php

namespace App\Http\Controllers;

use App\Models\LapanganMode;
use App\Models\Turnamen;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Set locale for Carbon
        Carbon::setLocale('id');

        // Retrieve the top 4 Turnamen records with status 'upcoming', ordered by tanggal_mulai
        $tournaments = Turnamen::where('status', 'upcoming')
            ->where('tanggal_mulai', '>=', Carbon::today())
            ->orderBy('tanggal_mulai')
            ->take(4)
            ->get();

        // Retrieve the top 4 LapanganMode records ordered by rating in descending order
        $fields = LapanganMode::orderBy('rating', 'desc')->take(4)->get();

        // Get selected date for filtering, default to today
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());
        $parsedDate = Carbon::parse($tanggal)->startOfDay();

        // Redirect to next day if selected date is Sunday
        if ($parsedDate->isSunday()) {
            $tanggal = Carbon::tomorrow()->toDateString();
            $parsedDate = Carbon::tomorrow()->startOfDay();
        }

        // Fetch all upcoming tournaments for the main section
        $allTournaments = Turnamen::where('status', 'upcoming')
            ->where('tanggal_mulai', '>=', $parsedDate)
            ->orderBy('tanggal_mulai')
            ->get();

        // Fetch all fields with available time slots for the schedule section
        $allFields = LapanganMode::all()->map(function ($field) use ($tanggal) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $tanggal);
            return $field;
        });

        return view('home', compact('tournaments', 'fields', 'allTournaments', 'allFields', 'tanggal'));
    }

    private function getAvailableTimeSlots($field, $date)
    {
        $slots = [];
        $startHour = 8; // 8:00 AM
        $endHour = 22;  // 10:00 PM
        $interval = 2;  // 2-hour slots

        // Parse date and ensure it's in the correct timezone
        $parsedDate = Carbon::parse($date)->startOfDay();

        // Fetch bookings for the specific field and date
        $bookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->where('lapangan_mode_id', $field->id)
            ->whereIn('status', ['booked', 'pending'])
            ->select('jam_mulai', 'jam_selesai')
            ->get();

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $interval);

            // Convert times to Carbon instances for accurate comparison
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            // Check if the slot exactly matches or overlaps with any booking
            $isBooked = $bookings->contains(function ($booking) use ($slotStart, $slotEnd) {
                $bookingStart = Carbon::parse($booking->jam_mulai);
                $bookingEnd = Carbon::parse($booking->jam_selesai);
                // Check for exact match or overlap
                return ($bookingStart->equalTo($slotStart) && $bookingEnd->equalTo($slotEnd)) ||
                       ($bookingStart->lt($slotEnd) && $bookingEnd->gt($slotStart));
            });

            // Determine slot status: booked, soon, or available
            $status = $isBooked ? 'booked' : (Carbon::now()->gt($slotStart->subHour()) ? 'soon' : 'available');

            $slots[] = [
                'time' => $startTime,
                'end_time' => $endTime,
                'status' => $status,
            ];
        }

        return $slots;
    }
}