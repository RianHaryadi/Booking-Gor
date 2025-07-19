<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookBookingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Web routes untuk homepage, sistem booking, dan tracking booking.
|
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Booking Routes
Route::get('/booking', [BookBookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{field}/form', [BookBookingController::class, 'form'])->name('booking.form');
Route::get('/booking/schedule/{field?}', [BookBookingController::class, 'scheduleForm'])->name('booking.schedule');
Route::post('/booking/store', [BookBookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success', [BookBookingController::class, 'success'])->name('booking.success');
Route::get('/booking/timeslots', [BookBookingController::class, 'getTimeSlots'])->name('booking.timeslots');

// Tracking Routes
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/tracking', [TrackingController::class, 'search'])->name('tracking.result');

// event end turnamnet
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{id}/daftar', [EventController::class, 'daftar'])->name('event.daftar');
Route::post('/event/{id}/store', [EventController::class, 'store'])->name('event.store');
Route::get('/event/{id}/success', [EventController::class, 'success'])->name('event.success');
