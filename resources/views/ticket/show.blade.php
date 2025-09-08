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
    <div x-data="countdownTimer('{{ $drawIso }}')" x-init="start()" class="pb-8 sm:pb-10 md:pb-12 pt-10 sm:pt-14 md:pt-16"
        style="background-color:{{ $bg }}">

        {{-- Title --}}
        <h1 class="text-3xl sm:text-5xl md:text-7xl font-extrabold text-center text-white mb-3 sm:mb-4">
            {{ $ticket->name }}
        </h1>

        {{-- Date --}}
        <time class="pb-6 sm:pb-10 text-lg sm:text-2xl md:text-4xl font-medium block text-center text-white">
            {{ $ticket->draw_date->format('F j, Y') }}
        </time>

        {{-- Countdown --}}
        <template x-if="remaining >= 0">
            <div class="flex flex-wrap justify-center items-center text-white">
                @foreach ($units as [$key, $label])
                    <div class="flex flex-col items-center border-white border-2 rounded-lg m-1 sm:m-2"
                        style="background-color:{{ $labelBg }}">
                        <div class="rounded px-3 py-1 sm:px-4 sm:py-2 bg-white">
                            <span x-text="String({{ $key }}).padStart(2,'0')"
                                class="text-xl sm:text-2xl md:text-3xl font-bold"
                                style="color:{{ $bg }}"></span>
                        </div>
                        <span class="pt-1 w-full text-[10px] sm:text-xs md:text-sm text-center uppercase text-white">
                            {{ $label }}
                        </span>
                    </div>

                    @if (!$loop->last)
                        <span class="text-xl sm:text-2xl md:text-3xl font-bold mx-1 sm:mx-2">:</span>
                    @endif
                @endforeach
            </div>
        </template>

        {{-- Expired --}}
        <template x-if="remaining < 0">
            <div class="text-white font-bold text-center text-base sm:text-lg md:text-xl">
                Draw has started!
            </div>
        </template>
    </div>

    {{-- NAVIGATION + BREADCRUMB + CONTENT (single Alpine scope) --}}
    <div x-data="{
        activeTab: window.location.hash.replace('#', '') || 'buy',
        open: false
    }" class="w-full">

        {{-- DESKTOP TABS --}}
        <div class="hidden md:flex items-center justify-center text-base font-medium text-white py-3"
            style="background-color: {{ $labelBg }};">
            <template
                x-for="tab in [
                    { key: 'buy', label: 'BUY NOW' },
                    { key: 'how', label: 'HOW TO PLAY' },
                    { key: 'prizes', label: 'PRIZES' },
                    { key: 'winners', label: 'WINNERS' }
                ]"
                :key="tab.key">
                <div class="flex items-center">
                    <button @click="activeTab=tab.key"
                        :class="activeTab === tab.key ? 'opacity-100 font-bold' : 'opacity-70 hover:opacity-100'"
                        class="px-4" x-text="tab.label"></button>
                    <span x-show="tab.key!=='winners'" class="h-6 border-l-2 border-white mx-2"></span>
                </div>
            </template>
        </div>

        {{-- MOBILE DROPDOWN --}}
        <div class="md:hidden relative py-3 px-4 text-white" style="background-color: {{ $labelBg }};">
            <button @click="open=!open" class="w-full flex items-center justify-between font-bold">
                <span
                    x-text="activeTab==='buy' ? 'BUY NOW' :
                          activeTab==='how' ? 'HOW TO PLAY' :
                          activeTab==='prizes' ? 'PRIZES' : 'WINNERS'"></span>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-2 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-transition @click.outside="open=false"
                class="absolute left-4 right-4 mt-2 bg-white text-black rounded-lg shadow-lg z-10 overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    <template
                        x-for="tab in [
                    { key: 'buy', label: 'BUY NOW' },
                    { key: 'how', label: 'HOW TO PLAY' },
                    { key: 'prizes', label: 'PRIZES' },
                    { key: 'winners', label: 'WINNERS' }
                ]"
                        :key="tab.key">
                        <li>
                            <button @click="activeTab=tab.key; open=false"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-50" x-text="tab.label"></button>
                        </li>
                    </template>
                </ul>
            </div>
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
                    x-text="activeTab === 'buy' ? 'Buy Now' : (activeTab === 'how' ? 'How to Play' : (activeTab === 'prizes' ? 'Prizes' : 'Winners'))">
                </span>
            </nav>

            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center mt-3"
                x-text="activeTab === 'buy' ? 'Buy Now' : (activeTab === 'how' ? 'How to Play' : (activeTab === 'prizes' ? 'Prizes' : 'Winners'))">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $steps = [
                                'Log in to your account or register.',
                                'Select the number of tickets you would like to purchase.',
                                "Choose any 5 numbers between 1 to 42 per ticket. Or, click on the 'RANDOMISE' icon and we’ll select your numbers for you.",
                                "Confirm your numbers and select the 'HEART' icon to add it to your favourites for all future draws.",
                                'Select the type of draw: <strong>Current Draw</strong> (this week’s draw) or <strong>Multiple Upcoming Draws</strong> (up to 5 upcoming draws).',
                                'Use any debit/credit card or your wallet balance to make the payment.',
                                'Once payment is complete, you will receive an email confirming your entry.',
                                'Check out the Draw results every Saturday on our Website and App at 5 PM (GMT), 9 PM (GST), or 10:30 PM (IST).',
                            ];
                        @endphp

                        @foreach ($steps as $index => $text)
                            <div
                                class="flex flex-col items-start gap-4 md:gap-7 p-4 border border-[#D2DEFF] rounded-xl shadow-sm bg-[#F8FAFF]">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#21366F0D] text-[#21366F] font-bold text-lg">
                                    {{ $index + 1 }}
                                </div>
                                <p class="text-[#071221] text-sm leading-relaxed">{!! $text !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </template>

            {{-- PRIZES --}}
            <template x-if="activeTab === 'prizes'">
                <div class="flex flex-wrap justify-center items-center gap-6 p-4">
                    <div
                        class="w-full sm:w-80 md:w-96 bg-[#21366F] rounded-2xl overflow-hidden shadow-[3.75px_3.75px_3.75px_rgba(0,0,0,0.25),-4px_-4px_4px_rgba(0,0,0,0.15)]">
                        <!-- White Top Section -->
                        <div class="relative flex flex-col items-center justify-center">
                            <img class="w-full" src="{{ asset('assets/trophy.svg') }}" alt="Trophy">

                            <h2 class="text-4xl font-medium mt-7 text-[#FDC741] uppercase">PLATINUM</h2>

                            <div
                                class="flex justify-center space-x-3 mt-6 [&>*]:h-12 [&>*]:w-12 [&>*]:bg-white [&>*]:text-2xl [&>*]:font-medium [&>*]:text-[#21366F] [&>*]:rounded-full">
                                <div class="flex items-center justify-center">7</div>
                                <div class="flex items-center justify-center">4</div>
                                <div class="flex items-center justify-center">3</div>
                                <div class="flex items-center justify-center">9</div>
                                <div class="flex items-center justify-center">2</div>
                            </div>

                        </div>

                        <div class="px-6 py-8 text-center text-white">
                            <p class="text-2xl font-bold">
                                PKR 500
                                <span class="text-sm font-medium">× 70</span>
                            </p>
                            <p class="mt-1 text-gray-300">Every Month</p>
                        </div>
                    </div>
                    <div
                        class="w-full sm:w-80 md:w-96 bg-[#21366F] rounded-2xl overflow-hidden shadow-[3.75px_3.75px_3.75px_rgba(0,0,0,0.25),-4px_-4px_4px_rgba(0,0,0,0.15)]">
                        <!-- White Top Section -->
                        <div class="relative flex flex-col items-center justify-center">
                            <img class="w-full" src="{{ asset('assets/trophy.svg') }}" alt="Trophy">

                            <h2 class="text-4xl font-medium mt-7 text-[#FDC741] uppercase">GOLD</h2>

                            <div
                                class="flex justify-center space-x-3 mt-6 [&>*]:h-12 [&>*]:w-12 [&>*]:bg-white [&>*]:text-2xl [&>*]:font-medium [&>*]:text-[#21366F] [&>*]:rounded-full">
                                <div class="flex items-center justify-center">2</div>
                                <div class="flex items-center justify-center">5</div>
                                <div class="flex items-center justify-center">9</div>
                                <div class="flex items-center justify-center">6</div>
                                <div class="flex items-center justify-center">3</div>
                            </div>

                        </div>

                        <div class="px-6 py-8 text-center text-white">
                            <p class="text-2xl font-bold">
                                PKR 200
                                <span class="text-sm font-medium">× 40</span>
                            </p>
                            <p class="mt-1 text-gray-300">Every Month</p>
                        </div>
                    </div>
                    <div
                        class="w-full sm:w-80 md:w-96 bg-[#21366F] rounded-2xl overflow-hidden shadow-[3.75px_3.75px_3.75px_rgba(0,0,0,0.25),-4px_-4px_4px_rgba(0,0,0,0.15)]">
                        <!-- White Top Section -->
                        <div class="relative flex flex-col items-center justify-center">
                            <img class="w-full" src="{{ asset('assets/trophy.svg') }}" alt="Trophy">

                            <h2 class="text-4xl font-medium mt-7 text-[#FDC741] uppercase">DAIMOND</h2>

                            <div
                                class="flex justify-center space-x-3 mt-6 [&>*]:h-12 [&>*]:w-12 [&>*]:bg-white [&>*]:text-2xl [&>*]:font-medium [&>*]:text-[#21366F] [&>*]:rounded-full">
                                <div class="flex items-center justify-center">5</div>
                                <div class="flex items-center justify-center">6</div>
                                <div class="flex items-center justify-center">9</div>
                                <div class="flex items-center justify-center">2</div>
                                <div class="flex items-center justify-center">1</div>
                            </div>

                        </div>

                        <div class="px-6 py-8 text-center text-white">
                            <p class="text-2xl font-bold">
                                PKR 1000
                                <span class="text-sm font-medium">× 50</span>
                            </p>
                            <p class="mt-1 text-gray-300">Every Month</p>
                        </div>
                    </div>
                </div>
            </template>


            {{-- WINNERS --}}
            <template x-if="activeTab === 'winners'">
                <div>
                    <p class="text-gray-700 text-center">No Winners Found.</p>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>
