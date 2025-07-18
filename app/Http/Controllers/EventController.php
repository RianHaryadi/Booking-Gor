<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;

class EventController extends Controller
{

public function index()
{
    $events = Turnamen::orderBy('tanggal_mulai', 'desc')->paginate(6); // <- pakai paginate
    return view('event.index', compact('events'));
}

}
