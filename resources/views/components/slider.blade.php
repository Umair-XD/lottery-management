<div class="Slider overflow-hidden relative">
    @vite(['resources/css/swiper.css'])
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
