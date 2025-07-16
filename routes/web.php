<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookBookingController;
use App\Http\Controllers\TrackingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di bawah ini adalah daftar route yang digunakan untuk halaman frontend
| seperti Home, Booking Lapangan, dan Submit Booking.
|
*/

// Halaman Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Daftar Lapangan
Route::get('/booking', [BookBookingController::class, 'index'])->name('booking.index');

// Form Booking untuk Lapangan Tertentu
Route::get('/booking/{field}/form', [BookBookingController::class, 'form'])->name('booking.form');

// Proses Submit Booking
Route::post('/booking/store', [BookBookingController::class, 'store'])->name('booking.store');

// Halaman Sukses setelah Booking
Route::get('/booking/success', [BookBookingController::class, 'success'])->name('booking.success');


Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/tracking', [TrackingController::class, 'search'])->name('tracking.result');
