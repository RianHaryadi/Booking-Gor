<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\LapanganMode;
use Carbon\Carbon;

class TimeSlotService
{
    public static function getAvailableTimeSlots(LapanganMode $field, $date)
    {
        $slots = [];
        $startHour = 8; // 8:00 AM
        $endHour = 22; // 10:00 PM
        $interval = 2; // 2-hour slots

        // Parse date and set timezone
        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $interval);

            $slotStart = Carbon::parse("$parsedDate $startTime")->setTimezone('Asia/Jakarta');
            $slotEnd = Carbon::parse("$parsedDate $endTime")->setTimezone('Asia/Jakarta');

            // Check conflicts using diJamYangSama scope
            $isBooked = Booking::diJamYangSama($parsedDate->toDateString(), $slotStart->format('H:i:s'), $slotEnd->format('H:i:s'))
                ->where('lapangan_mode_id', $field->id)
                ->whereIn('status', ['booked', 'pending'])
                ->exists();

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