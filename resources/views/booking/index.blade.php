@extends('layouts.app')

@section('title', 'Sports Court Booking')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-8 md:p-12 mb-16 text-white overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 bg-grid-white/[0.05]"></div>
            <!-- Animated floating circles -->
            <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-blue-500 opacity-10 blur-xl animate-float-slow"></div>
            <div class="absolute bottom-1/3 right-1/4 w-48 h-48 rounded-full bg-blue-400 opacity-10 blur-xl animate-float-delay"></div>
        </div>
        
        <!-- Content container -->
        <div class="relative z-10 max-w-3xl">
            <!-- Headline with subtle text shine -->
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                <span class="relative inline-block">
                    <span class="absolute inset-0 bg-gradient-to-r from-white/30 to-transparent opacity-20 rounded-full blur-md"></span>
                    Match Ready? Book Your Court Today!
                </span>
            </h1>
            <!-- Subheading with smooth transition -->
            <p class="text-lg md:text-xl mb-8 opacity-90 transition-opacity hover:opacity-100 max-w-2xl">
                Book futsal, volleyball, basketball, or badminton courts in your area — fast and hassle-free
            </p>
            <!-- Empty container with subtle border -->
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="h-px w-full sm:h-full sm:w-px bg-white/10"></div>
            </div>
        </div>
        
        <!-- Decorative corner accents -->
        <div class="absolute top-0 right-0 w-32 h-32 border-t-2 border-r-2 border-white/10 rounded-tr-3xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 border-b-2 border-l-2 border-white/10 rounded-bl-3xl"></div>
    </div>

    <!-- Availability Filter -->
    <div class="mb-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Available Fields</h2>
                <p class="text-gray-600">Browse through our premium selection of futsal venues</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button class="filter-btn active" data-filter="all">
                    <span class="availability-dot all"></span> All
                </button>
                <button class="filter-btn" data-filter="available">
                    <span class="availability-dot available"></span> Available
                </button>
                <button class="filter-btn" data-filter="booked">
                    <span class="availability-dot booked"></span> Booked
                </button>
            </div>
        </div>
    </div>

    <!-- Fields Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($fields as $lapangan)
            <div class="field-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100"
                data-field-type="{{ $lapangan->name ?? '' }}"
                data-availability="{{ $lapangan->isAvailable ? 'available' : 'booked' }}">
                <!-- Court Image with Status Badge -->
                <div class="relative h-52 overflow-hidden">
                    @if ($lapangan->image)
                        <img src="{{ asset('storage/' . $lapangan->image) }}" alt="{{ $lapangan->name }}" 
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $lapangan->isAvailable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $lapangan->isAvailable ? 'Available' : 'Booked' }}
                        </span>
                    </div>

                    <!-- Rating Badge -->
                    @if($lapangan->rating)
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-sm font-bold flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span>{{ number_format($lapangan->rating, 1) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Court Details -->
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">{{ $lapangan->name }}</h3>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>{{ $lapangan->distance ?? '0.5' }} km</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $lapangan->description }}</p>
                    <!-- Price Section -->
                    <div class="mb-4">
                        @if($lapangan->original_price > $lapangan->discounted_price)
                            <span class="text-xs text-gray-400 line-through mr-1">
                                Rp{{ number_format($lapangan->original_price, 0, ',', '.') }}
                            </span>
                        @endif
                        <span class="text-lg font-bold text-blue-600">
                            Rp{{ number_format($lapangan->discounted_price, 0, ',', '.') }}
                        </span>
                        <span class="text-sm text-gray-500">/ 2 hours</span>
                    </div>
                    <!-- Action Button -->
                    <div class="mt-4">
                        @if ($lapangan->isAvailable)
                            <a href="{{ route('booking.form', $lapangan->id) }}" 
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-2.5 px-4 rounded-lg font-medium flex items-center justify-center transition-all shadow-md hover:shadow-lg">
                                <i class="fas fa-calendar-alt mr-2"></i> Book Now
                            </a>
                        @else
                            <button disabled
                                class="w-full bg-gray-200 text-gray-500 py-2.5 px-4 rounded-lg font-medium cursor-not-allowed flex items-center justify-center">
                                <i class="fas fa-calendar-times mr-2"></i> Booked
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16" id="no-results">
                <div class="mx-auto max-w-md">
                    <div class="w-24 h-24 mx-auto mb-6 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No fields found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your search or filters to find what you're looking for.</p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        Clear filters
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Map Section -->
    <div class="mt-20 bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2 p-8 md:p-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Find the Perfect Location</h2>
                <p class="text-gray-600 mb-6">Our fields are strategically located across the city for your convenience. Browse the map to find the most accessible venue for your next match.</p>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="font-medium text-gray-900">Central Locations</h4>
                            <p class="text-gray-600 text-sm">All fields are within 5km of city centers</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i class="fas fa-parking"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="font-medium text-gray-900">Ample Parking</h4>
                            <p class="text-gray-600 text-sm">Free parking available at most locations</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                                <i class="fas fa-subway"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="font-medium text-gray-900">Public Transport</h4>
                            <p class="text-gray-600 text-sm">Easy access via bus and train routes</p>
                        </div>
                    </div>
                </div>
                <button class="mt-8 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition flex items-center font-medium shadow-sm hover:shadow-md">
                    <i class="fas fa-map-marked-alt mr-2"></i> View All Locations
                </button>
            </div>
            <div class="md:w-1/2 h-96 md:h-auto">
                <div class="h-full w-full">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260352528!2d{{ $fields->first()->longitude ?? '106.8456' }}!3d{{ $fields->first()->latitude ?? '-6.2088' }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{{ $fields->first()->latitude ?? '-6.2088' }},{{ $fields->first()->longitude ?? '106.8456' }}!5e0!3m2!1sen!2sid!4v1678888888888!5m2!1sen!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-20">
        <div class="text-center mb-12">
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800 mb-4">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">The Best Futsal Booking Experience</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">We're committed to providing seamless booking, premium facilities, and exceptional service for futsal enthusiasts.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 hover:border-blue-200">
                <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Instant Confirmation</h3>
                <p class="text-gray-600">Get immediate booking confirmation with real-time availability updates for all fields.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 hover:border-blue-200">
                <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600 mb-4">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Verified Venues</h3>
                <p class="text-gray-600">All our partner fields undergo strict quality checks to ensure premium playing conditions.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 hover:border-blue-200">
                <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 mb-4">
                    <i class="fas fa-headset text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                <p class="text-gray-600">Our dedicated team is always ready to assist with any inquiries or booking changes.</p>
            </div>
        </div>
    </div>
</div>

<style>
.availability-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 6px;
}
.availability-dot.available { background-color: #10B981; }
.availability-dot.booked { background-color: #EF4444; }
.availability-dot.all { background-color: #64748B; }

.filter-btn {
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    background-color: #F8FAFC;
    color: #64748B;
    border: 1px solid #E2E8F0;
    transition: all 0.2s;
    display: flex;
    align-items: center;
}
.filter-btn:hover {
    background-color: #F1F5F9;
    border-color: #CBD5E1;
}
.filter-btn.active {
    background-color: #EFF6FF;
    color: #1E40AF;
    border-color: #BFDBFE;
}

.field-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.field-card:hover {
    transform: translateY(-5px);
}

.animate-float-slow {
    animation: float 12s ease-in-out infinite;
}
.animate-float-delay {
    animation: float 10s ease-in-out 3s infinite;
}
@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(20px, 20px) rotate(5deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const fieldCards = document.querySelectorAll('.field-card');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            const filter = button.dataset.filter;
            let visibleCount = 0;
            fieldCards.forEach(card => {
                const matchesFilter = filter === 'all' || card.dataset.availability === filter;
                if (matchesFilter) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            document.getElementById('no-results').style.display = visibleCount ? 'none' : 'block';
        });
    });
});
</script>
@endsection