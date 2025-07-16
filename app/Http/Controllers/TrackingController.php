<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'kode_booking' => 'required|string'
        ]);

        $booking = Booking::where('kode_booking', $request->kode_booking)->first();

        if (!$booking) {
            return back()->withErrors(['kode_booking' => 'Kode booking tidak ditemukan.'])->withInput();
        }

        return view('tracking.result', compact('booking'));
    }
}
