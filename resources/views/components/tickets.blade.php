<div class="Tickets py-8 sm:py-12">
    <h2 class="text-3xl md:text-4xl lg:text-[45px] font-medium text-center">
        Our Games
    </h2>

    <div x-data="carousel({
        endpoint: '/api/v1/tires',
        dateField: 'draw_date',
        fields: {
            id: 'id',
            bg_color: 'bg_color',
            prize_amount: 'prize_amount',
            multiplier: 'multiplier',
            price: 'price',
            name: 'name'
        },
        gap: 10
    })" x-init="init()" x-ref="viewport"
        class="relative w-full overflow-hidden pt-8 sm:pt-16" @mousedown.prevent="dragStart" @mousemove.prevent="dragMove"
        @mouseup.prevent="dragEnd" @mouseleave.prevent="dragEnd" @touchstart="dragStart($event)"
        @touchmove="dragMove($event)" @touchend="dragEnd">
        <div class="flex transition-transform duration-300 ease-in-out"
            :style="`transform: translateX(${translate}px)`">
            <template x-for="(card, idx) in cards" :key="card.id">
                <div class="flex-shrink-0" :style="`width: ${itemWidth}px; margin-right: ${gap}px;`">
                    <div :class="idx === active ? 'scale-100 z-10' : 'scale-90 z-0'"
                        class="bg-white rounded-lg shadow-lg transform transition-transform duration-300">
                        <div :style="`background-color: ${card.bg_color}`"
                            class="p-6 text-center text-white rounded-2xl">
                            <h3 class="text-xl font-bold">PRIZE UP TO</h3>
                            <h3 class="text-2xl font-bold" x-text="'PKR ' + card.prize_amount"></h3>
                            <p class="mt-8 text-xl font-bold">WIN</p>
                            <p class="mt-2 text-3xl font-bold" x-text="card.multiplier + 'X'"></p>
                            <p class="mt-2 text-2xl font-bold">YOUR ENTRY VALUE</p>

                            <div class="mt-4 flex justify-center items-end space-x-4">
                                <div class="flex flex-col items-center border-white border-2 rounded-lg">
                                    <div class="bg-white rounded px-4 py-2">
                                        <span x-text="card.days" class="text-3xl font-bold text-black"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Days</span>
                                </div>
                                <div class="flex flex-col items-center border-white border-2 rounded-lg">
                                    <div class="bg-white rounded px-4 py-2">
                                        <span x-text="card.hours" class="text-3xl font-bold text-black"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Hrs</span>
                                </div>
                                <div class="flex flex-col items-center border-white border-2 rounded-lg">
                                    <div class="bg-white rounded px-4 py-2">
                                        <span x-text="card.minutes" class="text-3xl font-bold text-black"></span>
                                    </div>
                                    <span class="mt-1 text-xs uppercase">Mins</span>
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

        <div class="mt-7 flex justify-center space-x-2">
            <template x-for="(card, idx) in cards" :key="idx">
                <div @click="active = idx" :style="`background-color: ${card.bg_color}`"
                    :class="[
                        idx === active ? 'w-20 h-1' : 'w-8 h-1'
                    ]"
                    class="rounded cursor-pointer transition-all duration-300"></div>
            </template>
        </div>
    </div>
</div>
