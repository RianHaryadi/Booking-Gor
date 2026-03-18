@extends('layouts.app')
@section('title', 'Booking Arena ' . $lapangan->name)

@section('content')
<div style="padding-top:120px; padding-bottom:100px; padding-left:7vw; padding-right:7vw; max-width:1400px; margin:0 auto; position:relative; z-index:10">
    
    {{-- Decorative Background Elements --}}
    <div class="mono" style="position:fixed; top:15%; right:-5%; font-size:15rem; color:rgba(255,255,255,0.02); z-index:-1; pointer-events:none; font-weight:900; line-height:1">RESERVE</div>
    
    {{-- Header Section --}}
    <div class="fx-reveal" style="margin-bottom:60px; display:flex; justify-content:space-between; align-items:flex-end; gap:30px; flex-wrap:wrap">
        <div>
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px">
                <span class="tag-mono">STEP_02</span>
                <span class="mono" style="font-size:0.65rem; color:var(--muted); letter-spacing:0.2em">CONFIRM_ARENA_RESERVATION</span>
            </div>
            <h1 class="display" style="font-size:clamp(2.5rem, 6vw, 4.5rem); color:#fff; margin:0">FORM <span class="text-accent-stroke">BOOKING</span></h1>
            <p class="mono" style="color:var(--muted); font-size:0.8rem; margin-top:10px; max-width:600px">
                {{ $lapangan->name }} <span style="color:var(--primary); margin:0 10px">/</span> {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </p>
        </div>
        <a href="{{ route('booking.index') }}" class="btn-outline" style="text-decoration:none">
            <i class="fas fa-arrow-left" style="margin-right:10px"></i>KEMBALI KE LIST
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('error'))
    <div class="glass fx-reveal delay-1" style="padding:20px; border-left:4px solid #EF4444; margin-bottom:30px; display:flex; align-items:center; gap:15px; background:rgba(239, 68, 68, 0.05)">
        <i class="fas fa-exclamation-triangle" style="color:#EF4444"></i>
        <span class="mono" style="font-size:0.8rem; color:#fff">{{ session('error') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="glass fx-reveal delay-1" style="padding:24px; border-left:4px solid #EF4444; margin-bottom:30px; background:rgba(239, 68, 68, 0.05)">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:15px">
            <i class="fas fa-microchip" style="color:#EF4444"></i>
            <span class="mono" style="font-weight:700; font-size:0.8rem">SYSTEM_VALIDATION_ERROR:</span>
        </div>
        <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px">
            @foreach($errors->all() as $error)
            <li class="mono" style="font-size:0.75rem; color:rgba(255,255,255,0.7); display:flex; align-items:center; gap:8px">
                <span style="width:4px; height:4px; background:#EF4444"></span>{{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="display:grid; grid-template-columns:1fr 400px; gap:40px" class="booking-grid">
        
        {{-- Left: Main Form Content --}}
        <div class="fx-reveal delay-1">
            <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                @csrf
                <input type="hidden" name="lapangan_mode_id" value="{{ $lapangan->id }}">
                <input type="hidden" name="tanggal" value="{{ $selectedDate }}">
                <input type="hidden" name="kode_booking" id="kode_booking_hidden" value="{{ $bookingData['kode_booking'] ?? 'BK' . strtoupper(Str::random(6)) }}">
                <input type="hidden" name="durasi" id="durasi_hidden" value="{{ $bookingData['durasi'] ?? 2 }}">
                <input type="hidden" name="jam_selesai" id="jam_selesai_hidden" value="{{ $bookingData['jam_selesai'] ?? '' }}">
                <input type="hidden" name="total_harga" id="total_harga_hidden" value="{{ $bookingData['total_harga'] ?? 0 }}">
                <input type="hidden" name="jam_mulai" id="jam_mulai_input" value="{{ $bookingData['jam_mulai'] ?? '' }}">

                {{-- Slot Selection Panel --}}
                <div class="glass" style="padding:40px; border-radius:4px; margin-bottom:30px; position:relative">
                    <div class="corner-accent corner-tl"></div>
                    <div class="corner-accent corner-br"></div>
                    
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px">
                        <div style="display:flex; align-items:center; gap:15px">
                            <i class="fas fa-clock" style="color:var(--primary); font-size:1.2rem"></i>
                            <h2 class="mono" style="font-size:0.9rem; font-weight:700; margin:0">SELECT_TIME_SLOT</h2>
                        </div>
                        <div style="display:flex; gap:15px">
                            <div style="display:flex; align-items:center; gap:6px">
                                <span style="width:8px; height:8px; background:var(--primary)"></span>
                                <span class="mono" style="font-size:0.6rem; color:var(--muted)">AVAILABLE</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:6px">
                                <span style="width:8px; height:8px; background:var(--muted)"></span>
                                <span class="mono" style="font-size:0.6rem; color:var(--muted)">RESERVED</span>
                            </div>
                        </div>
                    </div>

                    <div id="slots-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(100px, 1fr)); gap:12px">
                        @foreach($lapangan->availableTimeSlots as $slot)
                            @php
                                $isAvailable = $slot['status'] === 'available';
                                $isPreselected = ($bookingData['jam_mulai'] ?? '') == $slot['time'];
                            @endphp
                            <div class="time-slot-item {{ $isAvailable ? 'available' : 'unavailable' }} {{ $isPreselected ? 'selected' : '' }}"
                                 onclick="{{ $isAvailable ? 'selectTimeSlot(this)' : '' }}"
                                 data-time="{{ $slot['time'] }}"
                                 data-end="{{ $slot['end_time'] }}"
                                 data-price="{{ $lapangan->original_price }}"
                                 style="padding:15px; border:1px solid var(--border); background:rgba(255,255,255,0.02); cursor:{{ $isAvailable ? 'pointer' : 'not-allowed' }}; transition:all 0.3s; text-align:center; position:relative; overflow:hidden">
                                
                                @if(!$isAvailable)
                                <div style="position:absolute; inset:0; background:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; z-index:5">
                                    <i class="fas fa-lock" style="font-size:0.7rem; color:var(--muted)"></i>
                                </div>
                                @endif

                                <div class="mono" style="font-size:0.9rem; font-weight:700; color:{{ $isAvailable ? '#fff' : 'var(--muted)' }}; position:relative; z-index:2">
                                    {{ substr($slot['time'], 0, 5) }}
                                </div>
                                <div class="mono" style="font-size:0.55rem; color:var(--muted); margin-top:4px; position:relative; z-index:2">
                                    TO {{ substr($slot['end_time'], 0, 5) }}
                                </div>

                                @if($isAvailable)
                                <div class="slot-hover-bg" style="position:absolute; bottom:0; left:0; right:0; height:0; background:var(--primary); transition:all 0.3s; z-index:1; opacity:0.1"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div id="no-slots-msg" style="display:{{ empty($lapangan->availableTimeSlots) ? 'block' : 'none' }}; text-align:center; padding:40px">
                        <i class="fas fa-calendar-times" style="font-size:2rem; color:var(--muted); display:block; margin-bottom:15px"></i>
                        <span class="mono" style="font-size:0.8rem; color:var(--muted)">NO_SLOTS_AVAILABLE_FOR_SELECTED_DATE</span>
                    </div>
                </div>

                {{-- Personal Data Panel --}}
                <div class="glass" style="padding:40px; border-radius:4px; margin-bottom:30px; position:relative">
                    <div class="corner-accent corner-tl"></div>
                    <div style="display:flex; align-items:center; gap:15px; margin-bottom:35px">
                        <i class="fas fa-id-card" style="color:var(--primary); font-size:1.2rem"></i>
                        <h2 class="mono" style="font-size:0.9rem; font-weight:700; margin:0">PERSONAL_RESERVATION_DATA</h2>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:25px" class="form-fields">
                        <div style="grid-column:1/-1">
                            <label class="mono" style="font-size:0.6rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.2em; display:block; margin-bottom:10px">PLAYER_FULL_NAME</label>
                            <input type="text" name="nama_pemesan" class="input-raw" style="width:100%" placeholder="ENTER NAME" value="{{ old('nama_pemesan', $bookingData['nama_pemesan'] ?? '') }}" required>
                        </div>
                        <div>
                            <label class="mono" style="font-size:0.6rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.2em; display:block; margin-bottom:10px">COMMUNICATION_LINE (HP)</label>
                            <input type="tel" name="nomor_telepon" class="input-raw" style="width:100%" placeholder="0812XXXXXXXX" value="{{ old('nomor_telepon', $bookingData['nomor_telepon'] ?? '') }}" required>
                        </div>
                        <div>
                            <label class="mono" style="font-size:0.6rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.2em; display:block; margin-bottom:10px">ELECTRONIC_MAIL</label>
                            <input type="email" name="email" class="input-raw" style="width:100%" placeholder="EMAIL@DOMAIN.COM" value="{{ old('email', $bookingData['email'] ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- Payment Panel --}}
                <div class="glass" style="padding:40px; border-radius:4px; position:relative">
                    <div class="corner-accent corner-tl"></div>
                    <div style="display:flex; align-items:center; gap:15px; margin-bottom:35px">
                        <i class="fas fa-credit-card" style="color:var(--primary); font-size:1.2rem"></i>
                        <h2 class="mono" style="font-size:0.9rem; font-weight:700; margin:0">PAYMENT_GATEWAY_SELECTION</h2>
                    </div>

                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr)); gap:15px">
                        @foreach([
                            ['cash', 'CASH_DIRECT', 'fa-money-bill-wave'],
                            ['transfer', 'BANK_TRANSFER', 'fa-university'],
                            ['qris', 'QRIS_SCAN', 'fa-qrcode'],
                            ['ewallet', 'E_WALLET', 'fa-mobile-alt']
                        ] as [$val, $lbl, $ico])
                        <label style="cursor:pointer">
                            <input type="radio" name="metode_pembayaran" value="{{ $val }}" style="display:none" class="payment-radio" {{ old('metode_pembayaran', $bookingData['metode_pembayaran'] ?? 'cash') === $val ? 'checked' : '' }}>
                            <div class="payment-card {{ old('metode_pembayaran', $bookingData['metode_pembayaran'] ?? 'cash') === $val ? 'selected' : '' }}" 
                                 style="padding:20px; border:1px solid var(--border); text-align:center; background:rgba(255,255,255,0.02); transition:all 0.3s">
                                <i class="fas {{ $ico }}" style="font-size:1.2rem; margin-bottom:12px; display:block; color:var(--muted); transition:color 0.3s"></i>
                                <span class="mono" style="font-size:0.6rem; color:var(--muted); transition:color 0.3s">{{ $lbl }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        {{-- Right: Reservation Summary Sticky --}}
        <div class="fx-reveal delay-2">
            <div style="position:sticky; top:110px">
                <div class="glass" style="padding:0; border-radius:4px; overflow:hidden">
                    {{-- Small Banner --}}
                    <div style="height:8px; background:linear-gradient(90deg, var(--primary), var(--accent))"></div>
                    
                    <div style="padding:40px">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:30px">
                            <div>
                                <span class="tag-mono" style="margin-bottom:8px; display:inline-block">SUMMARY_REPORT</span>
                                <h3 class="display" style="font-size:1.8rem; margin:0; letter-spacing:0.05em">{{ $lapangan->name }}</h3>
                                <p class="mono" style="font-size:0.6rem; color:var(--muted); margin-top:5px">LOC: {{ $lapangan->location }}</p>
                            </div>
                            <div style="text-align:right">
                                <i class="fas fa-shield-alt" style="color:var(--accent); font-size:1rem"></i>
                            </div>
                        </div>

                        <div style="background:rgba(255,255,255,0.02); padding:20px; border:1px solid var(--border); margin-bottom:30px">
                            <div style="display:flex; flex-direction:column; gap:15px">
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span class="mono" style="font-size:0.65rem; color:var(--muted)">DATE_RESERVE</span>
                                    <span class="mono" style="font-size:0.75rem; color:#fff">{{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span class="mono" style="font-size:0.65rem; color:var(--muted)">TIME_SLOT</span>
                                    <span id="label-time" class="mono" style="font-size:0.75rem; color:var(--accent)">PENDING_SELECTION</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span class="mono" style="font-size:0.65rem; color:var(--muted)">DURATION_TKN</span>
                                    <span id="label-duration" class="mono" style="font-size:0.75rem; color:#fff">--</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px dashed var(--border); padding-top:15px; margin-top:5px">
                                    <span class="mono" style="font-size:0.65rem; color:var(--muted)">UNIT_PRICE</span>
                                    <span class="mono" style="font-size:0.75rem; color:#fff">Rp{{ number_format($lapangan->original_price, 0, ',', '.') }} <span style="font-size:0.5rem">/2H</span></span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom:30px">
                            <div class="mono" style="font-size:0.6rem; color:var(--muted); text-transform:uppercase; margin-bottom:10px">TOTAL_AMOUNT_TO_PAY</div>
                            <div id="label-total" class="display" style="font-size:2.8rem; color:#fff">Rp 0</div>
                            <div class="mono" style="font-size:0.55rem; color:var(--primary); margin-top:5px">*TAX_INCLUDED_SECURE_TRANSACTION</div>
                        </div>

                        <button type="button" onclick="document.getElementById('booking-form').submit()" id="btn-submit" class="btn-cyber" style="width:100%; justify-content:center; padding:18px" disabled>
                            INITIALIZE_BOOKING <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    
                    <div style="padding:15px 40px; background:rgba(0,0,0,0.3); border-top:1px solid var(--border)">
                        <div style="display:flex; align-items:center; gap:10px">
                            <div style="width:8px; height:8px; border-radius:50%; background:{{ $lapangan->isAvailable ? 'var(--accent)' : '#EF4444' }}; box-shadow:0 0 10px {{ $lapangan->isAvailable ? 'var(--accent)' : '#EF4444' }}"></div>
                            <span class="mono" style="font-size:0.55rem; color:var(--muted)">ARENA_STATUS: {{ $lapangan->isAvailable ? 'ONLINE_READY' : 'OFFLINE_BUSY' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .time-slot-item:hover:not(.unavailable) {
        border-color: var(--primary);
        background: rgba(var(--primary-rgb), 0.05);
    }
    .time-slot-item.selected {
        border-color: var(--primary);
        background: rgba(93, 95, 239, 0.1);
        box-shadow: inset 0 0 15px rgba(93, 95, 239, 0.2);
    }
    .time-slot-item.selected .mono {
        color: var(--accent) !important;
    }
    .time-slot-item.selected::after {
        content: '';
        position: absolute;
        bottom: 0; right: 0;
        border-style: solid;
        border-width: 0 0 12px 12px;
        border-color: transparent transparent var(--primary) transparent;
    }

    .payment-card:hover:not(.selected) {
        border-color: rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
    }
    .payment-card.selected {
        border-color: var(--primary);
        background: rgba(93, 95, 239, 0.05);
    }
    .payment-card.selected i {
        color: var(--accent) !important;
    }
    .payment-card.selected span {
        color: #fff !important;
    }

    @media (max-width: 1024px) {
        .booking-grid { grid-template-columns: 1fr !important; }
        .form-fields { grid-template-columns: 1fr !important; }
    }

    #btn-submit:disabled {
        background: #1a1a1a;
        color: #444;
        cursor: not-allowed;
        transform: none !important;
        clip-path: none;
        border: 1px solid #333;
    }
</style>

<script>
    function selectTimeSlot(el) {
        // Clear previous selection
        document.querySelectorAll('.time-slot-item').forEach(item => item.classList.remove('selected'));
        
        // Add selected class
        el.classList.add('selected');
        
        // Update hidden inputs
        const startTime = el.dataset.time;
        const endTime = el.dataset.end;
        const price = parseInt(el.dataset.price);
        const duration = 2; // Fixed interval as per controller
        const total = price * (duration / 2);

        document.getElementById('jam_mulai_input').value = startTime;
        document.getElementById('jam_selesai_hidden').value = endTime;
        document.getElementById('durasi_hidden').value = duration;
        document.getElementById('total_harga_hidden').value = total;

        // Update Labels
        document.getElementById('label-time').innerText = startTime.substring(0, 5) + ' - ' + endTime.substring(0, 5);
        document.getElementById('label-duration').innerText = duration + 'H';
        document.getElementById('label-total').innerText = 'Rp ' + total.toLocaleString('id-ID');

        // Enable button
        document.getElementById('btn-submit').disabled = false;
        
        // Visual feedback
        console.log('Slot selected:', startTime);
    }

    // Payment radio listener
    document.querySelectorAll('.payment-radio').forEach(radio => {
        radio.addEventListener('change', (e) => {
            document.querySelectorAll('.payment-card').forEach(card => card.classList.remove('selected'));
            e.target.closest('label').querySelector('.payment-card').classList.add('selected');
        });
    });

    // Handle pre-filled data if returning from validation error
    document.addEventListener('DOMContentLoaded', () => {
        const prefilledTime = "{{ old('jam_mulai', $bookingData['jam_mulai'] ?? '') }}";
        if (prefilledTime) {
            const el = document.querySelector(`.time-slot-item[data-time="${prefilledTime}"]`);
            if (el && el.classList.contains('available')) {
                selectTimeSlot(el);
            }
        }
    });
</script>
@endsection