@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
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

        <!-- Stats and Filters -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex items-center space-x-4">
                <div class="bg-white px-6 py-3 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="font-medium text-gray-700">Total Event: <span class="text-blue-600 font-bold">{{ count($events) }}</span></span>
                </div>
                
                <div class="relative">
                    <select class="appearance-none bg-white pl-4 pr-10 py-3 rounded-xl shadow-sm border border-gray-200 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Semua Kategori</option>
                        <option>Basket</option>
                        <option>Futsal</option>
                        <option>Badminton</option>
                        <option>Voli</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari event..." class="w-full pl-4 pr-10 py-3 rounded-xl shadow-sm border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Events Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-600 to-green-500">
                        <tr>
                            <th scope="col" class="px-8 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider rounded-tl-2xl">
                                #
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Poster
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Event
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider hidden lg:table-cell">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider hidden md:table-cell">
                                Lokasi
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-white uppercase tracking-wider rounded-tr-2xl">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($events as $index => $event)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="px-8 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $index + 1 }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-16 w-16 rounded-lg overflow-hidden border-2 border-white shadow-md group-hover:border-blue-200 transition-colors duration-200">
                                    @if($event->poster)
                                        <img class="h-full w-full object-cover transform group-hover:scale-105 transition-transform duration-300" src="{{ asset('storage/' . $event->poster) }}" alt="Poster Event">
                                    @else
                                        <div class="h-full w-full bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $event->nama }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Hadiah: {{ $event->hadiah }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <div class="text-sm text-gray-600 max-w-xs line-clamp-2">{{ $event->deskripsi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">s/d {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div class="text-sm text-gray-600">{{ Str::limit($event->lokasi, 20) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($event->kategori == 'Basket') bg-orange-100 text-orange-800
                                    @elseif($event->kategori == 'Futsal') bg-blue-100 text-blue-800
                                    @elseif($event->kategori == 'Badminton') bg-green-100 text-green-800
                                    @elseif($event->kategori == 'Voli') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $event->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($event->status == 'aktif') bg-green-100 text-green-800
                                    @elseif($event->status == 'selesai') bg-gray-100 text-gray-800
                                    @elseif($event->status == 'coming soon') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada event tersedia</h3>
                                    <p class="text-gray-500 max-w-md">Sepertinya belum ada event yang terdaftar. Silakan kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
                                    <button class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Buat Event Baru
                                    </button>
                                </div>
                            </td>
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

        <!-- Additional CTA Section -->
        <div class="mt-12 bg-gradient-to-r from-blue-600 to-green-500 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-8 sm:p-10 sm:pb-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0 md:mr-8">
                        <h2 class="text-2xl font-bold text-white mb-2">Tertarik membuat event sendiri?</h2>
                        <p class="text-blue-100 max-w-lg">Daftarkan event olahraga Anda sekarang dan dapatkan peserta dari seluruh wilayah. Kami siap membantu promosi!</p>
                    </div>
                    <button class="whitespace-nowrap inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-blue-600 bg-white hover:bg-blue-50 transition-colors duration-200">
                        Buat Event Sekarang
                        <svg class="ml-2 -mr-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection