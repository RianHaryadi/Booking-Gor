@extends('layouts.app')
@section('title','Arena Sportiva — Premier Sport Hub')

@section('content')
<div class="scanline"></div>

{{-- ── HERO SECTION ──────────────────────────────────────── --}}
<section style="min-height:100vh;display:flex;align-items:center;position:relative;overflow:hidden;padding:120px 7vw 100px" class="dot-pattern">
  
  {{-- BG IMAGE LAYER --}}
  <div style="position:absolute;inset:0;z-index:0">
    <img src="{{ asset('images/hero_sports.png') }}" alt="" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.3) contrast(1.1)">
    <div style="position:absolute;inset:0;background:linear-gradient(90deg, var(--bg) 0%, rgba(5,5,5,0.7) 50%, transparent 100%)"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 70% 30%, rgba(93,95,239,0.15), transparent 60%)"></div>
  </div>

  <div style="position:relative;z-index:2;max-width:1400px;width:100%;margin:0 auto;display:grid;grid-template-columns:1.2fr 0.8fr;gap:60px;align-items:center" class="hero-grid">
    
    <div class="fx-reveal">
      <div style="display:inline-flex;align-items:center;gap:12px;margin-bottom:32px">
        <div class="tag-mono" style="background:var(--accent);color:#000;border:none;font-size:0.65rem;font-weight:900">[ ARENA_LIVE ]</div>
        <div style="display:flex;align-items:center;gap:8px">
          <span style="width:6px;height:6px;background:var(--accent);border-radius:50%;box-shadow:0 0 10px var(--accent);animation:pulse 2s infinite"></span>
          <span class="mono" style="font-size:0.7rem;color:rgba(255,255,255,0.4)">SYNC_ID: {{$lap_id ?? '820'}} // STATUS: OPTIMAL</span>
        </div>
      </div>

      <h1 class="display" style="font-size:clamp(60px, 12vw, 160px);margin-bottom:32px;color:#fff;line-height:0.8;letter-spacing:-0.02em; position:relative">
        <span style="position:absolute; top:-20px; left:0; font-size:1rem; color:var(--accent); font-family:var(--mono)">⌖</span>
        DOMINATE<br>
        THE <span style="color:var(--accent)">COURT</span>
      </h1>

      <div style="max-width:550px">
        <p style="color:rgba(255,255,255,0.6);line-height:1.7;font-size:1.15rem;margin-bottom:45px" class="mono">
          Premier multi-sport destination. Industrial grade facilities for badminton, basketball, and futsal. Engineered for elite performance.
        </p>
        <div style="display:flex;gap:15px; align-items:center">
          <a href="{{ route('booking.index') }}" class="btn-cyber" style="padding:18px 45px; font-size: 0.8rem">
            <i class="fas fa-calendar-alt"></i> BOOK_ARENA
          </a>
          <a href="#intel" class="btn-outline" style="padding:18px 45px; font-size: 0.8rem">
            <i class="fas fa-info-circle"></i> EXPLORE_STATS
          </a>
          <div class="nav-desktop mono" style="font-size:0.55rem; color:var(--muted); margin-left:20px; border-left:1px solid var(--border); padding-left:20px">
            VER: 1.0.8<br>PROTO: SECURE
          </div>
        </div>
      </div>
    </div>

    {{-- Performance Panel (Sport-focused Stats) --}}
    <div class="fx-reveal delay-1 nav-desktop" style="border-left:1px solid var(--border);padding-left:40px;position:relative">
      <div class="corner-accent corner-tl"></div>
      <div class="corner-accent corner-br"></div>
      
      <div style="margin-bottom:45px">
        <div class="mono" style="font-size:0.65rem;color:var(--muted);margin-bottom:20px;letter-spacing:0.2em">ARENA_CAPACITY_LOAD //</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
          @foreach([['Active Courts','12/15'],['Utilization','92%'],['Peak Hours','17:00-21:00'],['Surface','Pro-Vinyl']] as [$l,$v])
          <div class="card-raw" style="padding:20px;background:rgba(255,255,255,0.01);border:1px solid var(--border); position:relative">
            <div style="position:absolute; top:5px; right:8px; font-size:0.5rem; color:rgba(255,255,255,0.1)">ITEM_{{rand(100,999)}}</div>
            <div class="mono" style="font-size:0.6rem;color:var(--muted);text-transform:uppercase;margin-bottom:8px">{{ $l }}</div>
            <div class="display" style="font-size:1.4rem;color:#fff">{{ $v }}</div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Sport Icons Visual --}}
      <div style="display:flex;gap:35px;justify-content:center;opacity:0.4">
        <div style="text-align:center"><i class="fas fa-shuttlecock" style="font-size:2rem;color:var(--accent)"></i><div class="mono" style="font-size:0.5rem; margin-top:5px">BDMN</div></div>
        <div style="text-align:center"><i class="fas fa-basketball-ball" style="font-size:2rem;color:var(--accent)"></i><div class="mono" style="font-size:0.5rem; margin-top:5px">BSKT</div></div>
        <div style="text-align:center"><i class="fas fa-futbol" style="font-size:2rem;color:var(--accent)"></i><div class="mono" style="font-size:0.5rem; margin-top:5px">FTSL</div></div>
      </div>
    </div>
  </div>

  {{-- Floating Coordinates (Keeps premium feel but in sports context) --}}
  <div class="mono" style="position:absolute;right:2vw;top:50%;transform:translateY(-50%) rotate(90deg);font-size:0.6rem;color:rgba(255,255,255,0.15);letter-spacing:0.5em">
    LOC: SECTOR_A // ARENA_HUB_018 // GPS: -6.1751, 106.8650
  </div>
</section>

{{-- ── SPORT TICKER ── --}}
<div style="border-top:1px solid var(--border);border-bottom:1px solid var(--border);background:#080808;padding:20px 0;overflow:hidden">
  <div style="display:flex;white-space:nowrap;animation:ticker 40s linear infinite">
    @foreach(range(1,8) as $i)
    <div style="display:flex;align-items:center;gap:40px;padding:0 40px">
      <span class="mono" style="font-size:0.7rem;color:var(--primary)">[ LOG_{{rand(1000,9999)}} ]</span>
      <span class="display" style="font-size:1.5rem;color:#fff">BADMINTON_PRO_COURTS</span>
      <i class="fas fa-bolt" style="color:var(--accent);font-size:1rem"></i>
      <span class="display" style="font-size:1.5rem;color:#fff">FUTSAL_READY</span>
      <i class="fas fa-basketball-ball" style="color:var(--primary);font-size:1rem"></i>
      <span class="display" style="font-size:1.5rem;color:#fff">BASKETBALL_ARENA</span>
      <span class="mono" style="font-size:0.65rem;color:var(--muted)">// ACCESS_GRANTED_{{$i}}</span>
    </div>
    @endforeach
  </div>
</div>

{{-- ── ARENA SPECS ───────────────── --}}
<section id="intel" style="padding:150px 7vw;max-width:1400px;margin:0 auto">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:100px;align-items:center" class="hero-grid">
    <div class="fx-reveal">
      <div class="tag-mono" style="margin-bottom:20px; color:var(--primary); border-color:var(--primary)">SPEC: ELITE_INFRA</div>
      <h2 class="display" style="font-size:clamp(3rem,8vw,6rem);color:#fff;line-height:0.9;margin-bottom:40px; position:relative">
        <span style="position:absolute; left:-40px; top:10px; font-size:1.5rem; color:var(--accent)">⌞</span>
        WINNING<br><span style="color:var(--accent)">GEOMETRY</span>
        <span style="position:absolute; right:0; bottom:-10px; font-size:1.5rem; color:var(--primary)">⌝</span>
      </h2>
      
      <div style="display:grid;grid-template-columns:1fr;gap:25px">
        @foreach([
          ['PRO_LIGHTS','800 LUX High-definition LED systems for professional tracking.'],
          ['GRIP_MAX','Tarkett multi-sport surfaces ensuring maximum agility and safety.'],
          ['ZONE_HVAC','Advanced climate control maintaining optimal match temperatures.']
        ] as [$l,$d])
        <div style="display:flex;gap:25px;padding:30px;border:1px solid var(--border);background:rgba(255,255,255,0.01);position:relative">
          <div style="position:absolute;top:0;left:0;width:4px;height:100%;background:var(--accent)"></div>
          <div class="mono" style="position:absolute; top:10px; right:15px; font-size:0.55rem; color:rgba(255,255,255,0.05)">SYS_MTRX_{{rand(10,99)}}</div>
          <div class="display" style="font-size:1.8rem;color:#fff">{{ $l }}</div>
          <p class="mono" style="font-size:0.85rem;color:var(--muted);margin:0;line-height:1.6">{{ $d }}</p>
        </div>
        @endforeach
      </div>
    </div>
    
    {{-- Court Layout Visual --}}
    <div class="fx-reveal delay-1 card-raw" style="aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;padding:50px;background:#0A0A0B;border-radius:1px; position:relative">
       <div class="corner-accent corner-tl"></div>
       <div class="corner-accent corner-br"></div>
       <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.01) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.01) 1px, transparent 1px);background-size:20px 20px"></div>
       <div style="width:100%;height:100%;border:1px solid var(--border);position:relative;display:flex;align-items:center;justify-content:center">
          {{-- Abstract Court Lines --}}
          <div style="width:80%;height:50%;border:2px solid var(--primary);opacity:0.3;position:relative">
             <div style="position:absolute;top:0;left:50%;width:1px;height:100%;background:var(--primary)"></div>
             <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:60px;height:60px;border:2px solid var(--primary);border-radius:50%"></div>
          </div>
          <div style="position:absolute;top:20px;left:20px" class="mono" style="font-size:0.5rem;color:var(--muted)">LAYOUT_REF: S_ARENA_820 // SCALE: 1:500</div>
          <div class="display" style="font-size:8rem;color:rgba(255,255,255,0.02);position:absolute">COURT</div>
       </div>
    </div>
  </div>
</section>

{{-- ── ARENA SCHEDULE ────────────────────────────────────── --}}
<section id="schedule" style="padding:100px 7vw; background:var(--bg); border-top:1px solid var(--border); position:relative; overflow:hidden">
  <div class="scanline"></div>
  <div style="max-width:1400px; margin:0 auto">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:60px; flex-wrap:wrap; gap:30px">
      <div class="fx-reveal">
        <div class="tag-mono" style="margin-bottom:12px; color:var(--primary); border-color:var(--primary)">DATA_OVR: AVAILABILITY_MATRIX</div>
        <h2 class="display" style="font-size:clamp(3rem, 8vw, 6rem); color:#fff; line-height:0.8; margin:0">ARENA<br><span style="color:var(--primary)">SCHEDULE</span></h2>
      </div>
      <div class="fx-reveal delay-1" style="text-align:right">
        <div class="mono" style="font-size:0.65rem; color:var(--muted); margin-bottom:10px">SYSTEM_TIME: {{ \Carbon\Carbon::now()->format('H:i:s') }}</div>
        <div style="padding:15px 25px; background:rgba(255,255,255,0.02); border:1px solid var(--border); display:inline-flex; align-items:center; gap:15px">
          <div style="width:10px; height:10px; background:var(--accent); border-radius:50%; box-shadow:0 0 10px var(--accent)"></div>
          <span class="mono" style="font-size:0.8rem; color:#fff">STATUS: ONLINE_SYNC</span>
        </div>
      </div>
    </div>

    {{-- 30-DAY DATE SELECTOR --}}
    <div class="fx-reveal" style="margin-bottom:50px; position:relative">
      <div class="mono" style="font-size:0.6rem; color:var(--muted); margin-bottom:15px; letter-spacing:0.2em">DEPLOYMENT_WINDOW [30_DAYS] //</div>
      <div style="display:flex; gap:10px; overflow-x:auto; padding-bottom:15px; scrollbar-width: none;" class="hide-scrollbar">
        @php
            $today = \Carbon\Carbon::today();
        @endphp
        @foreach(range(0, 29) as $i)
          @php
              $dateObj = $today->copy()->addDays($i);
              $isCurrent = $dateObj->toDateString() == $tanggal;
          @endphp
          <a href="?tanggal={{ $dateObj->toDateString() }}#schedule" 
             style="flex:0 0 100px; text-decoration:none; padding:15px; border:1px solid {{ $isCurrent ? 'var(--primary)' : 'var(--border)' }}; background:{{ $isCurrent ? 'rgba(93,95,239,0.1)' : 'rgba(255,255,255,0.01)' }}; text-align:center; transition:0.3s"
             class="card-raw">
            <div class="mono" style="font-size:0.6rem; color:{{ $isCurrent ? 'var(--primary)' : 'var(--muted)' }}; margin-bottom:5px">{{ $dateObj->format('D') }}</div>
            <div class="display" style="font-size:1.5rem; color:{{ $isCurrent ? '#fff' : 'rgba(255,255,255,0.5)' }}">{{ $dateObj->format('d') }}</div>
            <div class="mono" style="font-size:0.55rem; color:var(--muted); margin-top:5px">{{ $dateObj->format('M') }}</div>
          </a>
        @endforeach
      </div>
    </div>

    {{-- SCHEDULE GRID --}}
    <div class="fx-reveal delay-2 shadow-2xl" style="background:rgba(0,0,0,0.3); border:1px solid var(--border); overflow-x:auto">
      <table style="width:100%; border-collapse:collapse; min-width:800px" class="mono">
        <thead>
          <tr style="border-bottom:1px solid var(--border)">
            <th style="padding:25px; text-align:left; background:rgba(255,255,255,0.02); width:200px">
              <span style="font-size:0.6rem; color:var(--muted)">FIELD_IDENT</span><br>
              <span style="font-size:0.9rem; color:var(--primary)">MASTER_GRID</span>
            </th>
            @if(isset($allFields[0]) && isset($allFields[0]->availableTimeSlots))
              @foreach($allFields[0]->availableTimeSlots as $slot)
                <th style="padding:20px; text-align:center; border-left:1px solid var(--border)">
                  <span style="font-size:0.6rem; color:var(--muted)">TIME</span><br>
                  <span style="font-size:0.8rem; color:#fff">{{ $slot['time'] }}</span>
                </th>
              @endforeach
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach($allFields as $field)
          <tr style="border-bottom:1px solid var(--border); transition:0.2s">
            <td style="padding:25px; background:rgba(255,255,255,0.01); border-right: 1px solid var(--border)">
              <div style="font-size:0.9rem; color:#fff; font-weight:700; margin-bottom:4px">{{ $field->name }}</div>
              <div class="tag-mono" style="font-size:0.5rem; padding:2px 6px; border-color:rgba(255,255,255,0.1); color:var(--muted)">{{ strtoupper($field->sport_type) }}</div>
            </td>
            @foreach($field->availableTimeSlots as $slot)
              <td style="padding:0; border-left:1px solid var(--border); position:relative">
                @if($slot['status'] === 'available')
                  <a href="{{ route('booking.form', ['field' => $field->id, 'date' => $tanggal, 'jam_mulai' => $slot['time'], 'jam_selesai' => $slot['end_time']]) }}" 
                     style="display:flex; align-items:center; justify-content:center; height:100px; text-decoration:none; color:var(--accent); font-size:0.7rem; transition:0.3s; background: rgba(0, 255, 163, 0.02)"
                     onmouseover="this.style.background='rgba(0,255,163,0.1)'; this.innerText='[ BOOK_NOW ]'"
                     onmouseout="this.style.background='rgba(0, 255, 163, 0.02)'; this.innerText='AVAILABLE'">
                    AVAILABLE
                  </a>
                @elseif($slot['status'] === 'soon')
                   <div style="display:flex; align-items:center; justify-content:center; height:100px; color:rgba(255,255,255,0.1); font-size:0.6rem; cursor:not-allowed; background:rgba(255,255,255,0.02)">
                    EXPIRED
                  </div>
                @else
                  <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100px; background:rgba(255,71,71,0.05); color:#ff4747; font-size:0.6rem">
                    <i class="fas fa-lock" style="margin-bottom:5px"></i>
                   {{ strtoupper($slot['status']) }}
                  </div>
                @endif
              </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

{{-- ── ARENA SELECTION ────────────────────────────────────── --}}
<section style="padding:100px 7vw;background:var(--bg2);border-top:1px solid var(--border); position:relative" class="dot-pattern">
  <div style="position:absolute; top:20px; right:7vw" class="mono" style="font-size:0.6rem; color:rgba(255,255,255,0.1)">SECTOR_SCAN: ENABLED</div>
  <div style="max-width:1400px;margin:0 auto">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:80px;flex-wrap:wrap;gap:20px">
      <div>
        <div class="tag-mono" style="margin-bottom:12px; color:var(--accent); border-color:var(--accent)">ACCESS: FIELD_TERMINAL</div>
        <h2 class="display" style="font-size:clamp(4rem,10vw,8rem);color:#fff;line-height:0.8;margin:0">SELECT<br><span style="color:var(--accent)">ARENA</span></h2>
      </div>
      <a href="{{ route('booking.index') }}" class="btn-outline" style="padding:15px 40px">VIEW_ALL_FIELDS</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(340px, 1fr));gap:2px;background:var(--border)">
      @forelse($fields as $index => $lap)
      <div class="card-raw fx-reveal" style="background:var(--bg); border:none; position:relative">
        <div class="corner-accent corner-tl" style="opacity:0.3"></div>
        <div style="height:320px;position:relative;overflow:hidden">
          @if($lap->image)
            <img src="{{ asset('storage/'.$lap->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.6)">
          @else
            <div style="width:100%;height:100%;background:#111;display:flex;align-items:center;justify-content:center">
               <i class="fas fa-microchip" style="font-size:4rem;color:#111"></i>
            </div>
          @endif
          <div class="tag-mono" style="position:absolute;top:25px;left:25px;background:var(--accent);color:#000;border:none;font-weight:900">NODE_0{{$index+1}}</div>
          <div style="position:absolute;bottom:0;left:0;right:0;height:120px;background:linear-gradient(to top, var(--bg) 0%, transparent 100%)"></div>
          
          {{-- Sport Type Icon Floating --}}
          <div style="position:absolute;top:25px;right:25px;width:40px;height:40px;background:rgba(255,255,255,0.05);backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.1)">
            @if(strtolower($lap->sport_type) == 'badminton') <i class="fas fa-shuttlecock" style="color:var(--accent)"></i>
            @elseif(strtolower($lap->sport_type) == 'basketball') <i class="fas fa-basketball-ball" style="color:var(--accent)"></i>
            @elseif(strtolower($lap->sport_type) == 'futsal') <i class="fas fa-futbol" style="color:var(--accent)"></i>
            @else <i class="fas fa-bolt" style="color:var(--accent)"></i> @endif
          </div>
        </div>
        <div style="padding:40px">
          <div class="mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);margin-bottom:8px">SYSTEM_AUTH: ARENA_{{rand(100,999)}}_X</div>
          <h3 class="display" style="font-size:1.8rem;color:#fff;margin-bottom:12px;letter-spacing:0.02em">{{ $lap->name }}</h3>
          <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:35px">
              <div>
                <div class="mono" style="font-size:0.65rem;color:var(--muted);margin-bottom:4px">LOCATION_HUB</div>
                <div class="mono" style="font-size:0.8rem;color:#fff;font-weight:700">{{ strtoupper($lap->location) }}</div>
              </div>
              <div class="display" style="font-size:1.6rem;color:var(--accent)">Rp{{ number_format($lap->original_price,0,',','.') }}</div>
          </div>
          <a href="{{ route('booking.form',['field'=>$lap->id,'date'=>$tanggal]) }}" class="btn-cyber" style="width:100%;justify-content:center;padding:15px; font-size: 0.75rem">
            INITIALIZE_BOOKBOOKING
          </a>
        </div>
      </div>
      @empty
      @endforelse
    </div>
  </div>
</section>

{{-- ── BOOKING PHASES ────────────────────────────── --}}
<section style="padding:150px 7vw;max-width:1400px;margin:0 auto;text-align:center">
  <div class="tag-mono fx-reveal" style="margin-bottom:20px;color:var(--accent);border-color:var(--accent)">GUIDE: DEPLOYMENT_PROTOCOL</div>
  <h2 class="display fx-reveal" style="font-size:clamp(4rem, 10vw, 7rem);color:#fff;margin-bottom:100px">MATCH_INIT<br><span style="color:var(--primary)">PHASES</span></h2>
  
  <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:60px;position:relative">
    {{-- Connecting Line --}}
    <div style="position:absolute;top:50px;left:10%;right:10%;height:2px;background:var(--border)" class="nav-desktop"></div>
    
    @foreach([
      ['01','SCAN','Select date and check arena latency'],
      ['02','LOCK','Secure your exclusive time-slot from the grid'],
      ['03','READY','Finalize match deployment and secure the port']
    ] as [$p,$t,$d])
    <div class="fx-reveal" style="position:relative;z-index:1">
      <div class="display" style="width:100px;height:100px;background:var(--bg);border:2px solid var(--accent);display:flex;align-items:center;justify-content:center;margin:0 auto 35px;font-size:2.5rem;color:#fff;box-shadow:0 0 30px rgba(var(--accent-rgb), 0.1); position:relative">
        <div class="corner-accent corner-tl" style="width:15px; height:15px"></div>
        <div class="corner-accent corner-br" style="width:15px; height:15px"></div>
        {{ $p }}
      </div>
      <div class="display" style="font-size:2rem;color:var(--accent);margin-bottom:15px">{{ $t }}</div>
      <p class="mono" style="font-size:0.95rem;color:var(--muted);line-height:1.6">{{ $d }}</p>
    </div>
    @endforeach
  </div>
</section>

@endsection