<x-app-layout>
    @php
        $drawIso = $ticket->draw_date->toIso8601String();
        $bg = $ticket->bg_color;
        $units = [['days','Days'],['hours','Hrs'],['minutes','Mins'],['seconds','Secs']];

        $makeLabelColor = function ($hex) {
            [$r,$g,$b] = sscanf($hex,'#%02x%02x%02x');
            $r/=255; $g/=255; $b/=255;
            $max=max($r,$g,$b); $min=min($r,$g,$b);
            $l=($max+$min)/2; $d=$max-$min;
            $h=$s=0;
            if($d){
                $s=$l>0.5?$d/(2-$max-$min):$d/($max+$min);
                switch($max){
                    case $r: $h=($g-$b)/$d+($g<$b?6:0); break;
                    case $g: $h=($b-$r)/$d+2; break;
                    case $b: $h=($r-$g)/$d+4; break;
                }
                $h/=6;
            }
            $h=max(0,($h*360-10)/360);
            $s=min(1,$s+0.15);
            $l=min(1,$l+0.2);

            $hue=function($p,$q,$t)use(&$hue){
                if($t<0)$t+=1;if($t>1)$t-=1;
                return $t<1/6?$p+($q-$p)*6*$t:($t<1/2?$q:($t<2/3?$p+($q-$p)*(2/3-$t)*6:$p));
            };
            $q=$l<0.5?$l*(1+$s):$l+$s-$l*$s; $p=2*$l-$q;
            $R=intval($hue($p,$q,$h+1/3)*255);
            $G=intval($hue($p,$q,$h)*255);
            $B=intval($hue($p,$q,$h-1/3)*255);
            return "rgb($R,$G,$B)";
        };

        $labelBg = $makeLabelColor($bg);
    @endphp

    {{-- COUNTDOWN HERO BANNER --}}
    <div x-data="countdownTimer('{{ $drawIso }}')" x-init="start()" class="pb-10 pt-16" style="background-color:{{ $bg }}">
        <h1 class="text-7xl font-extrabold text-center text-white mb-4">
            {{ $ticket->name }}
        </h1>
        <time class="pb-12 text-4xl font-medium block text-center text-white">
            {{ $ticket->draw_date->format('F j, Y') }}
        </time>

        <template x-if="remaining >= 0">
            <div class="flex justify-center items-center">
                @foreach ($units as [$key, $label])
                    <div class="flex flex-col items-center border-white border-2 rounded-lg"
                        style="background-color:{{ $labelBg }}">
                        <div class="rounded px-4 py-2 bg-white">
                            <span x-text="String({{ $key }}).padStart(2,'0')" class="text-3xl font-bold"
                                style="color:{{ $bg }}"></span>
                        </div>
                        <span class="pt-1 w-full text-xs text-center uppercase text-white">
                            {{ $label }}
                        </span>
                    </div>
                    @if (!$loop->last)
                        <span class="text-3xl font-bold mx-2 text-white">:</span>
                    @endif
                @endforeach
            </div>
        </template>

        <template x-if="remaining < 0">
            <div class="text-white font-bold text-center">
                Draw has started!
            </div>
        </template>
    </div>

    {{-- NAVIGATION + CONTENT --}}
    <div x-data="{ activeTab: 'buy' }" class="w-full">

        {{-- NAV LINKS --}}
        <div class="flex items-center justify-center text-base font-medium text-white py-3"
            style="background-color: {{ $labelBg }};">
            <span class="h-6 border-l-2 border-white mx-2"></span>
            <button @click="activeTab = 'buy'"
                :class="activeTab === 'buy' ? 'opacity-100 font-bold' : 'opacity-50 hover:opacity-100'"
                class="px-3">BUY NOW</button>

            <span class="h-6 border-l-2 border-white mx-2"></span>
            <button @click="activeTab = 'how'"
                :class="activeTab === 'how' ? 'opacity-100 font-bold' : 'opacity-50 hover:opacity-100'"
                class="px-3">HOW TO PLAY</button>

            <span class="h-6 border-l-2 border-white mx-2"></span>
            <button @click="activeTab = 'prizes'"
                :class="activeTab === 'prizes' ? 'opacity-100 font-bold' : 'opacity-50 hover:opacity-100'"
                class="px-3">PRIZES</button>

            <span class="h-6 border-l-2 border-white mx-2"></span>
            <button @click="activeTab = 'results'"
                :class="activeTab === 'results' ? 'opacity-100 font-bold' : 'opacity-50 hover:opacity-100'"
                class="px-3">PAST RESULTS</button>
        </div>

        {{-- BREADCRUMB --}}
        <div
            class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-20 xl:px-24 py-6 sm:py-8 md:py-10 border-b-2 uppercase text-center">
            <nav
                class="flex flex-wrap justify-start items-center space-x-2 text-xs sm:text-sm md:text-base font-medium">
                <a href="{{ route('users.index') }}" class="hover:underline px-1 sm:px-2">Home</a>
                <span>/</span>
                <span class="text-[#1083E5]">Games</span>
                <span>/</span>
                <span class="text-[#1083E5]"
                    x-text="activeTab === 'buy' ? 'Buy Now' : (activeTab === 'how' ? 'How to Play' : (activeTab === 'prizes' ? 'Prizes' : 'Past Results'))">
                </span>
            </nav>

            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center mt-3"
                x-text="activeTab === 'buy' ? 'Buy Now' : (activeTab === 'how' ? 'How to Play' : (activeTab === 'prizes' ? 'Prizes' : 'Past Results'))">
            </h1>
        </div>

        {{-- CONTENT SECTIONS --}}
        <div class="p-6">
            {{-- BUY NOW --}}
            <template x-if="activeTab === 'buy'">
                {{-- TICKET SELECTOR WIDGET   --}}
                <div x-data='{
                        tickets: @json($tickets->pluck('ticket_number')),
                        qty: 1,
                        price: {{ $ticket->price }},
                        canInc() { return this.qty < this.tickets.length },
                        canDec() { return this.qty > 1 }
                    }'
                    class="flex flex-col items-center space-y-4 p-4">
                    <!-- 1. Ticket numbers -->
                    <div class="flex flex-wrap justify-center gap-2">
                        <template x-for="(tn, idx) in tickets" :key="idx">
                            <div x-show="idx < qty"
                                class="px-3 py-1 rounded bg-[#1f356e]/20 text-[#1f356e] font-medium">
                                <span x-text="tn"></span>
                            </div>
                        </template>
                    </div>

                    <!-- 2. Controls -->
                    <div class="flex items-center space-x-3">
                        <button @click="qty--" :disabled="!canDec()"
                            :class="!canDec() ?
                                'opacity-50 cursor-not-allowed' :
                                'border-[#1f356e] text-[#1f356e] hover:bg-[#1f356e]/10'"
                            class="w-10 h-10 flex items-center justify-center border-2 rounded-full text-lg font-bold">–</button>

                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1f356e] text-white text-lg font-bold">
                            <span x-text="qty"></span>
                        </div>

                        <button @click="qty++" :disabled="!canInc()"
                            :class="!canInc() ?
                                'opacity-50 cursor-not-allowed' :
                                'border-[#1f356e] text-[#1f356e] hover:bg-[#1f356e]/10'"
                            class="w-10 h-10 flex items-center justify-center border-2 rounded-full text-lg font-bold">+</button>
                    </div>

                    <!-- 3. Subtotal -->
                    <p class="font-medium text-black">
                        Subtotal Price <span x-text="qty * price"></span>
                    </p>

                    <!-- 4. Add to Cart -->
                    <button :disabled="qty === 0" class="w-64 py-3 rounded-full font-bold text-white transition"
                        :class="qty === 0 ?
                            'bg-gray-300 cursor-not-allowed' :
                            'bg-[#1f356e] hover:bg-[#162750]'">
                        ADD TO CART
                    </button>
                </div>
            </template>

            {{-- HOW TO PLAY --}}
            <template x-if="activeTab === 'how'">
                <div>
                    <h2 class="text-lg font-bold mb-4">How to Play</h2>
                    <p class="text-gray-700 text-center">➡️ Add rules here...</p>
                </div>
            </template>

            {{-- PRIZES --}}
            <template x-if="activeTab === 'prizes'">
                <div>
                    <h2 class="text-lg font-bold mb-4">Prizes</h2>
                    <p class="text-gray-700 text-center">🏆 Show prize structure...</p>
                </div>
            </template>

            {{-- PAST RESULTS --}}
            <template x-if="activeTab === 'results'">
                <div>
                    <h2 class="text-lg font-bold mb-4">Past Results</h2>
                    <p class="text-gray-700 text-center">📊 Display results table...</p>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>
