@extends('layouts.app')

@section('title', 'Book ' . $lapangan->name)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header with court image and details -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full md:h-full md:w-48 object-cover" 
                         src="{{ asset('images/sports-court.jpg') }}" 
                         alt="{{ $lapangan->name }}">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-blue-600 font-semibold">{{ $lapangan->name }}</div>
                    <h1 class="mt-2 text-2xl font-extrabold text-gray-900">Book {{ $lapangan->name }}</h1>
                    <p class="mt-2 text-gray-600">GOR Serbaguna • {{ $lapangan->location ?? 'Unknown Location' }}</p>
                    <div class="mt-4">
                        <span class="text-2xl font-bold text-blue-600">
                            Rp{{ number_format($lapangan->discounted_price ?? $lapangan->harga, 0, ',', '.') }}
                        </span>
                        <span class="text-sm text-gray-500">/ 2 hours</span>
                        @if($lapangan->discounted_price)
                            <span class="ml-2 text-sm line-through text-gray-400">
                                Rp{{ number_format($lapangan->harga, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <form action="{{ route('booking.store') }}" method="POST" id="booking-form" class="p-6 sm:p-8 space-y-6">
                @csrf
                <input type="hidden" name="lapangan_mode_id" value="{{ $lapangan->id }}">

                <h2 class="text-xl font-bold text-gray-900 border-b pb-3">Booking Details</h2>

                <!-- Date and Time Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date Input -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Booking Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $selectedDate) }}"
                                   min="{{ now()->toDateString() }}" required
                                   class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration Input -->
                    <div>
                        <label for="durasi" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <select name="durasi" id="durasi" required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="" disabled selected>Select duration</option>
                            <option value="2" {{ old('durasi') === '2' ? 'selected' : '' }}>2 Hours</option>
                            <option value="4" {{ old('durasi') === '4' ? 'selected' : '' }}>4 Hours</option>
                            <option value="6" {{ old('durasi') === '6' ? 'selected' : '' }}>6 Hours</option>
                        </select>
                        @error('durasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Time Input -->
                    <div class="md:col-span-2">
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                        <select name="jam_mulai" id="jam_mulai" required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="" disabled selected>Please select a duration first</option>
                        </select>
                        @error('jam_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Personal Information Section -->
                <h2 class="text-xl font-bold text-gray-900 border-b pb-3">Your Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Input -->
                    <div>
                        <label for="nama_pemesan" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}" required
                                   class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        @error('nama_pemesan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Input -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-1">Declaration Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                   class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        @error('nomor_telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (Optional)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Payment Section -->
                <h2 class="text-xl font-bold text-gray-900 border-b pb-3">Payment</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Payment Method Input -->
                    <div>
                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="" disabled selected>Select payment method</option>
                            <option value="cash" {{ old('metode_pembayaran') === 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="transfer" {{ old('metode_pembayaran') === 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="qris" {{ old('metode_pembayaran') === 'qris' ? 'selected' : '' }}>QRIS</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label for="total_harga_display" class="block text-sm font-medium text-gray-700 mb-1">Total Price</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="total_harga_display" readonly
                                   class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm">
                            <input type="hidden" name="total_harga" id="total_harga">
                        </div>
                        @error('total_harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-6 border border-transparent rounded-xl shadow-sm text-lg font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@php
    $hargaPer2Jam = $lapangan->discounted_price ?? $lapangan->original_price ?? 0;
    $availableTimeSlots = $lapangan->availableTimeSlots ?? [];
    $oldJamMulai = old('jam_mulai');
@endphp

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const hargaPer2Jam = JSON.parse(`@json($hargaPer2Jam)`);
        const availableTimeSlots = JSON.parse(`@json($availableTimeSlots)`);
        const oldJamMulai = `@json($oldJamMulai)`;

        const durasiSelect = document.getElementById('durasi');
        const jamMulaiSelect = document.getElementById('jam_mulai');
        const totalHargaDisplay = document.getElementById('total_harga_display');
        const totalHargaInput = document.getElementById('total_harga');

        const endHour = 22;

        function updateTimeSlots() {
            const durasi = parseInt(durasiSelect.value) || 0;
            jamMulaiSelect.innerHTML = '<option value="" disabled selected>Select start time</option>';

            if (!durasi || !Array.isArray(availableTimeSlots)) {
                updateTotalHarga();
                return;
            }

            let hasValidSlots = false;
            availableTimeSlots.forEach(slot => {
                if (slot.status !== 'available') return;

                const startTime = parseInt(slot.time.split(':')[0], 10);
                const endTime = startTime + durasi;

                if (Number.isInteger(startTime) && endTime <= endHour) {
                    const option = document.createElement('option');
                    option.value = slot.time;
                    option.textContent = `${slot.time} - ${String(endTime).padStart(2, '0')}:00`;
                    if (slot.time === oldJamMulai) {
                        option.selected = true;
                    }
                    jamMulaiSelect.appendChild(option);
                    hasValidSlots = true;
                }
            });

            const submitButton = document.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = !hasValidSlots;
            }

            updateTotalHarga();
        }

        function updateTotalHarga() {
            const durasi = parseInt(durasiSelect.value) || 0;
            const totalHarga = hargaPer2Jam * (durasi / 2);
            totalHargaDisplay.value = totalHarga ? `Rp${totalHarga.toLocaleString('id-ID')}` : '';
            totalHargaInput.value = totalHarga || '';
        }

        // Event listeners
        durasiSelect.addEventListener('change', updateTimeSlots);
        jamMulaiSelect.addEventListener('change', updateTotalHarga);

        // Focus animation
        document.querySelectorAll('input:not([type="hidden"]), select').forEach(el => {
            el.addEventListener('focus', () => {
                const wrapper = el.closest('.relative') || el.parentElement;
                if (wrapper) wrapper.classList.add('ring-2', 'ring-blue-200', 'transition', 'duration-200');
            });
            el.addEventListener('blur', () => {
                const wrapper = el.closest('.relative') || el.parentElement;
                if (wrapper) wrapper.classList.remove('ring-2', 'ring-blue-200', 'transition', 'duration-200');
            });
        });

        // Initialize form
        updateTimeSlots();
    });
</script>
@endsection
