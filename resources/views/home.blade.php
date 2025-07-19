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
                            <a href="{{ route('booking.form', ['field' => $lapangan->id, 'date' => $tanggal]) }}"
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
                                    @if ($turnamen->status === 'ongoing' && $turnamen->linkpendaftaran)
                                        <a href="{{ $turnamen->linkpendaftaran }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                            Daftar Sekarang
                                        </a>
                                    @elseif ($turnamen->status === 'upcoming')
                                        <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-yellow-800 bg-yellow-100 cursor-default">
                                            Akan Datang
                                        </span>
                                    @else
                                        <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
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
                <a href="" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                    Lihat semua turnamen
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="event-gallery" class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="mb-12 sm:mb-20 text-center">
            <h3 class="text-3xl sm:text-4xl font-bold mb-4 header-font">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Dokumentasi Event
                </span>
            </h3>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Jelajahi momen-momen berharga dari acara kami melalui galeri foto eksklusif
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Gallery Item 1 with hover effect -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (2).webp" alt="Ruang Loker Premium" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 2 -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (4).webp" alt="Sport Cafe" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 3 -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (15).webp" alt="Musholla" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 4 -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (18).webp" alt="Toilet" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 5 -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (2).webp" alt="Bus Transport" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 5 -->
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <img src="images/unnamed (2).webp" alt="Bus Transport" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div>
                    </div>
                </div>
            </div>
    </div>
</section>

<div class="relative h-96 w-full overflow-hidden rounded-2xl shadow-xl">
    <!-- Map Container with Gradient Overlay -->
    <div class="absolute inset-0 z-0">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.442051823585!2d106.88008447475163!3d-6.336742293652942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed1de1b28475%3A0xab797084e7b67501!2sGOR%20PKP%20Jakarta%20Islamic%20School!5e0!3m2!1sid!2sid!4v1752926106964!5m2!1sid!2sid" 
            class="w-full h-full" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    
    <!-- Location Info Card -->
    <div class="absolute bottom-6 left-6 z-10 bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-lg max-w-sm">
        <div class="flex items-start gap-4">
            <div class="bg-indigo-100 p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">GOR PKP Jakarta Islamic School</h3>
                <p class="text-gray-600 mt-1">Jl. Raya PKP, Kelapa Dua, Tangerang</p>
                <div class="mt-3 flex gap-2">
                    <a href="https://maps.google.com/?q=GOR+PKP+Jakarta+Islamic+School" target="_blank" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                        Buka di Maps
                    </a>
                    <a href="https://www.google.com/maps/dir//GOR+PKP+Jakarta+Islamic+School/@-6.3367423,106.8800845,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x2e69ed1de1b28475:0xab797084e7b67501!2m2!1d106.8826594!2d-6.3367423" target="_blank" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Petunjuk Arah
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map Controls -->
    <div class="absolute top-6 right-6 z-10 flex gap-2">
        <button class="p-3 bg-white rounded-lg shadow-md hover:bg-gray-50 transition-colors" title="Zoom In">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </button>
        <button class="p-3 bg-white rounded-lg shadow-md hover:bg-gray-50 transition-colors" title="Zoom Out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
            </svg>
        </button>
    </div>
</div>

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
                                    @if (in_array($turnamen->status, ['upcoming', 'ongoing']) && $turnamen->linkpendaftaran)
                                        <a href="{{ $turnamen->linkpendaftaran }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                            Daftar Sekarang
                                        </a>
                                    @else
                                        <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
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

<section id="facilities-support" class="py-20 bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h3 class="text-3xl sm:text-4xl font-bold mb-4 text-gray-900">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Fasilitas Pendukung
                </span>
            </h3>
            <p class="text-lg text-gray-600">
                Fasilitas premium yang kami sediakan untuk kenyamanan dan kebutuhan Anda selama acara berlangsung
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Facility Card 1 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/loker.jpg" alt="Ruang Loker Premium" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Ruang Loker Premium</h4>
                        <p class="text-gray-200 text-sm">Penyimpanan barang pribadi yang aman dan nyaman</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility Card 2 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/ambulance.webp" alt="Ambulance Standby" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Ambulance Standby</h4>
                        <p class="text-gray-200 text-sm">Layanan kesehatan siap 24 jam selama acara</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility Card 3 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/Musholla.jpg" alt="Musholla" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Area Musholla</h4>
                        <p class="text-gray-200 text-sm">Tempat ibadah yang nyaman dan lengkap</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility Card 4 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/Toilet.jpg" alt="Toilet Bersih" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Toilet Bersih</h4>
                        <p class="text-gray-200 text-sm">Fasilitas sanitasi yang higienis dan terawat</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility Card 5 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/bus.webp" alt="Transportasi Bus" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Transportasi Bus</h4>
                        <p class="text-gray-200 text-sm">Pelayanan transportasi antar-jemput peserta</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility Card 6 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="images/Control.jpg" alt="Control Room" class="w-full h-64 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                        </div>
                        <h4 class="text-white text-xl font-bold mb-1">Control Room</h4>
                        <p class="text-gray-200 text-sm">Pusat kendali dan monitoring acara</p>
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
          <a href="https://wa.me/6281318865459?text=Halo%2C%20saya%20ingin%20menanyakan%20salah%20satu%20dari%20opsi%20berikut%3A%0A1.%20Pemesanan%20lapangan%20%5Bsepak%20bola%2Ffutsal%5D%20untuk%20%5Btanggal%2Fjam%5D%2C%20termasuk%20harga%20dan%20ketersediaan.%0A2.%20Informasi%20untuk%20mengadakan%20event%20seperti%20%5Bturnamen%20olahraga%2Facara%20perusahaan%5D%2C%20termasuk%20fasilitas%20dan%20prosedur.%0ANama%20saya%20%5Bnama%20Anda%5D%20dari%20%5Bkota%2Forganisasi%5D.%20Terima%20kasih%21" 
            class="border-2 border-white text-white font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-white/20 transition duration-300 inline-flex items-center justify-center transform hover:scale-105 btn-hover-effect">
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
    
    @keyframes pulse-slow {
        0% { opacity: 0.75; }
        50% { opacity: 0.5; }
        100% { opacity: 0.75; }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite;
    }
    
    .animate-text-shimmer {
        animation: text-shimmer 8s ease infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 3s ease-in-out infinite;
    }
    
    .glow-effect {
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
    }
    
    .glow-effect-lg {
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.8);
    }
    
    .zoom-effect {
        transition: transform 0.7s ease;
    }
    
    .group:hover .zoom-effect {
        transform: scale(1.1);
    }
    
    .floating {
        animation: floating 6s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0); }
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