@extends('layouts.app')

@section('title', 'Hasil Tracking')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Booking</h2>
        <div class="bg-indigo-100 p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kode Booking</p>
                    <p class="text-lg font-semibold text-indigo-600">{{ $booking->kode_booking }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Nama Pemesan</p>
                    <p class="text-lg font-semibold">{{ $booking->nama_pemesan }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Lapangan</p>
                    <p class="text-lg font-semibold">{{ $booking->lapanganMode->name }}</p>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-medium text-gray-500">Tanggal & Jam</p>
                    <p class="text-lg font-semibold">
                        {{ $booking->tanggal }}<br>
                        {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Harga</p>
                    <p class="text-xl font-bold text-indigo-600">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-500 mb-1">Status Booking</p>
            <div class="flex items-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    {{ $booking->status === 'booked' ? 'bg-green-100 text-green-800' : 
                       ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-500 mb-1">Metode Pembayaran</p>
            <p class="text-lg font-semibold">{{ ucfirst($booking->metode_pembayaran) }}</p>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('tracking.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Cek Kode Lain
        </a>
    </div>
</div>
@endsection