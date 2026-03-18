<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $events = Turnamen::orderBy('tanggal_mulai', 'desc')->paginate(6);

        return view('event.index', compact('events'));
    }
}