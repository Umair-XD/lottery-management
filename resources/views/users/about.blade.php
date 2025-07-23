<x-app-layout>
    <section class="giving">
        <div class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-20 xl:px-24 py-6 sm:py-8 md:py-10 border-b-2 uppercase">
            <!-- Breadcrumb Navigation -->
            <nav
                class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm md:text-base font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-1 sm:px-2">Home</a>
                <span>/</span>
                <span class="text-[#1083E5]">About Us</span>
            </nav>
            <!-- Main Heading -->
            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center mt-3">
                About Us
            </h1>
        </div>

        <div id="content"
            class=" content relative after:content-[''] after:block after:clear-both px-4 sm:px-6 md:px-10 lg:px-[80px] xl:px-[100px] py-8 sm:py-10 md:py-12 text-[#3A3A3A] text-base sm:text-lg md:text-xl leading-relaxed">

            <div
                class="float-left w-full sm:w-[500px] md:w-[550px] lg:w-[600px] aspect-[7/6] bg-[#21366F] rounded-[20px] mr-6 mb-4 overflow-hidden">
                <!-- <img src="/image.jpg" alt="" class="w-full h-full object-cover" /> -->
            </div>

            <p>
                <strong>Kingdoms Draw</strong> is Pakistan’s leading online lucky draw platform, created to inspire,
                reward, and uplift
                everyday dreamers. With exciting weekly and monthly draws, we offer life-changing cash prizes and
                ensure that every ticket counts. Even if you don’t win a prize right away, you earn valuable points
                toward future entries, making every purchase a step closer to your dream.
            </p>
            <p class="mt-4">
                Our platform operates fully online through a secure website and mobile app, making participation easy
                and accessible from anywhere in Pakistan. Every draw is conducted transparently using a certified Random
                Number Generator (RNG), so you can play with confidence. From Basic to Diamond tiers, Kingdoms Draw gives
                everyone a fair shot whether you're playing for fun, hope, or a brighter tomorrow.
            </p>
            <p class="mt-4">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold uppercase pb-2">
                Our Vision
            </h2>
            To become Pakistan’s most trusted platform of hope, helping people dream bigger and live better.
            </p>
            <p class="mt-4">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold uppercase pb-2">
                Our Mission
            </h2>
            To reward ambition with real, life-changing prizes delivered through a fair, transparent, and points-based
            draw system that encourages long-term engagement.
            </p>
        </div>
    </section>
</x-app-layout>
