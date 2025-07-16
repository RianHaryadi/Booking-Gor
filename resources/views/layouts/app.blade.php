<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - GOR Serbaguna</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome & Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @yield('styles')
</head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-extrabold text-indigo-700 hover:text-indigo-500 transition-colors duration-300">
                GOR Serbaguna
            </a>

            <!-- Menu Desktop -->
            <ul class="hidden md:flex gap-8 text-base font-medium items-center">
                <li>
                    <a href="{{ route('home') }}"
                       class="relative px-2 py-1 rounded-md hover:text-indigo-600 {{ request()->routeIs('home') ? 'text-indigo-600' : '' }} transition-colors duration-300"
                       onmouseover="this.classList.add('scale-105');"
                       onmouseout="this.classList.remove('scale-105');">
                        Home
                        @if (request()->routeIs('home'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600"></span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('booking.index') }}"
                       class="relative px-2 py-1 rounded-md hover:text-indigo-600 {{ request()->routeIs('booking.index') ? 'text-indigo-600' : '' }} transition-colors duration-300"
                       onmouseover="this.classList.add('scale-105');"
                       onmouseout="this.classList.remove('scale-105');">
                        Booking Lapangan
                        @if (request()->routeIs('booking.index'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600"></span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="relative px-2 py-1 rounded-md hover:text-indigo-600 {{ request()->routeIs('booking.track') ? 'text-indigo-600' : '' }} transition-colors duration-300"
                       onmouseover="this.classList.add('scale-105');"
                       onmouseout="this.classList.remove('scale-105');">
                        Tracking
                        @if (request()->routeIs('booking.track'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600"></span>
                        @endif
                    </a>
                </li>
            </ul>

            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-indigo-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
            <ul class="flex flex-col gap-4 p-4 text-base font-medium">
                <li>
                    <a href="{{ route('home') }}"
                       class="block px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-600' : '' }} transition-colors duration-300">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('booking.index') }}"
                       class="block px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('booking.index') ? 'bg-indigo-50 text-indigo-600' : '' }} transition-colors duration-300">
                        Booking Lapangan
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="block px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('booking.track') ? 'bg-indigo-50 text-indigo-600' : '' }} transition-colors duration-300">
                        Tracking
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-15 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4">GOR Serbaguna</h3>
                    <p class="text-sm text-gray-300">
                        Tempat terbaik untuk olahraga dan rekreasi. Booking lapangan favorit Anda dengan mudah!
                    </p>
                </div>
                <!-- Navigation Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Navigasi</h3>
                    <ul class="text-sm text-gray-300 space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors duration-300">Home</a></li>
                        <li><a href="{{ route('booking.index') }}" class="hover:text-indigo-400 transition-colors duration-300">Booking Lapangan</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors duration-300">Tracking</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak Kami</h3>
                    <ul class="text-sm text-gray-300 space-y-2">
                        <li>Email: <a href="mailto:info@gorserbaguna.com" class="hover:text-indigo-400 transition-colors duration-300">info@gorserbaguna.com</a></li>
                        <li>Telepon: <a href="tel:+6281234567890" class="hover:text-indigo-400 transition-colors duration-300">+62 812-3456-7890</a></li>
                        <li>Alamat: Jl. Olahraga No. 123, Jakarta</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400">
                © {{ date('Y') }} GOR Serbaguna. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Script untuk toggle menu mobile -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @yield('scripts')
</body>
</html>