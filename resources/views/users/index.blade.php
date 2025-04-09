<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2bacd5]  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">

                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Example of dynamically generated Swiper Cards for uploaded banners -->
                            <div class="swiper-slide">
                                <img src="path/to/banner1.jpg" alt="Banner 1" class="swiper-banner-card">
                            </div>
                            <div class="swiper-slide">
                                <img src="path/to/banner2.jpg" alt="Banner 2" class="swiper-banner-card">
                            </div>
                            <!-- Add more swiper-slide items dynamically here -->
                        </div>

                        <!-- Add Pagination if you want -->
                        <div class="swiper-pagination"></div>

                        <!-- Add Navigation if you want -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <!-- Swiper Initialization -->
                    <script>
                        const swiper = new Swiper('.swiper-container', {
                            loop: true, // Enable looping
                            pagination: {
                                el: '.swiper-pagination', // Pagination
                                clickable: true,
                            },
                            navigation: {
                                nextEl: '.swiper-button-next', // Next button
                                prevEl: '.swiper-button-prev', // Prev button
                            },
                            autoplay: {
                                delay: 3000, // Auto slide every 3 seconds
                            },
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
