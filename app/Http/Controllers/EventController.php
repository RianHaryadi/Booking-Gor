<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Set locale for Carbon for translated date formats
        Carbon::setLocale('id');

        // Fetch events with pagination (6 per page), ordered by tanggal_mulai descending
        $events = Turnamen::orderBy('tanggal_mulai', 'desc')->paginate(6);

        return view('event.index', compact('events'));
    }
}