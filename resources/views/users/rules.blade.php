<x-app-layout>
    <section class="rules">
        <!-- Breadcrumb + Heading -->
        <div class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-20 xl:px-24 py-6 sm:py-8 md:py-10 border-b-2">
            <nav
                class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm md:text-base font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-1 sm:px-2 uppercase">Home</a>
                <span>/</span>
                <span class="text-[#1083E5] uppercase">Rules</span>
            </nav>
            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center uppercase mt-3">
                Rules
            </h1>
        </div>

        <!-- Content -->
        <div class="content px-4 sm:px-8 md:px-16 lg:px-24 xl:px-28 py-8 sm:py-12 md:py-16 mb-10">
            <!-- Intro paragraph -->
            <p class="text-md md:text-lg mb-8 text-[#3A3A3A]">
                These rules for Kingdoms Draw (“Rules”) set out the various rules and procedures that apply when You
                enter the Kingdoms Draw Game.
            </p>

            <!-- Who Can Join? -->
            <h3 class="text-xl md:text-2xl font-medium mb-4">Who Can Join?</h3>
            <ul class="space-y-4 pl-6">
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        You must be 18 years or older.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Only one account per person is allowed.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Employees or anyone connected to the Kingdoms Draw team cannot join.
                    </p>
                </li>
            </ul>

            <!-- How to Participate -->
            <h3 class="text-xl md:text-2xl font-medium mt-8 mb-4">How to Participate</h3>
            <ul class="space-y-4 pl-6">
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Choose a product (ticket) from the available options.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Make your payment using JazzCash, EasyPaisa, or a debit/credit card.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Each product you buy gives you one entry into the draw.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Every draw is for a limited time, and each product has only one winner.
                    </p>
                </li>
            </ul>

            <!-- Draw Process -->
            <h3 class="text-xl md:text-2xl font-medium mt-8 mb-4">Draw Process</h3>
            <ul class="space-y-4 pl-6">
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        All draws are done using a fair and random system.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Only one winner is selected per product draw.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        If you win, you’ll be notified via SMS, email, or app notification.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Winner names may be shown publicly unless you request to stay private.
                    </p>
                </li>
            </ul>

            <!-- What If You Don’t Win? -->
            <h3 class="text-xl md:text-2xl font-medium mt-8 mb-4">What If You Don’t Win?</h3>
            <ul class="space-y-4 pl-6">
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        If you don’t win, you still get your ticket amount back as points.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        You can use these points to join future draws.
                    </p>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-6 w-6 mt-1 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm md:text-base leading-relaxed text-[#3A3A3A]">
                        Points can’t be withdrawn or shared—they stay in your account.
                    </p>
                </li>
            </ul>
        </div>
    </section>
</x-app-layout>
