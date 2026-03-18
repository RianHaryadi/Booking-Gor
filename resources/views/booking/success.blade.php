@extends('layouts.app')
@section('title', 'Booking Berhasil — SPORTIVA')

@section('content')
<div style="min-height:90vh; display:flex; align-items:center; justify-content:center; padding:80px 24px; position:relative; overflow:hidden; z-index:10">
    {{-- Decorative Background --}}
    <div class="mono" style="position:fixed; top:20%; left:-5%; font-size:18rem; color:rgba(255,255,255,0.02); z-index:-1; pointer-events:none; font-weight:900; transform:rotate(-10deg)">DONE</div>
    <div style="position:absolute; width:600px; height:600px; background:radial-gradient(circle, rgba(var(--accent-rgb), 0.05), transparent 70%); top:50%; left:50%; transform:translate(-50%,-50%); border-radius:50%; pointer-events:none; z-index:-1"></div>

    <div style="width:100%; max-width:600px" class="fx-reveal">
        
        {{-- Success Badge --}}
        <div style="text-align:center; margin-bottom:50px">
            <div style="position:relative; display:inline-block">
                <div style="width:100px; height:100px; background:var(--bg2); border:1px solid var(--accent); display:flex; align-items:center; justify-content:center; clip-path:polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%); box-shadow:0 0 40px rgba(var(--accent-rgb), 0.2)">
                    <i class="fas fa-check" style="color:var(--accent); font-size:2.5rem"></i>
                </div>
                <div style="position:absolute; inset:-10px; border:1px solid rgba(var(--accent-rgb), 0.2); clip-path:polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%); animation:spin-slow 10s linear infinite"></div>
            </div>
            
            <div style="margin-top:30px">
                <span class="tag-mono" style="margin-bottom:12px; display:inline-block">RESERVATION_CONFIRMED</span>
                <h1 class="display" style="font-size:3.5rem; color:#fff; margin:0; line-height:1">BOOKING <span class="text-accent-stroke">COMPLETE</span></h1>
                <p class="mono" style="color:var(--muted); font-size:0.75rem; margin-top:15px; letter-spacing:0.1em">SISTEM TELAH MENVALIdASI PESANAN ANDA. ARENA TELAH DI-RESERVE.</p>
            </div>
        </div>

        {{-- Main Result Card --}}
        <div class="glass" style="padding:0; position:relative; border-radius:4px; overflow:hidden">
            <div class="corner-accent corner-tl"></div>
            <div class="corner-accent corner-br"></div>
            
            {{-- Ticket Header --}}
            <div style="background:rgba(255,255,255,0.02); padding:35px; border-bottom:1px dashed var(--border); text-align:center">
                <span class="mono" style="font-size:0.6rem; color:var(--muted); letter-spacing:0.3em; display:block; margin-bottom:10px">UNIQUE_RESERVATION_ID</span>
                <div class="display" style="font-size:3.2rem; background:linear-gradient(90deg, #fff, var(--accent)); -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; letter-spacing:0.1em">
                    {{ $booking->kode_booking }}
                </div>
                <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(var(--accent-rgb), 0.1); padding:4px 15px; border:1px solid rgba(var(--accent-rgb), 0.2); margin-top:15px">
                    <span style="width:6px; height:6px; background:var(--accent); border-radius:50%; box-shadow:0 0 8px var(--accent)"></span>
                    <span class="mono" style="font-size:0.6rem; color:var(--accent); font-weight:700">STATUS_SECURED</span>
                </div>
            </div>

            {{-- Receipt Details --}}
            <div style="padding:40px">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px">
                    <div>
                        <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">ARENA_FIELD</span>
                        <span class="mono" style="font-size:0.85rem; color:#fff; font-weight:700">{{ $booking->lapanganMode->name ?? 'N/A' }}</span>
                    </div>
                    <div style="text-align:right">
                        <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">PLAYER_RESERVE</span>
                        <span class="mono" style="font-size:0.85rem; color:#fff; font-weight:700">{{ $booking->nama_pemesan }}</span>
                    </div>
                    <div>
                        <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">DATE_SCHEDULE</span>
                        <span class="mono" style="font-size:0.85rem; color:#fff; font-weight:700">{{ \Carbon\Carbon::parse($booking->tanggal)->format('D, d M Y') }}</span>
                    </div>
                    <div style="text-align:right">
                        <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">TIME_WINDOW</span>
                        <span class="mono" style="font-size:0.85rem; color:var(--accent); font-weight:700">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</span>
                    </div>
                    <div style="grid-column:1/-1; border-top:1px solid var(--border); padding-top:20px; margin-top:10px; display:flex; justify-content:space-between; align-items:center">
                        <div>
                            <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">PAYMENT_METHOD</span>
                            <div style="display:flex; align-items:center; gap:8px">
                                <i class="fas {{ $booking->metode_pembayaran == 'cash' ? 'fa-money-bill-wave' : 'fa-credit-card' }}" style="color:var(--primary); font-size:0.8rem"></i>
                                <span class="mono" style="font-size:0.75rem; color:#fff; text-transform:uppercase">{{ $booking->metode_pembayaran }}</span>
                            </div>
                        </div>
                        <div style="text-align:right">
                            <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">TOTAL_PAID</span>
                            <span class="display" style="font-size:1.8rem; color:#fff">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Security Footer --}}
            <div style="background:rgba(0,0,0,0.4); padding:20px 40px; border-top:1px solid var(--border); display:flex; justify-content:space-between; align-items:center">
                <span class="mono" style="font-size:0.55rem; color:var(--muted)">HASH: {{ md5($booking->id . $booking->kode_booking) }}</span>
                <div style="display:flex; gap:15px">
                    <i class="fas fa-print" style="color:var(--muted); font-size:0.8rem; cursor:pointer" title="Print Receipt"></i>
                    <i class="fas fa-download" style="color:var(--muted); font-size:0.8rem; cursor:pointer" title="Download E-Ticket"></i>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-top:30px">
            <a href="{{ route('tracking.index') }}" class="btn-outline" style="text-decoration:none; justify-content:center; display:flex; align-items:center">
                <i class="fas fa-crosshairs" style="margin-right:10px"></i> LACAK_RESERVASI
            </a>
            <a href="{{ route('home') }}" class="btn-cyber" style="text-decoration:none; justify-content:center">
                KEMBALI_KE_DASHBOARD <i class="fas fa-home" style="margin-left:10px"></i>
            </a>
        </div>

        {{-- WhatsApp Support --}}
        <a href="https://wa.me/6281318865459?text=Halo%2C+booking+saya+dengan+kode+{{ $booking->kode_booking }}+sudah+dikonfirmasi%2C+terima+kasih%21"
           target="_blank" class="mono"
           style="display:flex; align-items:center; justify-content:center; gap:12px; margin-top:25px; color:var(--muted); text-decoration:none; font-size:0.65rem; transition:color 0.3s"
           onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--muted)'">
            <i class="fab fa-whatsapp" style="font-size:1rem"></i>
            TANYA_ADMIN_VIA_WHATSAPP
        </a>

    </div>
</div>

@section('styles')
<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection
@endsection