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
            image: 'image_url',
            title: 'name',
            prize_amount: 'prize_amount',
            price: 'price',
            duration_phrase: 'duration_phrase'
        },
        gap: 10
    })" x-init="init()" x-ref="viewport"
        class="relative w-full overflow-hidden pt-8 sm:pt-16" @mousedown.prevent="dragStart" @mousemove.prevent="dragMove"
        @mouseup.prevent="dragEnd" @mouseleave.prevent="dragEnd" @touchstart="dragStart($event)"
        @touchmove="dragMove($event)" @touchend="dragEnd">
        <!-- Slides -->
        <div class="flex transition-transform duration-300 ease-in-out"
            :style="`transform: translateX(${translate}px)`">
            <template x-for="(card, idx) in cards" :key="card.id">
                <div class="flex-shrink-0" :style="`width: ${itemWidth}px; margin-right: ${gap}px;`">
                    <div :class="idx === active ? 'scale-100 z-10' : 'scale-90 z-0'"
                        class="bg-white rounded-lg shadow-lg transform transition-transform duration-300 overflow-hidden">
                        <div :style="`background-color: ${card.bg_color}`" class="p-6 text-center text-white">

                            <!-- Price + Schedule -->
                            <p class="text-xs sm:text-sm uppercase font-bold tracking-wide"
                                x-text="`PKR ${card.price} ${card.duration_phrase}`">
                            </p>

                            <!-- Grand Prize -->
                            <p class="mt-2 text-lg sm:text-xl font-bold"
                                x-text="`Grand Prize RS. ${card.prize_amount}`">
                            </p>

                            <!-- Title / Subtitle if needed -->
                            <p class="mt-2 text-xs sm:text-sm uppercase tracking-wide" x-text="card.title">
                            </p>

                            <!-- Image -->
                            <div class="mt-4 flex justify-center">
                                <img :src="card.image" alt="Prize image"
                                    class="h-48 w-48 object-cover rounded-lg shadow-sm">
                            </div>

                            <!-- Countdown -->
                            <div class="mt-4 flex justify-center space-x-2">
                                <template x-for="unit in ['Days','Hours','Mins','Sec']" :key="unit">
                                    <div class="flex flex-col items-center border-2 border-white rounded-lg">
                                        <div class="bg-white px-3 py-2">
                                            <span class="text-xl sm:text-2xl font-bold text-black"
                                                x-text="{
                          Days:  card.days,
                          Hours: card.hours,
                          Mins:  card.minutes,
                          Sec:   card.seconds % 60
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
