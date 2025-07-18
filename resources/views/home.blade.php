@extends('layouts.app')

@section('title', 'GOR Sportiva - Pusat Olahraga Premium')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<meta name="description" content="GOR Sportiva - Pusat olahraga premium di Bandung dengan fasilitas bertaraf internasional untuk atlet dan komunitas olahraga.">
<meta name="keywords" content="GOR Sportiva, olahraga, futsal, basket, badminton, voli, Bandung">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section id="home" class="relative h-screen flex items-center justify-center text-white overflow-hidden pt-16">
    <!-- Background Image with Parallax Effect -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="{{ asset('images/pintu.jpg') }}" alt="GOR Sportiva Hero Background" 
             class="w-full h-full object-cover transform scale-110 group-hover:scale-100 transition-transform duration-1000 ease-out">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/60 to-black/80 z-1"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-6xl mx-auto">
        <div class="mb-8 animate__animated animate__fadeInDown">
            <!-- Badge -->
            <span class="inline-block bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium mb-6 border border-white/30 
                        transition-all duration-500 hover:bg-white/30 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-medal mr-2 text-yellow-300"></i> GOR Terbaik di Kota 2023
            </span>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold mb-6 header-font leading-tight tracking-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-blue-100 to-blue-200 
                          animate-text-shimmer bg-[length:200%_100%]">
                    GOR SPORTIVA
                </span>
            </h1>

            <!-- Subheading -->
            <p class="text-lg sm:text-xl md:text-2xl max-w-3xl mx-auto mb-10 text-blue-100 leading-relaxed font-light tracking-wide">
                Pusat olahraga premium dengan fasilitas bertaraf internasional untuk atlet profesional dan komunitas olahraga
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('booking.index') }}" 
                   class="bg-white text-blue-800 font-semibold px-6 py-3 sm:px-8 sm:py-4 rounded-xl shadow-lg hover:shadow-xl 
                          transition-all duration-300 inline-flex items-center justify-center transform hover:scale-105 
                          glow-effect hover:glow-effect-lg active:scale-95">
                    <i class="fas fa-calendar-alt mr-3 text-lg"></i> Booking Sekarang
                </a>
                <a href="#schedule" 
                   class="border-2 border-white text-white font-semibold px-6 py-3 sm:px-8 sm:py-4 rounded-xl hover:bg-white/20 
                          transition-all duration-300 inline-flex items-center justify-center transform hover:scale-105 
                          backdrop-blur-sm active:scale-95">
                    <i class="fas fa-video mr-3 text-lg"></i> Lihat Jadwal
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce-slow">
        <a href="#facilities" 
           class="w-12 h-12 rounded-full bg-white/20 border-2 border-white/40 flex items-center justify-center text-white 
                  hover:bg-white/30 transition-all duration-300 hover:scale-110 hover:shadow-md"
           aria-label="Scroll to facilities">
            <i class="fas fa-chevron-down text-lg animate-pulse"></i>
        </a>
    </div>
</section>

<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50 -mt-1">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6 max-w-6xl mx-auto">
            <div class="stat-card bg-white p-6 sm:p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-indigo-300 group relative overflow-hidden animate__animated animate__fadeIn">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-indigo-600 transition-colors stat-icon">
                    <i class="fas fa-futbol text-xl sm:text-2xl"></i>
                </div>
                <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-indigo-700 stat-number" data-count="15">10+</div>
                <div class="text-gray-600 font-medium text-sm sm:text-base">Lapangan Olahraga</div>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                </div>
            </div>
            <div class="stat-card bg-white p-6 sm:p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-300 group relative overflow-hidden animate__animated animate__fadeIn delay-100">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-blue-600 transition-colors stat-icon">
                    <i class="fas fa-users text-xl sm:text-2xl"></i>
                </div>
                <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-blue-700 stat-number" data-count="10000">100+</div>
                <div class="text-gray-600 font-medium text-sm sm:text-base">Pengguna Bulanan</div>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                </div>
            </div>
            <div class="stat-card bg-white p-6 sm:p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-green-300 group relative overflow-hidden animate__animated animate__fadeIn delay-200">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-green-500 transition-colors stat-icon">
                    <i class="fas fa-headset text-xl sm:text-2xl"></i>
                </div>
                <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-green-600 stat-number" data-count="24">24/7</div>
                <div class="text-gray-600 font-medium text-sm sm:text-base">Layanan Pelanggan</div>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                </div>
            </div>
            <div class="stat-card bg-white p-6 sm:p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-amber-300 group relative overflow-hidden animate__animated animate__fadeIn delay-300">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-amber-500 transition-colors stat-icon">
                    <i class="fas fa-award text-xl sm:text-2xl"></i>
                </div>
                <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-amber-600 stat-number" data-count="5">5</div>
                <div class="text-gray-600 font-medium text-sm sm:text-base">Tahun Pengalaman</div>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="facilities" class="py-20 bg-white relative">
    <div class="wave-container">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="wave-divider">
            <defs>
                <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#2563eb" />
                    <stop offset="50%" stop-color="#4f46e5" />
                    <stop offset="100%" stop-color="#7c3aed" />
                </linearGradient>
                <filter id="waveShadow" x="-20%" y="-20%" width="140%" height="140%">
                    <feDropShadow dx="0" dy="5" stdDeviation="5" flood-color="rgba(59, 130, 246, 0.3)" />
                </filter>
            </defs>
            <path fill="url(#waveGradient)" filter="url(#waveShadow)" 
                  d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" 
                  opacity=".25" class="wave-back"></path>
            <path fill="url(#waveGradient)" 
                  d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" 
                  opacity=".7" class="wave-main"></path>
            <path fill="url(#waveGradient)" 
                  d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" 
                  class="wave-top"></path>
        </svg>
    </div>
        
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 header-font">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Fasilitas Premium Kami
                </span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-base sm:text-lg leading-relaxed font-light">
                Nikmati pengalaman berolahraga kelas dunia dengan fasilitas berstandar internasional
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4 sm:px-6 py-8">
            @forelse ($fields as $lapangan)
                <div class="field-card group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100/50">
                    <!-- Court Image with Floating Elements -->
                    <div class="relative h-60 overflow-hidden">
                        @if ($lapangan->image)
                            <img src="{{ asset('storage/' . $lapangan->image) }}" alt="{{ $lapangan->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                                @if($lapangan->category === 'Premium') bg-amber-100 text-amber-800
                                @elseif($lapangan->category === 'VIP') bg-purple-100 text-purple-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ $lapangan->category ?? 'Standard' }}
                            </span>
                        </div>

                        <!-- Rating Badge -->
                        @if($lapangan->rating)
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-sm font-bold flex items-center shadow-md">
                                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span>{{ number_format($lapangan->rating, 1) }}</span>
                            </div>
                        @endif

                        <!-- Favorite Button -->
                        <button class="absolute bottom-4 right-4 p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-md hover:bg-white transition-colors">
                            <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Court Details -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900 truncate">{{ $lapangan->name }}</h3>
                            <div class="flex items-center text-sm text-gray-500 min-w-max ml-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="truncate">{{ $lapangan->location }}</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $lapangan->description }}</p>
                        
                        <!-- Price and Booking -->
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg font-bold text-blue-600">
                                    Rp{{ number_format($lapangan->original_price, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-gray-500">/ 2 jam</span>
                            </div>
                            <a href="#"
                               class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-2.5 px-5 rounded-lg font-medium flex items-center justify-center transition-all shadow-md hover:shadow-lg active:scale-95">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16" id="no-results">
                    <div class="mx-auto max-w-md px-4">
                        <div class="w-24 h-24 mx-auto mb-6 text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Lapangan Tersedia</h3>
                        <p class="text-gray-600 mb-6">Maaf, kami tidak dapat menemukan lapangan yang sesuai dengan kriteria Anda. Coba sesuaikan pencarian atau filter.</p>
                        <button class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-6 py-3 rounded-lg font-medium transition shadow-md hover:shadow-lg">
                            Hapus Semua Filter
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="tournaments" class="py-20 bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700">
                Turnamen & Event Mendatang
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg sm:text-xl leading-relaxed">
                Bergabung dalam kompetisi seru dan buktikan kemampuan tim kamu! Daftar sekarang untuk pengalaman bermain yang tak terlupakan.
            </p>
        </div>

        <!-- Turnamen Mendatang -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-16">
            <div class="p-6 sm:p-8 bg-gradient-to-r from-blue-600 to-indigo-700">
                <h3 class="text-2xl sm:text-3xl font-bold text-white">Turnamen Terdekat</h3>
                <p class="text-blue-100 mt-2">Daftar sekarang sebelum kuota penuh!</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr class="text-blue-800">
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Nama Turnamen</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Tanggal</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Kategori</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Lokasi</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($tournaments as $turnamen)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="py-5 px-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                            @if ($turnamen->poster)
                                                <img src="{{ asset('storage/' . $turnamen->poster) }}" alt="{{ $turnamen->nama }}" class="h-full w-full object-cover rounded-lg">
                                            @else
                                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-gray-900">{{ $turnamen->nama }}</h4>
                                            <p class="text-sm text-gray-500">{{ $turnamen->deskripsi ? Str::limit($turnamen->deskripsi, 50) : 'No description' }}</p>
                                            <p class="text-sm text-gray-500">Hadiah: Rp {{ number_format($turnamen->hadiah, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($turnamen->tanggal_mulai)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($turnamen->tanggal_selesai)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $turnamen->kategori === 'single' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($turnamen->kategori) }}
                                    </span>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $turnamen->lokasi }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                        {{ $turnamen->status === 'upcoming' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($turnamen->status === 'ongoing' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($turnamen->status) }}
                                    </span>
                                </td>
                                <td class="py-5 px-6">
                                    @if ($turnamen->status === 'upcoming')
                                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                            Daftar Sekarang
                                        </a>
                                    @else
                                        <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadowing-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                            Lihat Detail
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-center">
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                    Lihat semua turnamen
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="h-64 sm:h-96 w-full bg-gray-200">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902409423135!2d107.61067631525976!3d-6.903087969054819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93a9d7d!2sBandung%2C%20West%20Java%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1698765432109" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

<section class="py-20 bg-gradient-to-b from-blue-50/50 to-white/50" id="schedule">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Animated Header -->
        <div class="text-center mb-12 sm:mb-16">
            <div class="relative inline-block mb-6 animate-float">
                <h2 class="text-4xl sm:text-5xl font-bold mb-2 relative z-10 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 animate-text-shimmer">
                    Jadwal Ketersediaan
                </h2>
                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-3/4 h-1.5 bg-gradient-to-r from-blue-200 via-indigo-200 to-purple-200 rounded-full opacity-75 animate-pulse-slow"></div>
            </div>
            <p class="text-gray-600/90 max-w-2xl mx-auto text-lg sm:text-xl leading-relaxed font-medium">
                Cek ketersediaan lapangan favoritmu dan pesan waktu bermain dengan mudah
            </p>
        </div>

        <!-- Sunday Warning -->
        @if (\Carbon\Carbon::parse($tanggal)->isSunday())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg">
                <p class="font-medium">Peringatan: GOR tutup pada hari Minggu. Jadwal ditampilkan untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->addDay()->translatedFormat('l, d F Y') }}.</p>
            </div>
        @endif

        <!-- Date Picker Card -->
        <div class="mb-10 max-w-lg mx-auto bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 backdrop-blur-sm bg-white/80">
            <div class="p-6">
                <form method="GET" action="{{ route('home') }}" class="space-y-4">
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Pilih Tanggal Bermain
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal" name="tanggal" value="{{ \Carbon\Carbon::parse($tanggal)->toDateString() }}"
                                   class="w-full p-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm bg-white/80 backdrop-blur-sm text-gray-700"
                                   min="{{ \Carbon\Carbon::today()->toDateString() }}"
                                   onchange="console.log('Tanggal dipilih:', this.value); this.form.submit()">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-6 w-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white px-6 py-3.5 rounded-xl font-semibold transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari Jadwal Tersedia
                    </button>
                </form>
            </div>
        </div>

        <!-- Schedule Table Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200/30 max-w-6xl mx-auto transition-all duration-500 hover:shadow-2xl backdrop-blur-sm bg-white/90">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Daftar Ketersediaan Lapangan
                    </h3>
                    <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                        <span class="text-sm text-indigo-200">Tanggal:</span>
                        <span class="text-sm font-medium text-white">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Schedule Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500/10 to-blue-500/10">
                            <th class="p-5 text-left text-indigo-700 font-bold text-sm uppercase tracking-wider">Lapangan</th>
                            @foreach ($allFields->first()->availableTimeSlots ?? [] as $slot)
                                <th class="p-5 text-center text-indigo-700 font-bold text-sm uppercase tracking-wider">
                                    <div class="flex flex-col items-center">
                                        <span class="font-bold">{{ $slot['time'] }}</span>
                                        <span class="text-xs font-normal text-indigo-500">{{ $slot['end_time'] }}</span>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/30">
                        @forelse ($allFields as $index => $lapangan)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200 {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50/30' }}">
                                <td class="p-5 font-medium text-gray-900">
                                    <div class="flex items-center">
                                        @if($lapangan->image)
                                        <div class="flex-shrink-0 h-12 w-12 rounded-xl overflow-hidden mr-4 border-2 border-white shadow-sm">
                                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $lapangan->image) }}" alt="{{ $lapangan->name }}">
                                        </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-gray-800">{{ $lapangan->name }}</div>
                                            <div class="flex items-center mt-1">
                                                <span class="text-xs px-2 py-1 rounded-full font-medium 
                                                    @if($lapangan->category === 'Premium') bg-amber-100 text-amber-800
                                                    @elseif($lapangan->category === 'VIP') bg-purple-100 text-purple-800
                                                    @else bg-blue-100 text-blue-800 @endif">
                                                    {{ $lapangan->category ?? 'Standard' }}
                                                </span>
                                                @if($lapangan->rating)
                                                <span class="ml-2 text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800 flex items-center">
                                                    <svg class="w-3 h-3 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    {{ number_format($lapangan->rating, 1) }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @foreach ($lapangan->availableTimeSlots as $slot)
                                    <td class="p-5 text-center">
                                        @if ($slot['status'] === 'booked')
                                            <div class="tooltip" data-tip="Slot sudah dipesan">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-red-50 text-red-700 border border-red-200 cursor-not-allowed">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Booked
                                                </span>
                                            </div>
                                        @elseif ($slot['status'] === 'soon')
                                            <div class="tooltip" data-tip="Akan tersedia dalam 1 jam">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-gray-50 text-gray-700 border border-gray-200 cursor-not-allowed">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Soon
                                                </span>
                                            </div>
                                        @else
                                            <a href="{{ route('booking.form', [
                                                'field' => $lapangan->id,
                                                'date' => $tanggal,
                                                'jam_mulai' => $slot['time'],
                                                'jam_selesai' => $slot['end_time']
                                            ]) }}"
                                               class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 border border-green-200 hover:border-green-300 hover:shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Tersedia
                                            </a>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($allFields->first()->availableTimeSlots ?? []) + 1 }}" class="p-10 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div class="w-24 h-24 mb-6 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h4 class="text-xl font-bold text-gray-700 mb-2">Jadwal Tidak Tersedia</h4>
                                        <p class="max-w-md mb-6">Maaf, tidak ada lapangan yang tersedia untuk tanggal yang dipilih.</p>
                                        <button onclick="document.getElementById('tanggal').focus()" 
                                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors shadow-sm">
                                            Pilih Tanggal Lain
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Legend and CTA -->
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-8 py-6 border-t border-gray-200/30">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-700">
                        <div class="flex items-center bg-white/80 px-3 py-1.5 rounded-lg shadow-sm border border-gray-200/50">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            <span>Tersedia</span>
                        </div>
                        <div class="flex items-center bg-white/80 px-3 py-1.5 rounded-lg shadow-sm border border-gray-200/50">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                            <span>Booked</span>
                        </div>
                        <div class="flex items-center bg-white/80 px-3 py-1.5 rounded-lg shadow-sm border border-gray-200/50">
                            <span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>
                            <span>Soon</span>
                        </div>
                    </div>
                    <a href="{{ route('booking.index') }}"
                       class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl shadow-lg text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Booking Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="facilities" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="mb-12 sm:mb-20">
            <h3 class="text-2xl sm:text-3xl font-bold mb-8 header-font text-center">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Fasilitas Pendukung
                </span>
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <div class="relative rounded-xl overflow-hidden h-56 sm:h-64 group">
                    <img src="{{ asset('images/locker-room.jpg') }}" alt="Ruang Loker Premium" class="w-full h-full object-cover zoom-effect lazyload">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4 sm:p-6">
                        <div>
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-full flex items-center justify-center text-white mb-4">
                                <i class="fas fa-lock text-lg sm:text-xl"></i>
                            </div>
                            <h4 class="text-white font-bold text-lg sm:text-xl mb-2">Loker Premium</h4>
                            <p class="text-blue-100 text-sm sm:text-base">Sistem keamanan digital dengan CCTV 24 jam</p>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden h-56 sm:h-64 group">
                    <img src="{{ asset('images/cafeteria.jpg') }}" alt="Sport Cafe" class="w-full h-full object-cover zoom-effect lazyload">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4 sm:p-6">
                        <div>
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-full flex items-center justify-center text-white mb-4">
                                <i class="fas fa-utensils text-lg sm:text-xl"></i>
                            </div>
                            <h4 class="text-white font-bold text-lg sm:text-xl mb-2">Sport Cafe</h4>
                            <p class="text-blue-100 text-sm sm:text-base">Menu sehat khusus atlet dan minuman isotonik</p>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden h-56 sm:h-64 group">
                    <img src="{{ asset('images/shower-room.jpg') }}" alt="Shower Room" class="w-full h-full object-cover zoom-effect lazyload">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4 sm:p-6">
                        <div>
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-full flex items-center justify-center text-white mb-4">
                                <i class="fas fa-shower text-lg sm:text-xl"></i>
                            </div>
                            <h4 class="text-white font-bold text-lg sm:text-xl mb-2">Shower Room</h4>
                            <p class="text-blue-100 text-sm sm:text-base">Fasilitas mandi dengan air hangat dan perlengkapan lengkap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gradient-to-r from-blue-800 to-indigo-900 text-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-20 left-10 w-32 sm:w-40 h-32 sm:h-40 bg-white rounded-full floating"></div>
        <div class="absolute bottom-10 right-20 w-48 sm:w-60 h-48 sm:h-60 bg-white rounded-full floating delay-2000"></div>
        <div class="absolute top-1/3 right-1/4 w-24 sm:w-32 h-24 sm:h-32 bg-white rounded-full floating delay-4000"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 header-font">Siap Berolahraga Hari Ini?</h2>
        <p class="text-base sm:text-lg md:text-xl mb-8 sm:mb-10 text-blue-200 max-w-2xl mx-auto font-light">
            Bergabunglah dengan ribuan orang yang telah merasakan pengalaman berolahraga premium di GOR Sportiva
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-5">
            <a href="{{ route('booking.index') }}" class="bg-white text-blue-800 font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 inline-flex items-center justify-center transform hover:scale-105 glow-effect btn-hover-effect">
                <i class="fas fa-calendar-alt mr-3 text-lg"></i> Booking Sekarang
            </a>
            <a href="#contact" class="border-2 border-white text-white font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-white/20 transition duration-300 inline-flex items-center justify-center transform hover:scale-105 btn-hover-effect">
                <i class="fas fa-phone-alt mr-3 text-lg"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<style>
    /* Custom Animations */
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
    
    @keyframes text-shimmer {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite;
    }
    
    .animate-text-shimmer {
        animation: text-shimmer 8s ease infinite;
    }
    
    .glow-effect {
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
    }
    
    .glow-effect-lg {
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.8);
    }
    
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js" async></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Parallax effect for hero section
        document.addEventListener('mousemove', (e) => {
            document.querySelectorAll('.parallax-bg').forEach(element => {
                const speed = element.getAttribute('data-parallax') || 0.1;
                const x = (window.innerWidth - e.pageX * speed) / 100;
                const y = (window.innerHeight - e.pageY * speed) / 100;
                element.style.transform = `translate(${x}px, ${y}px)`;
            });
        });

        // Number count-up animation for stats
        document.querySelectorAll('.stat-number').forEach(number => {
            const target = parseInt(number.getAttribute('data-count')) || 0;
            let current = 0;
            const increment = target / 100;
            let animationStarted = false;

            const updateNumber = () => {
                if (current < target) {
                    current += increment;
                    number.textContent = Math.ceil(current) + (number.textContent.includes('+') ? '+' : '');
                    requestAnimationFrame(updateNumber);
                } else {
                    number.textContent = target + (number.textContent.includes('+') ? '+' : '');
                    if (number.getAttribute('data-count') === '24') {
                        number.textContent = '24/7';
                    }
                }
            };

            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting && !animationStarted) {
                    updateNumber();
                    animationStarted = true;
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe(number);
        });

        // Schedule day selector
        document.querySelectorAll('.schedule-day').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.schedule-day').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                console.log('Selected day:', this.dataset.day);
            });
        });

        // Set first schedule day as active
        document.querySelector('.schedule-day')?.classList.add('active');

        // Scroll-triggered animations
        const animateOnScroll = () => {
            document.querySelectorAll('.animate__animated').forEach(element => {
                const rect = element.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                if (rect.top <= windowHeight * 0.9 && rect.bottom >= 0) {
                    if (!element.classList.contains('animate__animated--done')) {
                        element.classList.add('animate__animated', 'animate__animated--done');
                    }
                }
            });
        };
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll();

        // Video background fallback
        const videoBg = document.querySelector('video');
        if (videoBg) {
            videoBg.play().catch(() => {
                videoBg.parentElement.style.backgroundImage = `url('${videoBg.getAttribute('poster')}')`;
                videoBg.parentElement.style.backgroundSize = 'cover';
                videoBg.parentElement.style.backgroundPosition = 'center';
                videoBg.remove();
            });
        }
    });
</script>
@endsection