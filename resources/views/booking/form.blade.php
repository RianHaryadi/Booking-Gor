@extends('layouts.app')

@section('title', 'Book ' . $lapangan->name)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to courts
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 transition-all duration-300 hover:shadow-2xl">
            <div class="md:flex">
                <div class="md:w-1/3 relative">
                    @if ($lapangan->image)
                        <img class="h-64 w-full md:h-full object-cover"
                             src="{{ asset('storage/' . $lapangan->image) }}"
                             alt="{{ $lapangan->name }}">
                    @else
                        <div class="h-64 w-full md:h-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-8 md:w-2/3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full uppercase tracking-wide">{{ $lapangan->category ?? 'Standard' }}</span>
                            <h1 class="mt-3 text-3xl font-bold text-gray-900">{{ $lapangan->name }}</h1>
                            <div class="flex items-center mt-2 text-gray-600">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $lapangan->location }}
                            </div>
                        </div>
                        <div class="text-right">
                            <div id="court-price" class="text-3xl font-bold text-blue-600">
                                Rp{{ number_format($lapangan->original_price ?? 10000, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-500">per 2 hours</div>
                            @if ($lapangan->rating)
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($lapangan->rating, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Description</h3>
                        <p class="mt-2 text-gray-600">{{ $lapangan->description ?? 'No description available.' }}</p>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Facilities</h3>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Changing Room
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Parking Area
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Equipment Rental
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="px-8 pt-8">
                <div class="flex items-center">
                    <div class="flex items-center text-blue-600 relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-blue-600 bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark text-white">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-blue-600">Booking Details</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-blue-600"></div>
                    <div class="flex items-center text-gray-500 relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500">Your Info</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    <div class="flex items-center text-gray-500 relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500">Payment</div>
                    </div>
                </div>
            </div>

            <div id="form-error" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-6 mt-4" role="alert"></div>
            <div id="loading-spinner" class="hidden text-center py-4">
                <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" id="booking-form" class="p-6 sm:p-8 space-y-6">
                @csrf
                @if ($errors->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $errors->first('error') }}</span>
                    </div>
                @endif
                <input type="hidden" name="lapangan_mode_id" value="{{ $lapangan->id }}">
                <input type="hidden" name="jam_selesai" id="jam_selesai">
                <input type="hidden" name="status" id="status" value="pending">
                <input type="hidden" name="kode_booking" id="kode_booking" value="BOOK-{{ uniqid() }}">

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-100 text-blue-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">1</span>
                        Booking Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Booking Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $selectedDate ?? '') }}"
                                       min="{{ now()->toDateString() }}" required
                                       class="bg-white pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                            </div>
                            @error('tanggal')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p id="sunday-message" class="mt-2 text-sm text-red-600 hidden">The GOR is closed on Sundays. Please select another date.</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="durasi" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                            <select name="durasi" id="durasi" required
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                                <option value="" disabled {{ old('durasi') ? '' : 'selected' }}>Select duration</option>
                                <option value="2" {{ old('durasi') === '2' ? 'selected' : '' }}>2 Hours</option>
                                <option value="4" {{ old('durasi') === '4' ? 'selected' : '' }}>4 Hours</option>
                                <option value="6" {{ old('durasi') === '6' ? 'selected' : '' }}>6 Hours</option>
                            </select>
                            @error('durasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <select name="jam_mulai" id="jam_mulai" required
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                                <option value="" disabled {{ old('jam_mulai') ? '' : 'selected' }}>Select start time</option>
                                @foreach ($lapangan->availableTimeSlots as $slot)
                                    @if ($slot['status'] === 'available')
                                        <option value="{{ $slot['time'] }}" {{ old('jam_mulai') === $slot['time'] ? 'selected' : '' }}>{{ $slot['time'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('jam_mulai')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p id="no-timeslots-message" class="mt-2 text-sm text-red-600 hidden">No available time slots for the selected date.</p>
                            <p id="end-time-warning" class="mt-2 text-sm text-yellow-600 hidden">Selected duration exceeds operational hours (ends by 22:00). Please choose an earlier start time or shorter duration.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-100 text-blue-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">2</span>
                        Your Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="nama_pemesan" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}" required
                                       class="bg-white pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                            </div>
                            @error('nama_pemesan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}" required
                                       class="bg-white pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                            </div>
                            @error('nomor_telepon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (Optional)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                       class="bg-white pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-100 text-blue-800 w-8 h-8 rounded-full flex items-center justify-center mr-3">3</span>
                        Payment Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" required
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12">
                                <option value="" disabled {{ old('metode_pembayaran') ? '' : 'selected' }}>Select payment method</option>
                                <option value="cash" {{ old('metode_pembayaran') === 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ old('metode_pembayaran') === 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="qris" {{ old('metode_pembayaran') === 'qris' ? 'selected' : '' }}>QRIS</option>
                            </select>
                            @error('metode_pembayaran')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-blue-300 transition-colors">
                            <label for="total_harga_display" class="block text-sm font-medium text-gray-700 mb-2">Total Price</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07-.34-.433-.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="total_harga_display" readonly
                                       class="bg-white pl-10 block w-full rounded-lg border-gray-300 shadow-sm h-12">
                                <input type="hidden" name="total_harga" id="total_harga">
                            </div>
                            @error('total_harga')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Court:</span>
                            <span class="font-medium">{{ $lapangan->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Booking Code:</span>
                            <span class="font-medium" id="summary-kode_booking">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium" id="summary-date">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Time:</span>
                            <span class="font-medium" id="summary-time">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Duration:</span>
                            <span class="font-medium" id="summary-duration">-</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between text-lg font-bold text-blue-600">
                            <span>Total:</span>
                            <span id="summary-total">Rp0</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" id="submit-button" disabled
                                class="w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-xl shadow-sm text-lg font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 disabled:bg-gray-400 disabled:cursor-not-allowed">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Confirm Booking
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@php
    $hargaPer2Jam = $lapangan->original_price ?? 10000;
@endphp

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Form loaded. Initializing JavaScript.');

        let hargaPer2Jam = JSON.parse(`@json($hargaPer2Jam)`);
        const durasiSelect = document.getElementById('durasi');
        const jamMulaiSelect = document.getElementById('jam_mulai');
        const jamSelesaiInput = document.getElementById('jam_selesai');
        const tanggalInput = document.getElementById('tanggal');
        const namaPemesanInput = document.getElementById('nama_pemesan');
        const nomorTeleponInput = document.getElementById('nomor_telepon');
        const emailInput = document.getElementById('email');
        const metodePembayaranSelect = document.getElementById('metode_pembayaran');
        const totalHargaDisplay = document.getElementById('total_harga_display');
        const totalHargaInput = document.getElementById('total_harga');
        const kodeBookingInput = document.getElementById('kode_booking');
        const submitButton = document.getElementById('submit-button');
        const summaryDate = document.getElementById('summary-date');
        const summaryTime = document.getElementById('summary-time');
        const summaryDuration = document.getElementById('summary-duration');
        const summaryTotal = document.getElementById('summary-total');
        const summaryKodeBooking = document.getElementById('summary-kode_booking');
        const noTimeslotsMessage = document.getElementById('no-timeslots-message');
        const sundayMessage = document.getElementById('sunday-message');
        const endTimeWarning = document.getElementById('end-time-warning');
        const loadingSpinner = document.getElementById('loading-spinner');
        const formError = document.getElementById('form-error');
        const courtPriceDisplay = document.getElementById('court-price');
        const lapanganId = document.querySelector('input[name="lapangan_mode_id"]').value;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!csrfToken) {
            console.error('CSRF token not found.');
            showError('Security error: CSRF token missing');
            return;
        }

        function showError(message) {
            if (formError) {
                formError.textContent = message;
                formError.classList.remove('hidden');
                formError.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function hideError() {
            if (formError) {
                formError.classList.add('hidden');
            }
        }

        function formatDate(dateString) {
            try {
                return new Date(dateString + 'T00:00:00').toLocaleDateString('en-US', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });
            } catch (e) {
                console.error('Error formatting date:', e);
                return '-';
            }
        }

        function calculateJamSelesai() {
            const jamMulai = jamMulaiSelect.value;
            const durasi = parseInt(durasiSelect.value) || 0;
            endTimeWarning.classList.add('hidden');

            if (!jamMulai || !durasi) return '';

            const [startHour, startMinute] = jamMulai.split(':').map(Number);
            const startDateTime = new Date();
            startDateTime.setHours(startHour, startMinute, 0, 0);

            const endDateTime = new Date(startDateTime.getTime() + durasi * 60 * 60 * 1000);
            const closingHour = 22;
            const closingTime = new Date(startDateTime);
            closingTime.setHours(closingHour, 0, 0, 0);

            if (endDateTime > closingTime) {
                endTimeWarning.classList.remove('hidden');
                return '';
            }

            return `${String(endDateTime.getHours()).padStart(2, '0')}:${String(endDateTime.getMinutes()).padStart(2, '0')}`;
        }

        function updateTotalHarga() {
            const durasi = parseInt(durasiSelect.value) || 0;
            const totalHarga = hargaPer2Jam * (durasi / 2);
            totalHargaDisplay.value = totalHarga ? `Rp${totalHarga.toLocaleString('id-ID')}` : '';
            totalHargaInput.value = totalHarga ? totalHarga.toFixed(2) : '';
            jamSelesaiInput.value = calculateJamSelesai();
            updateSummary();
            validateForm();
            console.log('Updated total harga:', { durasi, hargaPer2Jam, totalHarga });
        }

        function updateSummary() {
            summaryDate.textContent = tanggalInput.value ? formatDate(tanggalInput.value) : '-';
            const startTime = jamMulaiSelect.value;
            const endTime = jamSelesaiInput.value;
            summaryTime.textContent = (startTime && endTime) ? `${startTime} - ${endTime}` : '-';
            summaryDuration.textContent = durasiSelect.value ? `${durasiSelect.value} Hours` : '-';
            summaryTotal.textContent = totalHargaInput.value ? `Rp${parseFloat(totalHargaInput.value).toLocaleString('id-ID')}` : 'Rp0';
            summaryKodeBooking.textContent = kodeBookingInput.value || '-';
        }

        function validateForm() {
            const cleanedPhone = nomorTeleponInput.value.replace(/[^\d+]/g, '');
            const isSundaySelected = tanggalInput.value && (new Date(tanggalInput.value + 'T00:00:00').getDay() === 0);
            const isValidEmail = !emailInput.value || emailInput.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/);
            const isValid = tanggalInput.value &&
                !isSundaySelected &&
                durasiSelect.value &&
                jamMulaiSelect.value &&
                jamSelesaiInput.value &&
                endTimeWarning.classList.contains('hidden') &&
                namaPemesanInput.value.trim().length >= 2 &&
                cleanedPhone.match(/^\+?(\d{8,15})$/) &&
                metodePembayaranSelect.value &&
                parseFloat(totalHargaInput.value) > 0 &&
                kodeBookingInput.value &&
                isValidEmail;

            submitButton.disabled = !isValid;
            console.log('Form validation:', {
                isValid,
                tanggal: tanggalInput.value,
                isSunday: isSundaySelected,
                durasi: durasiSelect.value,
                jamMulai: jamMulaiSelect.value,
                jamSelesai: jamSelesaiInput.value,
                endTimeWarningHidden: endTimeWarning.classList.contains('hidden'),
                namaPemesan: namaPemesanInput.value.trim().length >= 2,
                nomorTelepon: cleanedPhone,
                email: isValidEmail,
                metodePembayaran: metodePembayaranSelect.value,
                totalHarga: parseFloat(totalHargaInput.value),
                kodeBooking: kodeBookingInput.value
            });
            return isValid;
        }

        async function fetchAvailableTimeSlots() {
            const date = tanggalInput.value;
            if (!date) return;

            try {
                loadingSpinner.classList.remove('hidden');
                jamMulaiSelect.disabled = true;
                durasiSelect.disabled = true;
                hideError();

                const isSunday = new Date(date + 'T00:00:00').getDay() === 0;
                if (isSunday) {
                    sundayMessage.classList.remove('hidden');
                    jamMulaiSelect.innerHTML = '<option value="" disabled selected>Select start time</option>';
                    noTimeslotsMessage.classList.add('hidden');
                    updateTotalHarga();
                    return;
                }
                sundayMessage.classList.add('hidden');

                const url = `/booking/timeslots?date=${encodeURIComponent(date)}&lapangan_mode_id=${encodeURIComponent(lapanganId)}`;
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error ${response.status}: ${response.statusText}`);
                }

                const { slots, hargaPer2Jam: serverPrice } = await response.json();
                console.log('Received from server:', { slots, serverPrice });
                hargaPer2Jam = serverPrice || hargaPer2Jam;
                courtPriceDisplay.textContent = `Rp${hargaPer2Jam.toLocaleString('id-ID')}`;

                jamMulaiSelect.innerHTML = '<option value="" disabled selected>Select start time</option>';
                if (!slots || slots.length === 0) {
                    noTimeslotsMessage.classList.remove('hidden');
                    noTimeslotsMessage.textContent = 'No available time slots for the selected date.';
                    return;
                }

                noTimeslotsMessage.classList.add('hidden');
                slots.filter(slot => slot.status === 'available').forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.time;
                    option.textContent = slot.time;
                    jamMulaiSelect.appendChild(option);
                });

                const oldJamMulai = "{{ old('jam_mulai') }}";
                if (oldJamMulai && slots.some(slot => slot.time === oldJamMulai)) {
                    jamMulaiSelect.value = oldJamMulai;
                }

                updateTotalHarga();
            } catch (error) {
                showError(`Failed to load time slots: ${error.message}`);
                console.error('Error fetching time slots:', error);
                jamMulaiSelect.innerHTML = '<option value="" disabled selected>No available time slots</option>';
                noTimeslotsMessage.classList.remove('hidden');
                noTimeslotsMessage.textContent = 'Unable to load time slots. Please try again later.';
            } finally {
                loadingSpinner.classList.add('hidden');
                jamMulaiSelect.disabled = false;
                durasiSelect.disabled = false;
                updateTotalHarga();
                validateForm();
            }
        }

        document.getElementById('booking-form').addEventListener('submit', async function (event) {
            event.preventDefault();
            if (!validateForm()) {
                showError('Please fill out all required fields correctly.');
                return;
            }

            try {
                // Generate a new kode_booking before submission
                kodeBookingInput.value = `BOOK-${Math.random().toString(36).substr(2, 9).toUpperCase()}`;
                summaryKodeBooking.textContent = kodeBookingInput.value;

                submitButton.disabled = true;
                loadingSpinner.classList.remove('hidden');
                hideError();

                const formData = new FormData(this);
                const formValues = Object.fromEntries(formData);
                console.log('Form submitted with data:', formValues);

                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error || `Booking failed: HTTP ${response.status}`);
                }

                window.location.href = '/booking/success';
            } catch (error) {
                showError(error.message);
                console.error('Form submission error:', error);
                submitButton.disabled = false;
                loadingSpinner.classList.add('hidden');
            }
        });

        nomorTeleponInput.addEventListener('input', () => {
            const phoneError = document.getElementById('phone-error') || document.createElement('p');
            phoneError.id = 'phone-error';
            phoneError.className = 'mt-2 text-sm text-red-600';
            const cleanedPhone = nomorTeleponInput.value.replace(/[^\d+]/g, '');
            if (!cleanedPhone.match(/^\+?(\d{8,15})$/)) {
                phoneError.textContent = 'Please enter a valid phone number (8-15 digits, may start with +)';
                nomorTeleponInput.after(phoneError);
            } else {
                phoneError.remove();
            }
            validateForm();
        });

        emailInput.addEventListener('input', validateForm);
        durasiSelect.addEventListener('change', updateTotalHarga);
        jamMulaiSelect.addEventListener('change', updateTotalHarga);
        tanggalInput.addEventListener('change', fetchAvailableTimeSlots);
        namaPemesanInput.addEventListener('input', validateForm);
        nomorTeleponInput.addEventListener('input', validateForm);
        metodePembayaranSelect.addEventListener('change', validateForm);

        // Initial fetch and validation
        fetchAvailableTimeSlots().then(() => {
            validateForm();
            updateTotalHarga();
        });
    });
</script>
@endsection