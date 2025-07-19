@extends('layouts.app')

@section('title', 'Booking Success')

@section('content')
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #e0e7ff;
            --success: #10b981;
            --success-light: #d1fae5;
            --dark: #1f2937;
            --light: #f9fafb;
            --gray: #6b7280;
            --gray-light: #f3f4f6;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }
        
        .header-font {
            font-family: 'Playfair Display', serif;
        }
        
        .success-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
        
        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(135deg, var(--primary) 0%, #3a0ca3 100%);
            z-index: -1;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            position: relative;
            top: -40px;
        }
        
        .success-icon svg {
            width: 40px;
            height: 40px;
            color: var(--success);
        }
        
        .booking-ref {
            background: var(--primary-light);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .detail-card:hover {
            transform: translateY(-5px);
        }
        
        .detail-label {
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
        }
        
        .detail-value {
            font-weight: 600;
            color: var(--dark);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #3a0ca3 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }
        
        .btn-outline {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary-light);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            color: var(--primary);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .status-confirmed {
            background: var(--success-light);
            color: var(--success);
        }
        
        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
            margin: 20px 0;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>



<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">
        <!-- Success Card -->
        <div class="success-card p-6">
            <!-- Success Icon -->
            <div class="success-icon floating">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            
            <!-- Header Content -->
            <div class="text-center mt-6">
                <h1 class="header-font text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
                <p class="text-gray-600 mb-6">Your reservation at <span class="font-medium">GOR Serbaguna</span> has been successfully confirmed</p>
                
                <div class="booking-ref mb-8">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    {{ $booking->kode_booking ?? 'N/A' }}
                </div>
            </div>
            
            <!-- Booking Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="detail-card">
                    <div class="detail-label">Court</div>
                    <div class="detail-value mt-1">{{ $booking->lapanganMode->name ?? 'N/A' }}</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label">Date</div>
                    <div class="detail-value mt-1">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label">Time Slot</div>
                    <div class="detail-value mt-1">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label">Amount</div>
                    <div class="detail-value mt-1 text-primary">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <!-- Status and Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="mb-4 sm:mb-0">
                    <span class="status-badge @if($booking->status === 'confirmed') status-confirmed @else status-pending @endif">
                        <i class="fas @if($booking->status === 'confirmed') fa-check-circle @else fa-clock @endif mr-2"></i>
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                
                <div class="flex space-x-3">
                    <button onclick="window.print()" class="btn-outline">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                    <a href="{{ route('home') }}" class="btn-primary">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Additional Information -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>Need help? <a href="mailto:support@gorserbaguna.com" class="text-primary font-medium">Contact our support team</a></p>
            <p class="mt-1">We've sent the booking details to your email</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to elements
        const animateElements = document.querySelectorAll('.detail-card');
        animateElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            }, 100);
        });
    });
</script>
@endsection