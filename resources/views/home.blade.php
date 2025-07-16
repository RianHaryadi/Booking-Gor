@extends('layouts.app')

@section('title', 'Beranda')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Floating animation for background elements */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Fade-in animation */
        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        .animate-fadeIn.delay-100 { animation-delay: 0.1s; }
        .animate-fadeIn.delay-200 { animation-delay: 0.2s; }
        .animate-fadeIn.delay-300 { animation-delay: 0.3s; }
        
        /* Scrollbar hide for schedule buttons */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Enhanced hover effect for cards */
        .sport-card:hover .sport-icon, .stat-card:hover .stat-icon {
            transform: rotate(12deg);
        }
        
        .schedule-day.active {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
        }
        
        /* Parallax effect for hero section */
        .parallax-bg {
            transform: translateY(0);
            transition: transform 0.1s ease-out;
        }
        
        /* Smooth number animation for stats */
        .stat-number {
            display: inline-block;
            transition: all 1.5s ease-out;
        }
    </style>
    
    <!-- Hero Section with Enhanced Parallax Effect -->
    <header class="relative bg-gradient-to-br from-blue-900 to-indigo-950 text-white pt-28 pb-48 overflow-hidden">
        <!-- Animated background elements with parallax -->
        <div class="absolute inset-0 opacity-25 overflow-hidden">
            <div class="parallax-bg absolute top-10 left-5 w-40 h-40 rounded-full bg-blue-600 mix-blend-overlay animate-float opacity-50" data-parallax="0.2"></div>
            <div class="parallax-bg absolute top-1/3 right-10 w-48 h-48 rounded-full bg-indigo-600 mix-blend-overlay animate-float delay-2000 opacity-50" data-parallax="0.3"></div>
            <div class="parallax-bg absolute bottom-10 left-1/4 w-32 h-32 rounded-full bg-blue-500 mix-blend-overlay animate-float delay-4000 opacity-50" data-parallax="0.15"></div>
        </div>
        
        <!-- Floating particles for depth -->
        <div class="absolute inset-0 opacity-15">
            <div class="absolute top-1/5 left-1/6 w-3 h-3 bg-white rounded-full animate-float delay-1000"></div>
            <div class="absolute top-1/2 right-1/5 w-2 h-2 bg-white rounded-full animate-float delay-3000"></div>
            <div class="absolute bottom-1/5 right-1/4 w-4 h-4 bg-white rounded-full animate-float delay-5000"></div>
        </div>
        
        <div class="container mx-auto px-6 text-center relative z-10 transform transition-all duration-500 hover:scale-[1.02]">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 animate__animated animate__fadeIn leading-tight tracking-tight">
                    <span class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-white px-3">
                        GOR Serbaguna Sportiva
                    </span>
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl mb-12 mx-auto animate__animated animate__fadeIn delay-100 bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/30 shadow-xl max-w-3xl">
                    Tempat terbaik untuk berbagai aktivitas olahraga dengan fasilitas modern dan nyaman
                </p>
                <div class="animate__animated animate__fadeIn delay-200 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                    <a href="#booking" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 inline-flex items-center justify-center transform hover:scale-105 active:scale-95">
                        <i class="fas fa-calendar-alt mr-3 text-lg"></i> Booking Sekarang
                    </a>
                    <a href="#facilities" class="border-2 border-white/90 text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/20 hover:border-white transition-all duration-300 inline-flex items-center justify-center transform hover:scale-105 active:scale-95">
                        <i class="fas fa-search mr-3 text-lg"></i> Jelajahi Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats Section with Enhanced Hover Effects and Animations -->
    <section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50 -mt-1">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Stat 1 -->
                <div class="stat-card bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-indigo-300 group relative overflow-hidden animate__animated animate__fadeIn">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-indigo-600 transition-colors stat-icon">
                        <i class="fas fa-futbol text-xl"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-indigo-700 stat-number" data-count="15">10+</div>
                    <div class="text-gray-600 font-medium">Lapangan Olahraga</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="stat-card bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-300 group relative overflow-hidden animate__animated animate__fadeIn delay-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-blue-600 transition-colors stat-icon">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-blue-700 stat-number" data-count="10000">100+</div>
                    <div class="text-gray-600 font-medium">Pengguna Bulanan</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="stat-card bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-green-300 group relative overflow-hidden animate__animated animate__fadeIn delay-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-green-500 transition-colors stat-icon">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-green-600 stat-number" data-count="24">24/7</div>
                    <div class="text-gray-600 font-medium">Layanan Pelanggan</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="stat-card bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-amber-300 group relative overflow-hidden animate__animated animate__fadeIn delay-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <div class="absolute top-4 right-4 text-indigo-400 group-hover:text-amber-500 transition-colors stat-icon">
                        <i class="fas fa-award text-xl"></i>
                    </div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-3 transition-colors duration-300 group-hover:text-amber-600 stat-number" data-count="5">5</div>
                    <div class="text-gray-600 font-medium">Tahun Pengalaman</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full transition-all duration-500 group-hover:w-16"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="py-20 bg-white" id="facilities">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 relative inline-block animate__animated animate__fadeIn">
                    <span class="relative z-10 px-4 bg-white">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                            Fasilitas Unggulan Kami
                        </span>
                    </span>
                    <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 via-indigo-100 to-blue-100 z-0"></span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed animate__animated animate__fadeIn delay-100">
                    Nikmati pengalaman berolahraga terbaik dengan fasilitas lengkap dan modern yang didesain untuk kenyamanan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Futsal Card -->
                <div class="sport-card group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2 hover:border-indigo-300 animate__animated animate__fadeInUp">
                    <div class="h-60 bg-indigo-50 overflow-hidden relative">
                        <img src="{{ asset('images/futsal.jpg') }}" alt="Lapangan Futsal" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-xl font-bold drop-shadow-lg">Futsal</div>
                        <div class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full animate__animated animate__pulse animate__infinite">
                            Populer
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="sport-icon bg-indigo-100 text-indigo-600 w-10 h-10 rounded-full flex items-center justify-center text-xl mr-3 transition-transform duration-500">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Lapangan Futsal</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Lapangan berkualitas dengan rumput sintetis terbaik dan sistem drainase optimal</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">Standar Nasional</span>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">Pencahayaan LED</span>
                        </div>
                    </div>
                </div>

                <!-- Basketball Card -->
                <div class="sport-card group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2 hover:border-blue-300 animate__animated animate__fadeInUp delay-100">
                    <div class="h-60 bg-blue-50 overflow-hidden relative">
                        <img src="{{ asset('images/basketball.jpg') }}" alt="Lapangan Basket" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-xl font-bold drop-shadow-lg">Basket</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="sport-icon bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center text-xl mr-3 transition-transform duration-500">
                                <i class="fas fa-basketball-ball"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Lapangan Basket</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Permukaan berkualitas tinggi dengan ring profesional dan standar kompetisi</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">Parket Kayu</span>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">2 Lapangan</span>
                        </div>
                    </div>
                </div>

                <!-- Volleyball Card -->
                <div class="sport-card group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2 hover:border-red-300 animate__animated animate__fadeInUp delay-200">
                    <div class="h-60 bg-red-50 overflow-hidden relative">
                        <img src="{{ asset('images/volleyball.jpg') }}" alt="Lapangan Voli" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-xl font-bold drop-shadow-lg">Voli</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="sport-icon bg-red-100 text-red-600 w-10 h-10 rounded-full flex items-center justify-center text-xl mr-3 transition-transform duration-500">
                                <i class="fas fa-volleyball-ball"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Lapangan Voli</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Standar kompetisi dengan net berkualitas tinggi dan area bermain yang luas</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">Indoor/Outdoor</span>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">3 Lapangan</span>
                        </div>
                    </div>
                </div>

                <!-- Badminton Card -->
                <div class="sport-card group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2 hover:border-purple-300 animate__animated animate__fadeInUp delay-300">
                    <div class="h-60 bg-purple-50 overflow-hidden relative">
                        <img src="{{ asset('images/badminton.jpg') }}" alt="Lapangan Bulutangkis" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-xl font-bold drop-shadow-lg">Badminton</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="sport-icon bg-purple-100 text-purple-600 w-10 h-10 rounded-full flex items-center justify-center text-xl mr-3 transition-transform duration-500">
                                <i class="fas fa-table-tennis"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Lapangan Bulutangkis</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Permukaan kayu berkualitas tinggi dengan pencahayaan optimal dan sirkulasi udara baik</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">8 Lapangan</span>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">Ber-AC</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Facilities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden animate__animated animate__fadeInUp">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-100 rounded-full opacity-20"></div>
                    <div class="absolute -left-10 -bottom-10 w-60 h-60 bg-blue-100 rounded-full opacity-20"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-6 text-center text-indigo-800">Fasilitas Pendukung</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-toilet text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Toilet Bersih</h4>
                                    <p class="text-sm text-gray-600 mt-1">Higienis dengan air hangat dan perlengkapan lengkap</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-pray text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Musholla</h4>
                                    <p class="text-sm text-gray-600 mt-1">Nyaman dengan AC dan perlengkapan shalat</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-lock text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Loker Penyimpanan</h4>
                                    <p class="text-sm text-gray-600 mt-1">Aman dengan sistem PIN digital dan CCTV</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-chair text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Area Penonton</h4>
                                    <p class="text-sm text-gray-600 mt-1">Kapasitas 200 orang dengan tempat duduk nyaman</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-car text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Parkir Luas</h4>
                                    <p class="text-sm text-gray-600 mt-1">100+ kendaraan dengan sistem keamanan 24 jam</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-indigo-50/70 hover:bg-indigo-100/50 p-4 rounded-xl transition duration-300 border border-indigo-100 hover:border-indigo-200">
                                <div class="bg-indigo-100 p-3 rounded-xl mr-4 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-utensils text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Kantin Sehat</h4>
                                    <p class="text-sm text-gray-600 mt-1">Makanan bergizi dan minuman segar pasca olahraga</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-700 to-blue-700 p-8 rounded-2xl shadow-xl relative overflow-hidden text-white animate__animated animate__fadeInUp delay-100">
                    <div class="absolute inset-0 opacity-15">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full mix-blend-overlay animate-float"></div>
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-white rounded-full mix-blend-overlay animate-float delay-3000"></div>
                    </div>
                    <div class="relative z-10 h-full flex flex-col">
                        <h3 class="text-2xl font-bold mb-6 text-center">Informasi GOR</h3>
                        <div class="space-y-6 flex-grow">
                            <div class="bg-white/10 p-5 rounded-xl backdrop-blur-sm border border-white/20 hover:border-white/40 transition">
                                <h4 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-3 text-blue-200"></i>
                                    <span>Lokasi</span>
                                </h4>
                                <p class="pl-9 text-white/90">Jl. Atlet No. 10, Kota Sporta, Jawa Barat, Indonesia</p>
                                <div class="mt-4 pl-9">
                                    <a href="#" class="text-sm bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg inline-flex items-center transition border border-white/20 hover:border-white/40">
                                        <i class="fas fa-map-marked-alt mr-2"></i> Buka di Google Maps
                                    </a>
                                </div>
                            </div>

                            <div class="bg-white/10 p-5 rounded-xl backdrop-blur-sm border border-white/20 hover:border-white/40 transition">
                                <h4 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="fas fa-clock mr-3 text-blue-200"></i>
                                    <span>Jam Operasional</span>
                                </h4>
                                <p class="pl-9 text-white/90">Senin - Minggu: 07.00 – 22.00 WIB</p>
                                <div class="mt-3 pl-9">
                                    <div class="flex items-center text-sm text-blue-100">
                                        <i class="fas fa-check-circle mr-2"></i> Buka di hari libur nasional
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white/10 p-5 rounded-xl backdrop-blur-sm border border-white/20 hover:border-white/40 transition">
                                <h4 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="fas fa-phone-alt mr-3 text-blue-200"></i>
                                    <span>Kontak & Media Sosial</span>
                                </h4>
                                <p class="pl-9 text-white/90 mb-3">(021) 1234-5678 / 0812-3456-7890</p>
                                <div class="flex gap-3 pl-9">
                                    <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition border border-white/20 hover:border-white/40 hover:scale-110">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition border border-white/20 hover:border-white/40 hover:scale-110">
                                        <i class="fab fa-instagram text-lg"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition border border-white/20 hover:border-white/40 hover:scale-110">
                                        <i class="fab fa-facebook-f text-lg"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition border border-white/20 hover:border-white/40 hover:scale-110">
                                        <i class="fas fa-envelope text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 bg-gray-50" id="pricing">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 relative inline-block animate__animated animate__fadeIn">
                    <span class="relative z-10 px-4 bg-gray-50">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                            Paket Harga
                        </span>
                    </span>
                    <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 via-indigo-100 to-blue-100 z-0"></span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed animate__animated animate__fadeIn delay-100">
                    Pilihan paket harga yang terjangkau untuk berbagai kebutuhan olahraga Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Futsal Pricing -->
                <div class="price-card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition duration-300 hover:shadow-2xl hover:border-indigo-300 group animate__animated animate__fadeInUp">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-5 px-6 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-20 h-20 bg-indigo-700 rounded-full opacity-20"></div>
                        <h3 class="text-xl font-bold flex items-center relative z-10">
                            <i class="fas fa-futbol mr-3"></i> Futsal
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-indigo-700 mb-2">Rp120.000<span class="text-base font-normal text-gray-500">/jam</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Rumput sintetis premium</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Pencahayaan LED</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Sistem drainase optimal</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Bola termasuk</span>
                            </li>
                        </ul>
                        <a href="#booking" class="block w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white text-center py-3 px-4 rounded-lg transition duration-300 group-hover:shadow-md">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Basketball Pricing -->
                <div class="price-card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition duration-300 hover:shadow-2xl hover:border-blue-300 group animate__animated animate__fadeInUp delay-100">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 px-6 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-20 h-20 bg-blue-700 rounded-full opacity-20"></div>
                        <h3 class="text-xl font-bold flex items-center relative z-10">
                            <i class="fas fa-basketball-ball mr-3"></i> Basket
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-blue-700 mb-2">Rp150.000<span class="text-base font-normal text-gray-500">/jam</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Permukaan parket kayu</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Ring standar kompetisi</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Pencahayaan profesional</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Bola termasuk</span>
                            </li>
                        </ul>
                        <a href="#booking" class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-center py-3 px-4 rounded-lg transition duration-300 group-hover:shadow-md">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Badminton Pricing -->
                <div class="price-card bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition duration-300 hover:shadow-2xl hover:border-purple-300 group animate__animated animate__fadeInUp delay-200">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-5 px-6 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-20 h-20 bg-purple-700 rounded-full opacity-20"></div>
                        <h3 class="text-xl font-bold flex items-center relative z-10">
                            <i class="fas fa-table-tennis mr-3"></i> Badminton
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-purple-700 mb-2">Rp80.000<span class="text-base font-normal text-gray-500">/jam</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Permukaan kayu berkualitas</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Ruangan ber-AC</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Pencahayaan optimal</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Kok tidak termasuk</span>
                            </li>
                        </ul>
                        <a href="#booking" class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-center py-3 px-4 rounded-lg transition duration-300 group-hover:shadow-md">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10 animate__animated animate__fadeIn delay-300">
                <p class="text-gray-600 mb-4">* Harga khusus untuk pemesanan di luar jam sibuk (weekday pagi)</p>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center group">
                    <span class="group-hover:underline">Lihat harga lengkap</span>
                    <i class="fas fa-chevron-right ml-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="py-20 bg-white" id="schedule">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 relative inline-block animate__animated animate__fadeIn">
                    <span class="relative z-10 px-4 bg-white">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                            Jadwal Ketersediaan
                        </span>
                    </span>
                    <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 via-indigo-100 to-blue-100 z-0"></span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed animate__animated animate__fadeIn delay-100">
                    Cek ketersediaan lapangan berdasarkan hari dan waktu yang Anda inginkan
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-xl p-6 max-w-4xl mx-auto border border-gray-100 animate__animated animate__fadeInUp">
                <div class="flex overflow-x-auto pb-4 mb-6 scrollbar-hide">
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="senin">
                        Senin
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="selasa">
                        Selasa
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="rabu">
                        Rabu
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="kamis">
                        Kamis
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="jumat">
                        Jumat
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 mr-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="sabtu">
                        Sabtu
                    </button>
                    <button class="schedule-day flex-shrink-0 px-5 py-3 rounded-lg bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition" data-day="minggu">
                        Minggu
                    </button>
                </div>

                <!-- Schedule Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-50">
                                <th class="p-4 text-left text-indigo-700 font-semibold">Lapangan</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">07:00-09:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">09:00-11:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">11:00-13:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">13:00-15:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">15:00-17:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">17:00-19:00</th>
                                <th class="p-4 text-center text-indigo-700 font-semibold">19:00-21:00</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 animate__animated animate__fadeInUp">
                                <td class="p-4 font-medium">Futsal A</td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 animate__animated animate__fadeInUp delay-100">
                                <td class="p-4 font-medium">Futsal B</td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 animate__animated animate__fadeInUp delay-200">
                                <td class="p-4 font-medium">Basket 1</td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50 animate__animated animate__fadeInUp delay-300">
                                <td class="p-4 font-medium">Badminton 1-4</td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Tersedia</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                                <td class="p-4 text-center"><span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Booked</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center animate__animated animate__fadeIn delay-100">
                    <div class="text-gray-600">
                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span> Tersedia
                        <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2 ml-4"></span> Booked
                    </div>
                    <a href="#booking" class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 inline-flex items-center transform hover:scale-105">
                        <i class="fas fa-calendar-check mr-2"></i> Booking Lapangan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-700 to-blue-800 text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 animate__animated animate__fadeIn">Siap Berolahraga Hari Ini?</h2>
                <p class="text-xl mb-10 text-blue-100 max-w-2xl mx-auto animate__animated animate__fadeIn delay-100">
                    Bergabunglah dengan ribuan orang yang telah merasakan pengalaman berolahraga terbaik di GOR Sportiva
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-5 animate__animated animate__fadeIn delay-200">
                    <a href="#booking" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                        <i class="fas fa-calendar-alt mr-3 text-lg"></i> Booking Sekarang
                    </a>
                    <a href="#" class="border-2 border-white text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/20 transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                        <i class="fas fa-phone-alt mr-3 text-lg"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Parallax effect for hero section background elements
    document.addEventListener('mousemove', (e) => {
        document.querySelectorAll('.parallax-bg').forEach(element => {
            const speed = element.getAttribute('data-parallax');
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
        const updateNumber = () => {
            if (current < target) {
                current += increment;
                number.textContent = Math.ceil(current) + (number.textContent.includes('+') ? '+' : '');
                requestAnimationFrame(updateNumber);
            } else {
                number.textContent = target + (number.textContent.includes('+') ? '+' : '');
                if (number.textContent === '24/7') {
                    number.textContent = '24/7';
                }
            }
        };
        // Trigger animation when element is in viewport
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                updateNumber();
                observer.disconnect();
            }
        }, { threshold: 0.5 });
        observer.observe(number);
    });

    // Schedule day selector
    document.querySelectorAll('.schedule-day').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.schedule-day').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
            console.log('Selected day:', this.dataset.day);
            // Add logic to fetch and update schedule data for the selected day
        });
    });

    // Set first schedule day as active
    document.querySelector('.schedule-day')?.classList.add('active');

    // Scroll-triggered animations for sections
    const animateOnScroll = () => {
        document.querySelectorAll('.animate__animated').forEach(element => {
            const rect = element.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;
            if (rect.top <= windowHeight * 0.9) {
                element.classList.add('animate__animated');
            }
        });
    };
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Trigger on page load
</script>
@endsection