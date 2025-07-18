@extends('layouts.app')

@section('title', 'Schedule Booking')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Schedule Your Booking</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Date Picker -->
        <div class="mb-8 bg-white rounded-2xl shadow-xl p-6">
            <form id="date-form" action="{{ route('booking.schedule') }}" method="GET">
                <div class="flex items-center space-x-4">
                    <label for="date" class="text-sm font-medium text-gray-700">Select Date</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="date" name="date" id="date" value="{{ $selectedDate }}"
                               class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-12"
                               min="{{ \Carbon\Carbon::today()->toDateString() }}"
                               required>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
                @error('date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <!-- Courts and Time Slots -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($fields as $field)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <div class="md:flex">
                        <div class="md:w-1/3 relative">
                            @if ($field->image)
                                <img class="h-48 w-full md:h-full object-cover"
                                     src="{{ asset('storage/' . $field->image) }}"
                                     alt="{{ $field->name }}">
                            @else
                                <div class="h-48 w-full md:h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 md:w-2/3">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full uppercase tracking-wide">{{ $field->category ?? 'Standard' }}</span>
                            <h2 class="mt-3 text-xl font-bold text-gray-900">{{ $field->name }}</h2>
                            <p class="mt-2 text-gray-600">{{ $field->location }}</p>
                            <p class="mt-2 text-gray-600">Rp{{ number_format($field->original_price ?? 10000, 0, ',', '.') }} / 2 hours</p>
                            @if ($field->rating)
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($field->rating, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="px-6 pb-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Available Time Slots</h3>
                        @if ($field->isAvailable)
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($field->availableTimeSlots as $slot)
                                    @if ($slot['status'] === 'available')
                                        <a href="{{ route('booking.form', [
                                            'field' => $field->id,
                                            'date' => $selectedDate,
                                            'jam_mulai' => $slot['time'],
                                            'jam_selesai' => $slot['end_time']
                                        ]) }}"
                                           class="block text-center py-2 px-4 rounded-lg border border-gray-200 text-sm font-medium text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition-colors">
                                            {{ $slot['time'] }} - {{ $slot['end_time'] }}
                                        </a>
                                    @else
                                        <div class="block text-center py-2 px-4 rounded-lg border border-gray-200 text-sm font-medium text-gray-400 bg-gray-100 cursor-not-allowed">
                                            {{ $slot['time'] }} - {{ $slot['end_time'] }} ({{ $slot['status'] === 'booked' ? 'Booked' : 'Unavailable' }})
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No available time slots for this date.</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No courts available.</p>
            @endforelse
        </div>
    </div>
</div>

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('date');
        dateInput.addEventListener('change', function () {
            document.getElementById('date-form').submit();
        });
    });
</script>
@endsection