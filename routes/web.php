<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingLapanganController;
use App\Http\Controllers\BookingController;

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

// Halaman Daftar Lapangan (Booking Lapangan)
Route::get('/booking-lapangan', [BookingLapanganController::class, 'index'])->name('booking.index');

// Formulir Booking Lapangan
Route::get('/booking-lapangan/{lapangan}/form', [BookingController::class, 'form'])->name('booking.form');

// Proses Submit Booking
Route::post('/booking-lapangan/submit', [BookingController::class, 'submit'])->name('booking.submit');
Route::post('/booking-lapangan/store', [BookingLapanganController::class, 'store'])->name('booking.store');