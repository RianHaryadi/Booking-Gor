<?php

namespace App\Http\Traits;

use App\Models\Booking;
use Carbon\Carbon;

trait TimeSlotTrait
{
    private function getAvailableTimeSlots($field, $date)
    {
        $slots = [];
        $startHour = 8; // 8:00 AM
        $endHour = 22;  // 10:00 PM
        $interval = 2;  // 2-hour slots

        // Parse date and ensure it's in Asia/Jakarta timezone
        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();

        // Fetch bookings for the specific field and date
        $bookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->where('lapangan_mode_id', $field->id)
            ->whereIn('status', ['booked', 'pending'])
            ->select('jam_mulai', 'jam_selesai')
            ->get();

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00', $hour);
            $endTime = sprintf('%02d:00', $hour + $interval);

            // Convert times to Carbon instances for accurate comparison
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            // Check if the slot overlaps with any booking
            $isBooked = $bookings->contains(function ($booking) use ($startTime, $endTime, $slotStart, $slotEnd) {
                $bookingStart = Carbon::parse($booking->jam_mulai);
                $bookingEnd = Carbon::parse($booking->jam_selesai);
                return $bookingStart->lte($slotEnd) && $bookingEnd->gte($slotStart);
            });

            // Determine slot status: booked, soon (past), or available
            $status = $isBooked ? 'booked' : 
                     ($slotStart->isPast() ? 'soon' : 'available');

            $slots[] = [
                'time' => $startTime,
                'end_time' => $endTime,
                'status' => $status,
            ];
        }

        return $slots;
    }
}