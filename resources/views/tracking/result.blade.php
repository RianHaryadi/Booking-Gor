@extends('layouts.app')
@section('title', 'Detail Reservasi — ' . $booking->kode_booking)

@section('content')
<div style="min-height:90vh; display:flex; align-items:center; justify-content:center; padding:80px 24px; position:relative; overflow:hidden; z-index:10">
    {{-- Decorative Background --}}
    <div class="mono" style="position:fixed; top:15%; left:5%; font-size:15rem; color:rgba(255,255,255,0.02); z-index:-1; pointer-events:none; font-weight:900">INFO</div>
    <div style="position:absolute; width:600px; height:600px; background:radial-gradient(circle, rgba(93, 95, 239, 0.05), transparent 70%); top:50%; left:50%; transform:translate(-50%,-50%); border-radius:50%; pointer-events:none; z-index:-1"></div>

    <div style="width:100%; max-width:600px" class="fx-reveal">
        
        {{-- Header Section --}}
        <div style="text-align:center; margin-bottom:40px">
            <div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:16px">
                <span class="tag-mono">DATA_DECRYPTED</span>
                <span class="mono" style="font-size:0.65rem; color:var(--muted); letter-spacing:0.2em">RESERVATION_SUMMARY_V1.0</span>
            </div>
            <h1 class="display" style="font-size:3rem; color:#fff; margin:0; line-height:1">DETAIL <span class="text-accent-stroke">RESERVASI</span></h1>
            <p class="mono" style="color:var(--muted); font-size:0.75rem; margin-top:15px; letter-spacing:0.1em">INFORMASI LENGKAP MENGENAI STATUS DAN DETAIL ARENA ANDA.</p>
        </div>

        {{-- Verification Card (Passport Style) --}}
        <div class="glass" style="padding:0; position:relative; border-radius:4px; overflow:hidden">
            <div class="corner-accent corner-tl"></div>
            <div class="corner-accent corner-br"></div>
            
            {{-- Status Header --}}
            <div style="padding:40px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; background:rgba(255,255,255,0.01)">
                <div>
                    <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:5px">BOOKING_IDENTIFIER</span>
                    <span class="display" style="font-size:2.2rem; color:#fff; letter-spacing:0.05em">{{ $booking->kode_booking }}</span>
                </div>
                <div style="text-align:right">
                    <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:10px">CURRENT_STATUS</span>
                    @php
                        $statusColors = [
                            'booked' => ['#CCFF00', 'ACTIVE_READY'],
                            'pending' => ['#3B82F6', 'PENDING_VALIDATION'],
                            'canceled' => ['#EF4444', 'VOID_REVOKED']
                        ];
                        $currStatus = $statusColors[$booking->status] ?? ['#fff', strtoupper($booking->status)];
                    @endphp
                    <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.03); padding:6px 15px; border:1px solid {{ $currStatus[0] }}40">
                        <span style="width:6px; height:6px; background:{{ $currStatus[0] }}; border-radius:50%; box-shadow:0 0 10px {{ $currStatus[0] }}"></span>
                        <span class="mono" style="font-size:0.65rem; color:{{ $currStatus[0] }}; font-weight:700">{{ $currStatus[1] }}</span>
                    </div>
                </div>
            </div>

            {{-- Data Grid --}}
            <div style="padding:40px">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px">
                    @foreach([
                        ['PLAYER_RESERVE', $booking->nama_pemesan, 'fas fa-user-ninja'],
                        ['ARENA_FIELD', $booking->lapanganMode->name ?? 'N/A', 'fas fa-chess-board'],
                        ['SCHEDULE_DATE', \Carbon\Carbon::parse($booking->tanggal)->format('d F Y'), 'fas fa-calendar-day'],
                        ['TIME_WINDOW', substr($booking->jam_mulai, 0, 5) . ' - ' . substr($booking->jam_selesai, 0, 5), 'fas fa-clock'],
                        ['CONTACT_LINE', $booking->nomor_telepon, 'fas fa-satellite-dish'],
                        ['PAYMENT_GATE', ucfirst($booking->metode_pembayaran), 'fas fa-credit-card']
                    ] as [$lbl, $val, $ico])
                    <div style="border-left:1px solid var(--border); padding-left:20px">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px">
                            <i class="{{ $ico }}" style="color:var(--primary); font-size:0.7rem"></i>
                            <span class="mono" style="font-size:0.55rem; color:var(--muted); letter-spacing:0.1em">{{ $lbl }}</span>
                        </div>
                        <span class="mono" style="font-size:0.9rem; color:#fff; font-weight:700">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Total Footer --}}
                <div style="margin-top:50px; padding-top:40px; border-top:1px dashed var(--border); display:flex; justify-content:space-between; align-items:flex-end">
                    <div>
                        <span class="mono" style="font-size:0.6rem; color:var(--muted); display:block; margin-bottom:10px">TOTAL_AMOUNT_PAid</span>
                        <span class="display" style="font-size:3rem; color:#fff">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div style="text-align:right">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $booking->kode_booking }}&bgcolor=000&color=fff" 
                             alt="QR" style="width:80px; height:80px; border:1px solid var(--border); padding:5px; background:#fff; mix-blend-mode: screen; filter: invert(1);">
                        <p class="mono" style="font-size:0.5rem; color:var(--muted); margin-top:8px">SECURE_VERIFICATION_QR</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-top:30px">
            <a href="{{ route('tracking.index') }}" class="btn-outline" style="text-decoration:none; justify-content:center; display:flex; align-items:center">
                <i class="fas fa-arrow-left" style="margin-right:10px"></i> KEMBALI_KE_TRACKING
            </a>
            <a href="https://wa.me/6281318865459?text=Halo%2C+saya+ingin+bertanya+mengenai+kode+booking+{{ $booking->kode_booking }}" 
               class="btn-cyber" style="text-decoration:none; justify-content:center; background:#10B981">
                HUBUNGI_OPERATOR <i class="fab fa-whatsapp" style="margin-left:10px"></i>
            </a>
        </div>
    </div>
</div>
@endsection