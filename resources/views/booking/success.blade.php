@extends('layouts.app')

@section('title', 'Booking Success')

@section('head')
    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<section class="py-16 bg-gradient-to-b from-blue-50 to-white">
    <div class="container max-w-2xl mx-auto px-4 text-center">
        <!-- Success Icon with Animation -->
        <div class="mb-6">
            <i class="fas fa-check-circle text-6xl text-green-500 animate__animated animate__bounceIn"></i>
        </div>

        <!-- Success Message -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4 animate__animated animate__fadeInUp">Booking Berhasil!</h2>
        <p class="text-lg text-gray-600 mb-8 animate__animated animate__fadeInUp animate__delay-1s">
            Terima kasih telah memesan lapangan di GOR Serbaguna. Berikut detail booking Anda:
        </p>

        <!-- Booking Details -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 animate__animated animate__fadeInUp animate__delay-2s">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Booking</h3>
            @if ($booking)
                <dl class="grid grid-cols-1 gap-y-4 text-left">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Lapangan</dt>
                        <dd class="text-sm text-gray-900">{{ $booking->lapanganMode->name ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Tanggal</dt>
                        <dd class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Waktu</dt>
                        <dd class="text-sm text-gray-900">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Durasi</dt>
                        <dd class="text-sm text-gray-900">{{ $booking->durasi }} Jam</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Kode Booking</dt>
                        <dd class="text-sm text-gray-900 font-mono">{{ $booking->kode_booking }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Total Harga</dt>
                        <dd class="text-sm text-gray-900">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Metode Pembayaran</dt>
                        <dd class="text-sm text-gray-900">{{ ucfirst($booking->metode_pembayaran) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Status</dt>
                        <dd class="text-sm text-gray-900">{{ ucfirst($booking->status) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Nama Pemesan</dt>
                        <dd class="text-sm text-gray-900">{{ $booking->nama_pemesan }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-600">Nomor Telepon</dt>
                        <dd class="text-sm text-gray-900">{{ $booking->nomor_telepon }}</dd>
                    </div>
                    @if ($booking->email)
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $booking->email }}</dd>
                        </div>
                    @endif
                </dl>
            @else
                <p class="text-red-600">Error: Tidak ada detail booking yang ditemukan.</p>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 animate__animated animate__fadeInUp animate__delay-3s">
            <a href="{{ route('booking.index') }}"
               class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-2.5 px-6 rounded-lg font-medium flex items-center justify-center transition-all shadow-md hover:shadow-lg">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Lapangan
            </a>
            @if (Route::has('booking.track'))
                <a href="{{ route('booking.track') }}"
                   class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white py-2.5 px-6 rounded-lg font-medium flex items-center justify-center transition-all shadow-md hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Lacak Booking
                </a>
            @endif
        </div>
    </div>
</section>
@endsection