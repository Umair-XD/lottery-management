<div class="Products py-8 sm:py-12">
    <h2 class="text-3xl md:text-4xl lg:text-[45px] font-medium text-center">
        Win All Prizes
    </h2>

    <div x-data="carousel({
        endpoint: '/api/v1/products',
        dateField: 'draw_date',
        fields: {
            id: 'id',
            bg_color: 'bg_color',
            image: 'image',
            title: 'title',
            price: 'price',
            duration_phrase: 'duration_phrase'
        },
        gap: 10
    })" x-init="init()" x-ref="viewport"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 overflow-x-auto pb-8" @mousedown.prevent="dragStart"
        @mousemove.prevent="dragMove" @mouseup.prevent="dragEnd" @mouseleave.prevent="dragEnd"
        @touchstart="dragStart($event)" @touchmove="dragMove($event)" @touchend="dragEnd">
        <!-- Slides -->
        <div class="flex transition-transform duration-300 ease-in-out"
            :style="`transform: translateX(${translate}px)`">
            <template x-for="(card, idx) in cards" :key="card.id">
                <div class="flex-shrink-0" :style="`width: ${itemWidth}px; margin-right: ${gap}px;`">
                    <div :class="idx === active ? 'scale-100 z-10' : 'scale-90 z-0'"
                        class="bg-white rounded-lg shadow-lg transform transition-transform duration-300 overflow-hidden">
                        <div class="p-6 text-center text-white" :style="`background-color: ${card.bg_color}`">
                            <!-- Header -->
                            <p class="text-xs sm:text-sm uppercase font-bold tracking-wide" x-text="card.price_label">
                            </p>
                            <p class="mt-2 text-lg sm:text-xl font-bold" x-text="card.title">
                            </p>
                            <p class="mt-2 text-xs sm:text-sm uppercase tracking-wide" x-text="card.subtitle">
                            </p>

                            <!-- Image -->
                            <div class="mt-4 flex justify-center">
                                <img :src="card.image" alt="Prize image"
                                    class="h-48 w-48 object-cover rounded-lg shadow-sm" />
                            </div>

                            <!-- Countdown -->
                            <div class="mt-4 flex justify-center space-x-2">
                                <template x-for="unit in ['Days','Hours','Mins','Sec']" :key="unit">
                                    <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                        <div class="bg-white px-3 py-2">
                                            <span class="text-xl sm:text-2xl font-bold text-black"
                                                x-text="{
                                                Days:    getDays(card.seconds),
                                                Hours:   getHours(card.seconds),
                                                Mins:    getMinutes(card.seconds),
                                                Sec:     getSeconds(card.seconds)
                                                }[unit]">
                                            </span>
                                        </div>
                                        <span class="mt-1 text-xs uppercase" x-text="unit"></span>
                                    </div>
                                </template>
                            </div>

                            <!-- Call to action -->
                            <button
                                class="mt-6 bg-white text-red-600 font-bold uppercase text-sm sm:text-base py-2 rounded-full w-full hover:bg-gray-100">
                                BUY NOW
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Pagination dots -->
        <div class="mt-7 flex justify-center space-x-2">
            <template x-for="(card, idx) in cards" :key="card.id">
                <div @click="active = idx" class="rounded cursor-pointer transition-all duration-300"
                    :class="idx === active ? 'w-20 h-1' : 'w-8 h-1'" :style="`background-color: ${card.bg_color}`">
                </div>
            </template>
        </div>
    </div>
</div>


{{-- <div class="Products py-8 sm:py-12">
    <h2 class="text-3xl md:text-4xl lg:text-[45px] font-medium text-center">
        Win All Prizes
    </h2>

    <div x-data="productCarousel()" x-init="init()" x-ref="viewport"
        class="relative w-full overflow-hidden pt-8 sm:pt-16" @mousedown.prevent="dragStart"
        @mousemove.prevent="dragMove" @mouseup.prevent="dragEnd" @mouseleave.prevent="dragEnd"
        @touchstart="dragStart($event)" @touchmove="dragMove($event)" @touchend="dragEnd">

        <div class="flex transition-transform duration-300 ease-in-out"
            :style="`transform: translateX(${translate}px)`">
            <template x-for="(product, idx) in productCards" :key="idx">
                <div class="flex-shrink-0" :style="`width: ${itemWidth}px; margin-right: ${gap}px;`">
                    <div :class="idx === active ? 'scale-100 z-10' : 'scale-90 z-0'"
                        class="bg-white rounded-lg shadow-lg transform transition-transform duration-300 overflow-hidden">
                        <div :class="product.bg" class="p-6 text-center text-white">
                            <p class="text-xs sm:text-sm uppercase font-bold tracking-wide">
                                PKR 50 Every Sunday
                            </p>
                            <p class="mt-2 text-lg sm:text-xl font-bold">
                                Grand Prize RS. 1,000,000
                            </p>
                            <p class="mt-2 text-xs sm:text-sm uppercase tracking-wide">
                                Guaranteed Results
                            </p>

                            <div class="mt-4 flex justify-center">
                                <img :src="product.image" alt="Prize image"
                                    class="h-48 w-48 object-cover rounded-lg shadow-sm" />
                            </div>

                            <div class="mt-4 flex justify-center space-x-2">
                                <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                    <div class="bg-white px-3 py-2">
                                        <span class="text-xl sm:text-2xl font-bold text-black"
                                            x-text="getDays(product.seconds)"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Days</span>
                                </div>
                                <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                    <div class="bg-white px-3 py-2">
                                        <span class="text-xl sm:text-2xl font-bold text-black"
                                            x-text="getHours(product.seconds)"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Hours</span>
                                </div>
                                <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                    <div class="bg-white px-3 py-2">
                                        <span class="text-xl sm:text-2xl font-bold text-black"
                                            x-text="getMinutes(product.seconds)"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Mins</span>
                                </div>
                                <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                    <div class="bg-white px-3 py-2">
                                        <span class="text-xl sm:text-2xl font-bold text-black"
                                            x-text="getSeconds(product.seconds)"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Sec</span>
                                </div>
                            </div>

                            <button
                                class="mt-6 bg-white text-red-600 font-bold uppercase text-sm sm:text-base py-2 rounded-full w-full hover:bg-gray-100">
                                BUY NOW
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-7 flex justify-center space-x-2">
            <template x-for="(product, idx) in productCards" :key="idx">
                <div @click="active = idx"
                    :class="[
                        idx === active ? 'w-20 h-1' : 'w-8 h-1',
                        product.bg
                    ]"
                    class="rounded cursor-pointer transition-all duration-300"></div>
            </template>
        </div>
    </div>

    <script>
        function productCarousel() {
            return {
                active: 1,
                productCards: [{
                        bg: 'bg-[#E91F1C]',
                        seconds: 2 * 3600 + 12 * 60 + 55,
                        image: "{{ asset('assets/products/phone.png') }}"
                    },
                    {
                        bg: 'bg-indigo-600',
                        seconds: 2 * 3600 + 12 * 60 + 55,
                        image: "{{ asset('assets/products/led.png') }}"
                    },
                    {
                        bg: 'bg-gray-800',
                        seconds: 2 * 3600 + 12 * 60 + 55,
                        image: "{{ asset('assets/products/phone.png') }}"
                    },
                ],

                itemWidth: 360,
                gap: 12,
                viewportWidth: 0,

                isDragging: false,
                startX: 0,
                startY: 0,
                currentTranslate: 0,

                init() {
                    this._updateSizes()
                    window.addEventListener('resize', () => {
                        this._updateSizes()
                    })
                },

                _updateSizes() {
                    this.viewportWidth = this.$refs.viewport.clientWidth
                    if (this.viewportWidth < 640) {
                        this.itemWidth = 300
                    } else {
                        this.itemWidth = 360
                    }
                },

                initTimers() {
                    this.productCards.forEach(product => {
                        product.interval = setInterval(() => {
                            if (product.seconds > 0) product.seconds--;
                            else clearInterval(product.interval);
                        }, 1000);
                    });
                },

                getDays(sec) {
                    return Math.floor(sec / 86400);
                },
                getHours(sec) {
                    return Math.floor((sec % 86400) / 3600);
                },
                getMinutes(sec) {
                    return Math.floor((sec % 3600) / 60);
                },
                getSeconds(sec) {
                    return sec % 60;
                },

                get translate() {
                    const centerOffset = (this.viewportWidth - this.itemWidth) / 2;
                    const slideOffset = this.active * (this.itemWidth + this.gap);
                    const baseX = centerOffset - slideOffset;
                    return this.isDragging ? baseX + this.currentTranslate : baseX;
                },

                prev() {
                    this.active = this.active > 0 ? this.active - 1 : this.productCards.length - 1;
                },
                next() {
                    this.active = this.active < this.productCards.length - 1 ? this.active + 1 : 0;
                },

                dragStart(e) {
                    this.isDragging = true;
                    if (e.type.startsWith('mouse')) {
                        this.startX = e.clientX;
                        this.startY = e.clientY;
                    } else {
                        this.startX = e.touches[0].clientX;
                        this.startY = e.touches[0].clientY;
                    }
                    this.currentTranslate = 0;
                },

                dragMove(e) {
                    if (!this.isDragging) return;
                    let clientX, clientY;
                    if (e.type.startsWith('mouse')) {
                        clientX = e.clientX;
                        clientY = e.clientY;
                    } else {
                        clientX = e.touches[0].clientX;
                        clientY = e.touches[0].clientY;
                    }

                    const deltaX = clientX - this.startX;
                    const deltaY = clientY - this.startY;

                    if (Math.abs(deltaX) > Math.abs(deltaY)) {
                        e.preventDefault();
                    }

                    this.currentTranslate = deltaX;
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
</div> --}}
