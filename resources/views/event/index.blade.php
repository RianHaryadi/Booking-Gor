@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-green-500">
                    Daftar Event Olahraga
                </span>
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Temukan berbagai event olahraga seru dari berbagai kategori. Bergabunglah dan raih kemenangan!
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-600 to-green-500">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider rounded-tl-2xl">#</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">Poster</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">Event</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider hidden lg:table-cell">Deskripsi</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider hidden md:table-cell">Lokasi</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider rounded-tr-2xl">Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($events as $index => $event)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="px-8 py-4">{{ $events->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="h-16 w-16 rounded-lg overflow-hidden border shadow">
                                    @if($event->poster)
                                        <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->nama }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-100 flex items-center justify-center">
                                            <span class="text-sm text-gray-500">No Image</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $event->nama }}</div>
                                <div class="text-xs text-gray-500">Hadiah: Rp{{ number_format($event->hadiah, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <div class="text-sm text-gray-600 line-clamp-2">{{ $event->deskripsi }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    s/d {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">
                                <div class="text-sm text-gray-700">{{ Str::limit($event->lokasi, 20) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $event->kategori === 'single' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($event->kategori) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full 
                                    {{ $event->status === 'upcoming' ? 'bg-yellow-100 text-yellow-800' : 
                                      ($event->status === 'ongoing' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{-- Jika status 'ongoing' dan link ada, tampilkan tombol daftar --}}
                                @if($event->status === 'ongoing' && $event->linkpendaftaran)
                                    <a href="{{ $event->linkpendaftaran }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                        Daftar Sekarang
                                    </a>
                                {{-- Jika status 'upcoming', tampilkan tulisan 'Akan Datang' --}}
                                @elseif($event->status === 'upcoming')
                                    <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-yellow-800 bg-yellow-100">
                                        Akan Datang
                                    </span>
                                {{-- Untuk kondisi lainnya, pendaftaran ditutup --}}
                                @else
                                    <span class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-500 bg-gray-100 cursor-not-allowed">
                                        Pendaftaran Ditutup
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500">Belum ada event tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($events->hasPages())
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200 rounded-b-2xl">
                {{ $events->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection