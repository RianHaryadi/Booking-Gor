@extends('layouts.app')
@section('title','Event & Turnamen — GOR Serbaguna')

@section('content')
<div style="padding-top:64px">

  {{-- HERO --}}
  <section style="padding:56px 7vw 48px;max-width:1400px;margin:0 auto">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:24px">
      <div>
        <p style="font-size:.7rem;font-weight:700;letter-spacing:.15em;color:#F59E0B;text-transform:uppercase;margin-bottom:8px;display:flex;align-items:center;gap:8px">
          <i class="fas fa-trophy" style="font-size:.75rem"></i>Kompetisi
        </p>
        <h1 class="display" style="font-size:clamp(2.5rem,5vw,4.5rem);color:#F1F5F9;line-height:.92">
          EVENT &<br>TURNAMEN
        </h1>
      </div>
      <p style="color:#475569;max-width:280px;font-size:.9rem;line-height:1.65">Bergabunglah dalam turnamen olahraga seru dan raih hadiah menarik bersama komunitas kami.</p>
    </div>
  </section>

  {{-- EVENTS CONTENT --}}
  <section style="padding:0 7vw 80px;max-width:1400px;margin:0 auto">

    {{-- Card grid for events --}}
    @forelse($events as $event)
    <div style="background:var(--bg2);border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:16px;display:grid;grid-template-columns:280px 1fr auto;transition:border-color .3s" class="event-row" onmouseover="this.style.borderColor='rgba(124,58,237,0.35)'" onmouseout="this.style.borderColor='var(--border)'">
      {{-- Poster --}}
      <div style="height:160px;position:relative;overflow:hidden">
        @if($event->poster)
        <img src="{{ asset('storage/'.$event->poster) }}" alt="{{ $event->nama }}" style="width:100%;height:100%;object-fit:cover">
        @else
        <div style="width:100%;height:100%;background:linear-gradient(135deg,rgba(124,58,237,0.15),rgba(59,130,246,0.15));display:flex;align-items:center;justify-content:center">
          <i class="fas fa-trophy" style="font-size:2.5rem;color:rgba(245,158,11,0.4)"></i>
        </div>
        @endif
        <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent 60%,var(--bg2))"></div>
      </div>

      {{-- Info --}}
      <div style="padding:24px 28px;display:flex;flex-direction:column;justify-content:center;gap:8px">
        <div style="display:flex;align-items:center;gap:10px">
          @if($event->status==='ongoing')
          <span class="badge badge-green"><span style="width:5px;height:5px;background:#10B981;border-radius:50%;animation:pulse 1.5s infinite"></span>LIVE</span>
          @elseif($event->status==='upcoming')
          <span class="badge badge-amber">UPCOMING</span>
          @else
          <span class="badge badge-muted">SELESAI</span>
          @endif
          <span class="badge badge-blue">{{ ucfirst($event->kategori) }}</span>
        </div>
        <h2 style="font-weight:700;font-size:1.15rem;color:#F1F5F9;line-height:1.3">{{ $event->nama }}</h2>
        <p style="color:#475569;font-size:.82rem;line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ $event->deskripsi }}</p>
        <div style="display:flex;flex-wrap:wrap;gap:16px;font-size:.78rem;color:#334155;margin-top:4px">
          <span style="display:flex;align-items:center;gap:5px"><i class="fas fa-calendar" style="color:#3B82F6;font-size:.7rem"></i>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M') }} – {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>
          <span style="display:flex;align-items:center;gap:5px"><i class="fas fa-map-marker-alt" style="color:#7C3AED;font-size:.7rem"></i>{{ $event->lokasi }}</span>
          <span style="display:flex;align-items:center;gap:5px;color:#10B981;font-weight:700"><i class="fas fa-gift" style="font-size:.7rem"></i>Rp{{ number_format($event->hadiah,0,',','.') }}</span>
        </div>
      </div>

      {{-- CTA --}}
      <div style="padding:24px 28px;display:flex;align-items:center;border-left:1px solid var(--border);justify-content:center">
        @if($event->status !== 'completed')
        <a href="{{ $event->linkpendaftaran ?? '#' }}" target="{{ $event->linkpendaftaran ? '_blank' : '_self' }}" style="white-space:nowrap;padding:12px 24px;font-size:0.8rem;background:var(--primary);color:#000;text-decoration:none;border-radius:4px;box-shadow:0 0 15px rgba(var(--primary-rgb), 0.3);font-weight:900;text-transform:uppercase" {!! empty($event->linkpendaftaran) ? 'onclick="alert(\'Link pendaftaran belum tersedia. Silakan hubungi admin arena.\'); return false;"' : '' !!}>
          <i class="fas fa-bolt" style="margin-right:5px"></i> DAFTAR SEKARANG
        </a>
        @else
        <div style="font-size:.78rem;color:#475569;font-weight:600"><span class="mono">[ CAMPAIGN_ENDED ]</span></div>
        @endif
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:80px;color:#334155">
      <div style="width:60px;height:60px;border-radius:16px;background:rgba(255,255,255,0.03);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
        <i class="fas fa-trophy" style="font-size:1.2rem;opacity:.3"></i>
      </div>
      <p style="font-size:.9rem">Belum ada event tersedia saat ini.</p>
    </div>
    @endforelse

    {{-- Pagination --}}
    @if(method_exists($events,'hasPages')&&$events->hasPages())
    <div style="margin-top:32px;display:flex;justify-content:center">
      {{ $events->links() }}
    </div>
    @endif
  </section>
</div>

<style>
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
@media(max-width:700px){
  .event-row{grid-template-columns:1fr!important}
  .event-row>div:first-child{height:200px}
  .event-row>div:last-child{border-left:none!important;border-top:1px solid var(--border)}
}
</style>
@endsection