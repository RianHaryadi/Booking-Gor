@extends('layouts.app')
@section('title', 'Lacak Reservasi — SPORTIVA')

@section('content')
<div style="min-height:90vh; display:flex; align-items:center; justify-content:center; padding:80px 24px; position:relative; overflow:hidden; z-index:10">
    {{-- Decorative Background --}}
    <div class="mono" style="position:fixed; top:20%; right:-8%; font-size:18rem; color:rgba(255,255,255,0.02); z-index:-1; pointer-events:none; font-weight:900; transform:rotate(15deg)">TRACK</div>
    <div style="position:absolute; width:600px; height:600px; background:radial-gradient(circle, rgba(var(--primary-rgb), 0.05), transparent 70%); top:50%; left:50%; transform:translate(-50%,-50%); border-radius:50%; pointer-events:none; z-index:-1"></div>

    <div style="width:100%; max-width:500px" class="fx-reveal">
        
        {{-- Header --}}
        <div style="text-align:center; margin-bottom:50px">
            <div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:16px">
                <span class="tag-mono">SYS_SCAN</span>
                <span class="mono" style="font-size:0.65rem; color:var(--muted); letter-spacing:0.2em">TRACKING_DATABASE_ACCESS</span>
            </div>
            <h1 class="display" style="font-size:3.5rem; color:#fff; margin:0; line-height:1">LACAK <span class="text-accent-stroke">BOOKING</span></h1>
            <p class="mono" style="color:var(--muted); font-size:0.75rem; margin-top:15px; letter-spacing:0.1em">MASUKKAN KODE IDENTIFIKASI UNTUK VERIFIKASI STATUS ARENA.</p>
        </div>

        {{-- Search Card --}}
        <div class="glass" style="padding:40px; position:relative; border-radius:4px; overflow:hidden">
            <div class="corner-accent corner-tl"></div>
            <div class="corner-accent corner-br"></div>
            
            @if($errors->any())
            <div style="background:rgba(239, 68, 68, 0.05); border-left:3px solid #EF4444; padding:15px; margin-bottom:25px; display:flex; align-items:center; gap:12px">
                <i class="fas fa-exclamation-triangle" style="color:#EF4444; font-size:0.8rem"></i>
                <span class="mono" style="font-size:0.75rem; color:#fff">{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="{{ route('tracking.result') }}" method="POST">
                @csrf
                <div style="margin-bottom:30px">
                    <label class="mono" style="font-size:0.65rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.2em; display:block; margin-bottom:12px">UNI_RESERVATION_CODE</label>
                    <div style="position:relative">
                        <input type="text" name="kode_booking" 
                               placeholder="BK-XXXXXX" 
                               class="input-raw" 
                               style="width:100%; padding-left:50px; text-transform:uppercase; letter-spacing:0.1em; font-size:1rem"
                               value="{{ old('kode_booking') }}"
                               required>
                        <i class="fas fa-barcode" style="position:absolute; left:20px; top:50%; transform:translateY(-50%); color:var(--primary); font-size:1rem"></i>
                    </div>
                    <p class="mono" style="font-size:0.55rem; color:var(--muted); margin-top:12px; display:flex; align-items:center; gap:8px">
                        <i class="fas fa-info-circle" style="color:var(--primary)"></i>
                        KODE DAPAT DITEMUKAN PADA HALAMAN SUKSES ATAU EMAIL KONFIRMASI.
                    </p>
                </div>

                <button type="submit" class="btn-cyber" style="width:100%; justify-content:center; padding:18px">
                    SCAN_DATABASE <i class="fas fa-search" style="margin-left:10px"></i>
                </button>
            </form>

            <div style="height:1px; background:var(--border); margin:35px 0; position:relative">
                <span style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:var(--bg2); padding:0 15px; color:var(--muted); font-size:0.55rem" class="mono">OR_CONTACT_SUPPORT</span>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px">
                @foreach([
                    ['fab fa-whatsapp', 'https://wa.me/6281318865459', 'WHATSAPP'],
                    ['fas fa-phone', 'tel:+6281318865459', 'PHONE'],
                    ['fas fa-envelope', 'mailto:info@sportiva.com', 'EMAIL']
                ] as [$ico, $url, $lbl])
                <a href="{{ $url }}" target="_blank" class="mono" style="text-decoration:none; text-align:center; padding:12px; border:1px solid var(--border); transition:all 0.3s; background:rgba(255,255,255,0.01)" onmouseover="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='var(--primary)'" onmouseout="this.style.background='rgba(255,255,255,0.01)'; this.style.borderColor='var(--border)'">
                    <i class="{{ $ico }}" style="color:var(--primary); font-size:0.9rem; display:block; margin-bottom:6px"></i>
                    <span style="font-size:0.5rem; color:var(--muted)">{{ $lbl }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Footer Link --}}
        <div style="text-align:center; margin-top:30px">
            <a href="{{ route('booking.index') }}" class="mono" style="color:var(--muted); text-decoration:none; font-size:0.7rem; transition:color 0.3s; display:inline-flex; align-items:center; gap:8px" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--muted)'">
                <i class="fas fa-calendar-plus" style="color:var(--primary)"></i> BARU_RESERVASI_ARENA
            </a>
        </div>

    </div>
</div>
@endsection