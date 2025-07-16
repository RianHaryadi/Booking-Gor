@extends('layouts.app')

@section('title', 'Tracking Booking')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <!-- Tracking Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 py-5 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h2 class="text-xl font-bold text-white">Lacak Booking Anda</h2>
                </div>
            </div>

            <!-- Card Content -->
            <div class="p-6 sm:p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('tracking.index') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Booking Code Input -->
                    <div>
                        <label for="kode_booking" class="block text-sm font-medium text-gray-700 mb-1">Kode Booking</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <input type="text" name="kode_booking" id="kode_booking" 
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg" 
                                   placeholder="Contoh: GOR-123456" 
                                   value="{{ old('kode_booking') }}" required>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Masukkan kode booking yang Anda terima via email/SMS</p>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lacak Booking
                        </button>
                    </div>
                </form>

                <!-- Help Section -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-medium text-gray-900">Butuh Bantuan?</h3>
                    <div class="mt-2 text-sm text-gray-600">
                        <p>Hubungi kami di <a href="tel:+628123456789" class="text-indigo-600 hover:text-indigo-500">0812-3456-789</a> atau</p>
                        <p>Email ke <a href="mailto:info@gorserbaguna.com" class="text-indigo-600 hover:text-indigo-500">info@gorserbaguna.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection