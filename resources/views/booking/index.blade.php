@extends('layouts.app')
@section('title','Arena Selection — SPORTIVA')

@section('content')
<div class="scanline"></div>

<div style="padding-top:100px">

  {{-- ── HEADER ── --}}
  <div style="padding:40px 7vw; max-width:1400px; margin:0 auto">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:30px; margin-bottom:60px">
      <div style="position:relative">
        {{-- Decorative line --}}
        <div style="position:absolute; left:-30px; top:0; bottom:0; width:1px; background:linear-gradient(to bottom, var(--accent), transparent)"></div>
        
        <div class="tag-mono" style="margin-bottom:12px">Module: Court_Finder</div>
        <h1 class="display" style="font-size:clamp(3rem, 7vw, 6rem); color:#fff; line-height:0.9">
          ACTIVE<br><span style="color:var(--accent)">ARENAS</span>
        </h1>
        <div class="mono" style="font-size:0.75rem; color:var(--muted); margin-top:10px">
          SYSTEM_SYNC: {{ \Carbon\Carbon::now()->format('H:i:s') }} // LOC: JAKARTA_EAST
        </div>
      </div>

      {{-- Date Controller --}}
      <div class="card-raw" style="padding:8px; display:flex; gap:10px; align-items:center; background:#0F0F11">
        <form method="GET" action="{{ route('booking.index') }}" style="display:flex; align-items:center; gap:5px">
          <div class="mono" style="font-size:0.65rem; color:var(--muted); padding:0 10px">DATE_SELECT:</div>
          <input type="date" name="date" value="{{ $selectedDate }}" class="input-raw" 
                 style="background:transparent; border:none; padding:8px; font-size:0.8rem; width:150px"
                 onchange="this.form.submit()">
          <button type="submit" class="btn-cyber" style="padding:10px 15px"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </div>

    {{-- Legend --}}
    <div class="mono" style="display:flex; gap:25px; margin-bottom:40px; border-bottom:1px solid var(--border); padding-bottom:20px">
      <div style="display:flex; align-items:center; gap:8px">
        <span style="width:10px; height:1px; background:var(--accent)"></span>
        <span style="font-size:0.65rem; color:#fff">AVAILABLE</span>
      </div>
      <div style="display:flex; align-items:center; gap:8px">
        <span style="width:10px; height:1px; background:var(--muted)"></span>
        <span style="font-size:0.65rem; color:var(--muted)">OCCUPIED</span>
      </div>
    </div>
  </div>

  {{-- ── GRID ── --}}
  <div style="padding:0 7vw 100px; max-width:1400px; margin:0 auto">
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(340px, 1fr)); gap:2px; background:var(--border)">
      @foreach($fields as $index => $lap)
      @php
        $avail = count(array_filter($lap->availableTimeSlots, fn($s) => $s['status'] === 'available'));
      @endphp
      <div class="card-raw" style="background:var(--bg); border:none">
        {{-- Visual Header --}}
        <div style="height:280px; position:relative; overflow:hidden">
          @if($lap->image)
            <img src="{{ asset('storage/'.$lap->image) }}" alt="" style="width:100%; height:100%; object-fit:cover; filter:brightness(0.6) desaturate(0.5)">
          @else
            <div style="width:100%; height:100%; background:#080808; display:flex; align-items:center; justify-content:center">
               <i class="fas fa-microchip" style="font-size:3rem; color:#111"></i>
            </div>
          @endif
          
          <div style="position:absolute; inset:0; background:linear-gradient(to top, var(--bg) 0%, transparent 60%)"></div>
          
          {{-- Status Tag --}}
          <div style="position:absolute; top:20px; left:20px">
            <div class="tag-mono" style="background:var(--accent); color:#000; border:none">
              #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} // {{ strtoupper($lap->sport_type) }}
            </div>
          </div>

          {{-- Availability Bit --}}
          <div style="position:absolute; bottom:20px; right:20px; text-align:right">
            <div class="mono" style="font-size:0.6rem; color:var(--muted); margin-bottom:4px">AVAILABILITY</div>
            <div class="display" style="font-size:1.5rem; color:{{ $avail > 0 ? 'var(--accent)' : 'var(--muted)' }}">
              {{ $avail }}/8 <span style="font-size:0.8rem">SLOTS</span>
            </div>
          </div>
        </div>

        {{-- Info Body --}}
        <div style="padding:30px; position:relative">
          {{-- Corner Decors --}}
          <div style="position:absolute; top:10px; right:10px; width:15px; height:15px; border-top:1px solid var(--border); border-right:1px solid var(--border)"></div>
          
          <h3 class="display" style="font-size:1.8rem; color:#fff; margin-bottom:8px">{{ $lap->name }}</h3>
          <p class="mono" style="color:var(--muted); font-size:0.75rem; margin-bottom:25px">
             LOC >> {{ strtoupper($lap->location) }}
          </p>

          {{-- Slot Micro Viz --}}
          <div style="display:flex; gap:4px; margin-bottom:30px">
            @foreach($lap->availableTimeSlots as $slot)
            <div style="flex:1; height:4px; background:{{ $slot['status']==='available' ? 'var(--accent)' : '#111' }}; opacity:{{ $slot['status']==='available' ? '1' : '0.3' }}" 
                 title="{{ $slot['time'] }}"></div>
            @endforeach
          </div>

          <div style="display:flex; justify-content:space-between; align-items:center">
             <div>
                <div class="mono" style="font-size:0.6rem; color:var(--muted)">PRICE_POINT</div>
                <div class="display" style="font-size:1.5rem; color:#fff">Rp{{ number_format($lap->original_price, 0, ',', '.') }}</div>
             </div>
             <a href="{{ route('booking.form',['field'=>$lap->id,'date'=>$selectedDate]) }}" class="btn-cyber" style="padding:10px 25px">
               ACCESS_PORT
             </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</div>

<style>
.card-raw:hover { background: #080808 !important; }
</style>
@endsection