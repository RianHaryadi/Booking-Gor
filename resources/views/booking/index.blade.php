@extends('layouts.app')

@section('title', 'Booking Lapangan')

@section('content')
<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Pilih Lapangan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($lapangans as $lapangan)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    @if ($lapangan->foto)
                        <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama_mode }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-600">
                            Tidak ada gambar
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $lapangan->nama_mode }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $lapangan->deskripsi }}</p>
                        <p class="text-indigo-600 font-bold mt-3">
                            Rp {{ number_format($lapangan->harga, 0, ',', '.') }} / 2 Jam
                        </p>

                        <a href="{{ route('booking.form', ['lapangan' => $lapangan->id]) }}"
                           class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
