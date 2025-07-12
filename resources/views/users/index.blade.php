<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot> --}}

    <div class="Slider overflow-hidden relative">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full swiper-banner-card" src="{{ asset('assets/sliders/kingdom-slider.png') }}"
                        alt="Banner">
                </div>
                <div class="swiper-slide">
                    <img class="w-full swiper-banner-card" src="{{ asset('assets/sliders/kingdom-slider.png') }}"
                        alt="Banner">
                </div>
            </div>

            <!-- Pagination and Navigation -->
            <div class="swiper-pagination"></div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <style>
            .swiper-pagination {
                margin-bottom: 25px;
            }

            /* Inactive pagination bullet: mimic Tailwind's white with opacity */
            .swiper-pagination-bullet {
                width: 1rem;
                height: 1rem;
                border-radius: 100%;
                background-color: rgba(255, 255, 255, 0.5) !important;
            }

            /* Active pagination bullet: pure white */
            .swiper-pagination-bullet-active {
                background-color: #fff !important;
            }

            /* Navigation arrows in white */
            .swiper-button-next,
            .swiper-button-prev {
                color: #fff !important;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const swiper = new Swiper('.swiper-container', {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    autoplay: {
                        delay: 3000,
                    },
                    // Uncomment below for a fade effect
                    // effect: 'fade',
                    // fadeEffect: { crossFade: true },
                });
            });
        </script>
    </div>


    <div class="Tickets py-12">
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-[45px] font-medium text-center">
            Our Games
        </h2>

        <div x-data="carousel()" x-init="init(); initTimers()" x-ref="viewport"
            class="relative w-full overflow-hidden pt-16" @mousedown.prevent="dragStart" @mousemove.prevent="dragMove"
            @mouseup.prevent="dragEnd" @mouseleave.prevent="dragEnd" @touchstart.prevent="dragStart"
            @touchmove.prevent="dragMove" @touchend.prevent="dragEnd">
            <div class="flex transition-transform duration-300 ease-in-out"
                :style="`transform: translateX(${translate}px)`">
                <template x-for="(card, idx) in cards" :key="idx">

                    <div class="flex-shrink-0 px-1" :style="`width: ${itemWidth}px; margin-right: ${gap}px;`">
                        <div :class="idx === active ? 'scale-100 z-10' : 'scale-90 z-0'"
                            class="bg-white rounded-lg shadow-lg transform transition-transform duration-300">
                            <div :class="card.bg" class="p-6 text-center text-white rounded-lg">
                                <h3 class="text-xl font-bold">PRIZE UP TO</h3>
                                <h3 class="text-2xl font-bold">AED 1,000,000</h3>
                                <p class="mt-8 text-xl font-bold">WIN</p>
                                <p class="mt-2 text-3xl font-bold">50X</p>
                                <p class="mt-2 text-2xl font-bold">YOUR ENTRY VALUE</p>
                                <div class="mt-4 flex justify-center items-end space-x-4">
                                    <!-- Minutes Box -->
                                    <div class="flex flex-col items-center border-white border-2 rounded-lg">
                                        <div class="bg-white rounded px-4 py-2">
                                            <span x-text="getMinutes(card.seconds)"
                                                class="text-3xl font-bold text-black">
                                            </span>
                                        </div>
                                        <span class="mt-1 text-xs uppercase">Mins</span>
                                    </div>

                                    <!-- Seconds Box -->
                                    <div class="flex flex-col items-center border-white border-2 rounded-lg">
                                        <div class="bg-white rounded px-4 py-2">
                                            <span x-text="getSeconds(card.seconds)"
                                                class="text-3xl font-bold text-black">
                                            </span>
                                        </div>
                                        <span class="mt-1 text-xs uppercase">Sec</span>
                                    </div>
                                </div>
                                <button
                                    class="bg-white text-red-600 rounded-full text-xl font-bold py-3 px-5 mt-10 uppercase tracking-wide hover:bg-gray-100">
                                    BUY NOW
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <script>
            function carousel() {
                return {
                    active: 1,
                    cards: [{
                            bg: 'bg-[#0D2657]',
                            seconds: 12 * 60 + 55
                        },
                        {
                            bg: 'bg-[#E91F1C]',
                            seconds: 12 * 60 + 55
                        },
                        {
                            bg: 'bg-[#FDC741]',
                            seconds: 12 * 60 + 55
                        },
                    ],

                    // bumped up width → 360px, tighter gap → 12px
                    itemWidth: 360,
                    gap: 12,
                    viewportWidth: 0,

                    isDragging: false,
                    startX: 0,
                    currentTranslate: 0,

                    init() {
                        this.viewportWidth = this.$refs.viewport.clientWidth;
                        window.addEventListener('resize', () => {
                            this.viewportWidth = this.$refs.viewport.clientWidth;
                        });
                    },
                    initTimers() {
                        this.cards.forEach(card => {
                            card.interval = setInterval(() => {
                                if (card.seconds > 0) card.seconds--;
                                else clearInterval(card.interval);
                            }, 1000);
                        });
                    },
                    formatTime(sec) {
                        const m = Math.floor(sec / 60),
                            s = sec % 60;
                        return `${m}:${String(s).padStart(2,'0')}`;
                    },
                    getMinutes(sec) {
                        return Math.floor(sec / 60);
                    },
                    getSeconds(sec) {
                        return sec % 60;
                    },
                    get translate() {
                        const centerOffset = (this.viewportWidth - this.itemWidth) / 2,
                            slideOffset = this.active * (this.itemWidth + this.gap),
                            baseX = centerOffset - slideOffset;
                        return this.isDragging ?
                            baseX + this.currentTranslate :
                            baseX;
                    },
                    prev() {
                        this.active = this.active > 0 ?
                            this.active - 1 :
                            this.cards.length - 1;
                    },
                    next() {
                        this.active = this.active < this.cards.length - 1 ?
                            this.active + 1 :
                            0;
                    },
                    dragStart(e) {
                        this.isDragging = true;
                        this.startX = e.type.startsWith('mouse') ?
                            e.clientX :
                            e.touches[0].clientX;
                        this.currentTranslate = 0;
                    },
                    dragMove(e) {
                        if (!this.isDragging) return;
                        const clientX = e.type.startsWith('mouse') ?
                            e.clientX :
                            e.touches[0].clientX;
                        this.currentTranslate = clientX - this.startX;
                    },
                    dragEnd() {
                        if (!this.isDragging) return;
                        this.isDragging = false;
                        const threshold = this.itemWidth * 0.2;
                        if (this.currentTranslate < -threshold) this.next();
                        if (this.currentTranslate > threshold) this.prev();
                        this.currentTranslate = 0;
                    },
                }
            }
        </script>
    </div>


    <section id="winning-section" class="px-4 sm:px-6 md:px-8 lg:px-14 xl:px-20">
        <div class="text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-[45px] pt-12 font-medium text-center">
                Winning Members</h2>
            <!-- Use 4 columns on md and above -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-10 mt-12 lg:mt-16">
                <!-- Panel 1: Grand Prize (span 1) -->
                <div
                    class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center md:col-span-1">
                    <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Grand Prize Winner</h3>
                    <div id="grandPrizeContainer" class="flex text-4xl font-bold overflow-hidden"></div>
                </div>
                <!-- Panel 2: Middle (span 2) -->
                <div
                    class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center justify-center md:col-span-2">
                    <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Meet Our Lucky Winners</h3>
                    <img class="rounded-full w-64" src="{{ asset('assets/winners/minion.jpg') }}" alt="">
                    <button class="text-[#FDC741] underline text-[32px]">Know More</button>
                </div>
                <!-- Panel 3: Total Winning (span 1) -->
                <div
                    class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center md:col-span-1">
                    <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Total Winning & Counting</h3>
                    <div id="totalWinningContainer" class="flex text-4xl font-bold overflow-hidden"></div>
                </div>
            </div>
        </div>
        <!-- Your JavaScript code remains unchanged -->
        <script>
            function animateRollingDigits(containerId, formattedNumber) {
                const container = document.getElementById(containerId);
                if (!container) return;
                container.innerHTML = '';

                const cs = window.getComputedStyle(container);
                const fontSize = cs.fontSize;
                const fontFamily = cs.fontFamily;
                const fontWeight = cs.fontWeight;
                const letterSpacing = cs.letterSpacing;

                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const fontDesc = `${fontWeight} ${fontSize} ${fontFamily}`;
                ctx.font = fontDesc;

                const SLOT_HEIGHT = parseFloat(fontSize);
                const TRANSITION_DURATION_MS = 1000;
                const DELAY_MS = 150;
                const EXTRA_PADDING = 2;

                [...formattedNumber].forEach((ch, idx) => {
                    let measuredWidth = ctx.measureText(ch).width;
                    const ls = parseFloat(letterSpacing) || 0;
                    measuredWidth += ls;
                    const charWidth = Math.ceil(measuredWidth) + EXTRA_PADDING;

                    const wrapper = document.createElement('div');
                    wrapper.style.width = charWidth + 'px';
                    wrapper.style.height = SLOT_HEIGHT + 'px';
                    wrapper.className = 'overflow-hidden relative flex-shrink-0';

                    const inner = document.createElement('div');
                    inner.className = 'absolute top-0 left-0';
                    inner.style.transition = `transform ${TRANSITION_DURATION_MS}ms ease-out`;

                    if (/[0-9]/.test(ch)) {
                        for (let d = 0; d <= 9; d++) {
                            const dv = document.createElement('div');
                            dv.className = 'text-center';
                            dv.style.height = SLOT_HEIGHT + 'px';
                            dv.style.lineHeight = SLOT_HEIGHT + 'px';
                            dv.textContent = d;
                            inner.appendChild(dv);
                        }
                        const target = parseInt(ch, 10);
                        setTimeout(() => {
                            inner.style.transform = `translateY(-${SLOT_HEIGHT * target}px)`;
                        }, 100 + idx * DELAY_MS);
                    } else {
                        const dv = document.createElement('div');
                        dv.className = 'text-center';
                        dv.style.height = SLOT_HEIGHT + 'px';
                        dv.style.lineHeight = SLOT_HEIGHT + 'px';
                        dv.textContent = ch;
                        inner.appendChild(dv);
                    }

                    wrapper.appendChild(inner);
                    container.appendChild(wrapper);
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                const section = document.getElementById('winning-section');
                if (!section) return;

                function run() {
                    animateRollingDigits('grandPrizeContainer', '{{ number_format($grandPrize ?? 1444444) }}');
                    animateRollingDigits('totalWinningContainer', '{{ number_format($totalWinning ?? 2000123) }}');
                }
                if ('IntersectionObserver' in window) {
                    new IntersectionObserver((entries, obs) => {
                        entries.forEach(e => {
                            if (e.isIntersecting) {
                                run();
                                obs.unobserve(e.target);
                            }
                        });
                    }, {
                        threshold: 0.3
                    }).observe(section);
                } else {
                    run();
                }
            });
        </script>
    </section>


    <section class="download py-12 sm:py-16 md:py-20 xl:py-24 px-4 sm:px-6 md:px-8 lg:px-14">
        <div class="flex flex-col items-center gap-6">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-[45px] font-medium">
                DOWNLOAD, PLAY, WIN
            </h2>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-10 mt-6">
                <a href="…" target="_blank"
                    class="flex items-center justify-center h-20 sm:h-24 bg-[#060606] text-white px-8 sm:px-12 rounded-2xl transition-shadow hover:shadow-lg">
                    <svg class="h-16 w-auto mr-5" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 511.999 511.999" xml:space="preserve" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path style="fill:#32BBFF;"
                                    d="M382.369,175.623C322.891,142.356,227.427,88.937,79.355,6.028 C69.372-0.565,57.886-1.429,47.962,1.93l254.05,254.05L382.369,175.623z">
                                </path>
                                <path style="fill:#32BBFF;"
                                    d="M47.962,1.93c-1.86,0.63-3.67,1.39-5.401,2.308C31.602,10.166,23.549,21.573,23.549,36v439.96 c0,14.427,8.052,25.834,19.012,31.761c1.728,0.917,3.537,1.68,5.395,2.314L302.012,255.98L47.962,1.93z">
                                </path>
                                <path style="fill:#32BBFF;"
                                    d="M302.012,255.98L47.956,510.035c9.927,3.384,21.413,2.586,31.399-4.103 c143.598-80.41,237.986-133.196,298.152-166.746c1.675-0.941,3.316-1.861,4.938-2.772L302.012,255.98z">
                                </path>
                            </g>
                            <path style="fill:#2C9FD9;"
                                d="M23.549,255.98v219.98c0,14.427,8.052,25.834,19.012,31.761c1.728,0.917,3.537,1.68,5.395,2.314 L302.012,255.98H23.549z">
                            </path>
                            <path style="fill:#29CC5E;"
                                d="M79.355,6.028C67.5-1.8,53.52-1.577,42.561,4.239l255.595,255.596l84.212-84.212 C322.891,142.356,227.427,88.937,79.355,6.028z">
                            </path>
                            <path style="fill:#D93F21;"
                                d="M298.158,252.126L42.561,507.721c10.96,5.815,24.939,6.151,36.794-1.789 c143.598-80.41,237.986-133.196,298.152-166.746c1.675-0.941,3.316-1.861,4.938-2.772L298.158,252.126z">
                            </path>
                            <path style="fill:#FFD500;"
                                d="M488.45,255.98c0-12.19-6.151-24.492-18.342-31.314c0,0-22.799-12.721-92.682-51.809l-83.123,83.123 l83.204,83.205c69.116-38.807,92.6-51.892,92.6-51.892C482.299,280.472,488.45,268.17,488.45,255.98z">
                            </path>
                            <path style="fill:#FFAA00;"
                                d="M470.108,287.294c12.191-6.822,18.342-19.124,18.342-31.314H294.303l83.204,83.205 C446.624,300.379,470.108,287.294,470.108,287.294z">
                            </path>
                        </g>
                    </svg>
                    <p class="flex flex-col">
                        <span class="text-sm sm:text-base font-light">Available App on</span>
                        <span class="font-medium text-lg sm:text-2xl">Google Play</span>
                    </p>
                </a>

                <a href="…" target="_blank"
                    class="flex items-center justify-center h-20 sm:h-24 bg-[#060606] text-white px-8 sm:px-12 rounded-2xl transition-shadow hover:shadow-lg">
                    <svg class="h-16 w-auto mr-5" fill="#ffffff" height="200px" width="200px" version="1.1"
                        id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 311.265 311.265" xml:space="preserve" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M151.379,82.354c0.487,0.015,0.977,0.022,1.464,0.022c0.001,0,0.001,0,0.002,0c17.285,0,36.041-9.745,47.777-24.823 C212.736,42.011,218.24,23.367,215.723,6.4c-0.575-3.875-4.047-6.662-7.943-6.381c-17.035,1.193-36.32,11.551-47.987,25.772 c-12.694,15.459-18.51,34.307-15.557,50.418C144.873,79.684,147.848,82.243,151.379,82.354z M171.388,35.309 c7.236-8.82,18.949-16.106,29.924-19.028c-0.522,14.924-8.626,27.056-12.523,32.056c-7.576,9.732-19.225,16.735-30.338,18.566 C158.672,52.062,168.14,39.265,171.388,35.309z">
                                </path>
                                <path
                                    d="M282.608,226.332c-0.794-1.91-2.343-3.407-4.279-4.137c-30.887-11.646-40.56-45.12-31.807-69.461 c4.327-12.073,12.84-21.885,24.618-28.375c1.938-1.068,3.306-2.938,3.737-5.109c0.431-2.171-0.12-4.422-1.503-6.149 c-15.654-19.536-37.906-31.199-59.525-31.199c-15.136,0-25.382,3.886-34.422,7.314c-6.659,2.525-12.409,4.706-19.001,4.706 c-7.292,0-13.942-2.382-21.644-5.141c-9.003-3.225-19.206-6.88-31.958-6.88c-24.577,0-49.485,14.863-65.013,38.803 c-5.746,8.905-9.775,19.905-11.98,32.708c-6.203,36.422,4.307,79.822,28.118,116.101c13.503,20.53,30.519,41.546,54.327,41.749 l0.486,0.002c9.917,0,16.589-2.98,23.041-5.862c6.818-3.045,13.258-5.922,24.923-5.98l0.384-0.001 c11.445,0,17.681,2.861,24.283,5.89c6.325,2.902,12.866,5.903,22.757,5.903l0.453-0.003c23.332-0.198,41.002-22.305,55.225-43.925 c8.742-13.391,12.071-20.235,18.699-35.003C283.373,230.396,283.402,228.242,282.608,226.332z M251.281,259.065 c-11.329,17.222-26.433,37.008-42.814,37.148l-0.318,0.001c-6.615,0-10.979-2.003-16.503-4.537 c-7.046-3.233-15.815-7.256-30.538-7.256l-0.463,0.001c-14.819,0.074-23.77,4.072-30.961,7.285 c-5.701,2.547-10.204,4.558-16.923,4.558l-0.348-0.001c-16.862-0.145-31.267-18.777-41.929-34.987 c-21.78-33.184-31.45-72.565-25.869-105.332c1.858-10.789,5.155-19.909,9.79-27.093c12.783-19.708,32.869-31.951,52.419-31.951 c10.146,0,18.284,2.915,26.9,6.001c8.262,2.96,16.805,6.02,26.702,6.02c9.341,0,16.956-2.888,24.32-5.681 c8.218-3.117,16.717-6.34,29.104-6.34c14.739,0,30.047,7.097,42.211,19.302c-11.002,8.02-19.102,18.756-23.655,31.461 c-11.872,33.016,2.986,69.622,33.334,85.316C261.229,242.764,258.024,248.734,251.281,259.065z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <p class="flex flex-col">
                        <span class="text-sm sm:text-base font-light">Download on</span>
                        <span class="font-medium text-lg sm:text-2xl">App Store</span>
                    </p>
                </a>
            </div>
        </div>
    </section>

</x-app-layout>
