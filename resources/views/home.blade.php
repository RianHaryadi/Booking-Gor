@extends('layouts.app')

@section('title', 'Beranda')

@section('hero')
<div class="relative bg-gradient-to-r from-blue-600 to-indigo-800 text-white py-20 overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-blue-400 mix-blend-overlay animate-float"></div>
        <div class="absolute top-1/3 right-20 w-40 h-40 rounded-full bg-indigo-400 mix-blend-overlay animate-float delay-2000"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-blue-300 mix-blend-overlay animate-float delay-4000"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fadeIn">
            <span class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-blue-300 to-white">
                GOR Serbaguna Sportiva
            </span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto animate-fadeIn delay-100 bg-white/10 backdrop-blur-sm p-4 rounded-lg">
            Tempat terbaik untuk berbagai aktivitas olahraga dengan fasilitas lengkap dan nyaman
        </p>
        <div class="animate-fadeIn delay-200 flex flex-col sm:flex-row justify-center gap-4">
            <a href="#" class="bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                <i class="fas fa-calendar-alt mr-2"></i> Booking Sekarang
            </a>
            <a href="#facilities" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white/10 transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                <i class="fas fa-search mr-2"></i> Lihat Fasilitas
            </a>
        </div>
    </div>
    
    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" class="w-full">
            <path fill="#FFFFFF" fill-opacity="1" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,85.3C672,75,768,85,864,101.3C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</div>
@endsection

@section('content')
<div class="container mx-auto py-16 px-4">
    <!-- Facilities Section -->
    <div class="text-center mb-16" id="facilities">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 relative inline-block">
            <span class="relative z-10 px-4 bg-white">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Fasilitas Unggulan Kami
                </span>
            </span>
            <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 to-indigo-100 z-0"></span>
        </h2>
        <p class="text-gray-600 max-w-3xl mx-auto text-lg">
            Nikmati pengalaman berolahraga terbaik dengan fasilitas lengkap dan modern
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <!-- Futsal Card -->
        <div class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 transform hover:-translate-y-2">
            <div class="h-48 bg-indigo-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Lapangan Futsal" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            </div>
            <div class="p-6">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-futbol"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lapangan Futsal</h3>
                <p class="text-gray-600">Lapangan berkualitas dengan rumput sintetis terbaik</p>
                <div class="mt-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Standar Nasional</span>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full ml-1">Pencahayaan LED</span>
                </div>
            </div>
        </div>

        <!-- Basketball Card -->
        <div class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 transform hover:-translate-y-2">
            <div class="h-48 bg-indigo-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Lapangan Basket" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            </div>
            <div class="p-6">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-basketball-ball"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lapangan Basket</h3>
                <p class="text-gray-600">Permukaan berkualitas dengan ring profesional</p>
                <div class="mt-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Parket Kayu</span>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full ml-1">2 Lapangan</span>
                </div>
            </div>
        </div>

        <!-- Volleyball Card -->
        <div class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 transform hover:-translate-y-2">
            <div class="h-48 bg-indigo-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1552667466-07770ae110d0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Lapangan Voli" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            </div>
            <div class="p-6">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-volleyball-ball"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lapangan Voli</h3>
                <p class="text-gray-600">Standar kompetisi dengan net berkualitas</p>
                <div class="mt-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Indoor/Outdoor</span>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full ml-1">3 Lapangan</span>
                </div>
            </div>
        </div>

        <!-- Badminton Card -->
        <div class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 transform hover:-translate-y-2">
            <div class="h-48 bg-indigo-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Lapangan Bulutangkis" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            </div>
            <div class="p-6">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-table-tennis"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lapangan Bulutangkis</h3>
                <p class="text-gray-600">Permukaan kayu berkualitas dengan pencahayaan optimal</p>
                <div class="mt-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">8 Lapangan</span>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full ml-1">AC</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Facilities -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-100 rounded-full opacity-20"></div>
            <div class="absolute -left-10 -bottom-10 w-60 h-60 bg-blue-100 rounded-full opacity-20"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-6 text-center text-indigo-800">Fasilitas Pendukung</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-toilet text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Toilet Bersih</h4>
                            <p class="text-sm text-gray-600">Higienis dengan air hangat</p>
                        </div>
                    </div>
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-pray text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Musholla</h4>
                            <p class="text-sm text-gray-600">Nyaman dengan AC</p>
                        </div>
                    </div>
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-lock text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Loker Penyimpanan</h4>
                            <p class="text-sm text-gray-600">Aman dengan sistem PIN</p>
                        </div>
                    </div>
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-chair text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Area Penonton</h4>
                            <p class="text-sm text-gray-600">Kapasitas 200 orang</p>
                        </div>
                    </div>
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-car text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Parkir Luas</h4>
                            <p class="text-sm text-gray-600">100+ kendaraan</p>
                        </div>
                    </div>
                    <div class="flex items-start bg-indigo-50 p-3 rounded-lg">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-utensils text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Kantin</h4>
                            <p class="text-sm text-gray-600">Makanan sehat & minuman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-indigo-600 to-blue-600 p-8 rounded-xl shadow-lg relative overflow-hidden text-white">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute -left-10 -bottom-10 w-60 h-60 bg-white/5 rounded-full"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-6 text-center">Informasi GOR</h3>
                <div class="space-y-6">
                    <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                        <h4 class="font-semibold text-lg mb-2 flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>Alamat</span>
                        </h4>
                        <p class="pl-8">Jl. Atlet No. 10, Kota Sporta, Indonesia</p>
                        <div class="mt-3">
                            <a href="#" class="text-sm bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full inline-flex items-center transition">
                                <i class="fas fa-map-marked-alt mr-1"></i> Lihat di Peta
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                        <h4 class="font-semibold text-lg mb-2 flex items-center">
                            <i class="fas fa-clock mr-3"></i>
                            <span>Jam Operasional</span>
                        </h4>
                        <p class="pl-8">Setiap hari pukul 07.00 – 22.00</p>
                        <div class="mt-2 pl-8 text-sm text-white/80">
                            <p class="flex items-center"><i class="fas fa-check-circle mr-2 text-green-300"></i> Buka di hari libur</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                        <h4 class="font-semibold text-lg mb-2 flex items-center">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>Kontak</span>
                        </h4>
                        <p class="pl-8">(021) 1234-5678</p>
                        <div class="mt-3 flex gap-2 pl-8">
                            <a href="#" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 relative inline-block">
            <span class="relative z-10 px-4 bg-white">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    Apa Kata Mereka?
                </span>
            </span>
            <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 to-indigo-100 z-0"></span>
        </h2>
        <p class="text-gray-600 max-w-3xl mx-auto mb-8 text-lg">
            Testimoni dari pelanggan yang telah menggunakan fasilitas kami
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-4 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Andi Wijaya" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">Andi Wijaya</h4>
                            <p class="text-sm text-gray-500">Pemain Futsal</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic relative">
                        <i class="fas fa-quote-left text-indigo-200 absolute -top-2 -left-2 text-3xl opacity-50"></i>
                        "Lapangan futsal sangat nyaman dengan rumput sintetis berkualitas. Fasilitas pendukungnya juga lengkap."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-4 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="Budi Santoso" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <p class="text-sm text-gray-500">Pelatih Basket</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic relative">
                        <i class="fas fa-quote-left text-indigo-200 absolute -top-2 -left-2 text-3xl opacity-50"></i>
                        "Sering mengadakan latihan di sini karena lapangannya standar nasional dan pencahayaan sangat baik."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-4 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Citra Dewi" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">Citra Dewi</h4>
                            <p class="text-sm text-gray-500">Atlet Voli</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic relative">
                        <i class="fas fa-quote-left text-indigo-200 absolute -top-2 -left-2 text-3xl opacity-50"></i>
                        "Tempat favorit untuk latihan. Kebersihan selalu terjaga dan staffnya sangat membantu."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Preview -->
    <div class="mb-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 relative inline-block">
                <span class="relative z-10 px-4 bg-white">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                        Galeri Kami
                    </span>
                </span>
                <span class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-blue-100 to-indigo-100 z-0"></span>
            </h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Dokumentasi kegiatan dan fasilitas di GOR Serbaguna Sportiva
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="group relative overflow-hidden rounded-lg aspect-square">
                <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Gallery 1" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-search-plus text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="group relative overflow-hidden rounded-lg aspect-square">
                <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Gallery 2" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-search-plus text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="group relative overflow-hidden rounded-lg aspect-square">
                <img src="https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Gallery 3" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-search-plus text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="group relative overflow-hidden rounded-lg aspect-square">
                <img src="https://images.unsplash.com/photo-1577471488278-16eec37ffcc2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                     alt="Gallery 4" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-search-plus text-white text-2xl"></i>
                </div>
            </a>
        </div>
        <div class="text-center mt-6">
            <a href="#" class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800 transition">
                Lihat lebih banyak <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl p-8 md:p-12 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full mix-blend-overlay animate-float"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-white rounded-full mix-blend-overlay animate-float delay-2000"></div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <h3 class="text-2xl md:text-4xl font-bold mb-4">Siap Berolahraga Hari Ini?</h3>
            <p class="mb-6 text-lg md:text-xl">Booking lapangan sekarang dan dapatkan pengalaman berolahraga terbaik</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                    <i class="fas fa-calendar-check mr-2"></i> Pesan Sekarang
                </a>
                <a href="#" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white/10 transition duration-300 inline-flex items-center justify-center transform hover:scale-105">
                    <i class="fas fa-phone-alt mr-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    .animate-fadeIn.delay-100 {
        animation-delay: 0.2s;
    }
    
    .animate-fadeIn.delay-200 {
        animation-delay: 0.4s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float.delay-2000 {
        animation-delay: 2s;
    }
    
    .animate-float.delay-4000 {
        animation-delay: 4s;
    }
    
    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }
    
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
</style>
@endsection