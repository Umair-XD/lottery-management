<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kingdoms Draw') }}</title>

    <!-- Bootstrap -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Alpine JS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.css">


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        {{-- @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        {{-- 1) STICKY NAVBAR --}}
        <nav class="sticky top-0 z-50 bg-white shadow flex items-center justify-between px-4 lg:px-14 py-2">
            <!-- Hamburger (mobile only) -->
            <button id="menu-btn"
                class="md:hidden flex items-center justify-center w-10 h-10 text-gray-600 hover:text-black focus:outline-none"
                aria-label="Toggle menu">
                <svg id="icon-open" class="h-6 w-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="icon-close" class="h-6 w-6 hidden" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="logo flex items-center">
                <a href="{{ route('users.index') }}">
                    <x-application-logo class="w-20 md:w-24 fill-current text-gray-500" />
                </a>
            </div>

            <!-- Mobile “Sign In” -->
            <a href="{{ route('login') }}" class="md:hidden text-center bg-[#FDC741] py-2 px-4 rounded font-semibold">
                Sign In
            </a>

            <!-- Desktop Links & Buttons -->
            <div class="hidden md:flex md:items-center space-x-5 lg:space-x-28">
                <div class="nav-links flex items-center text-base font-medium text-[#808080]">
                    <a href="{{ route('users.index') }}" @class([
                        'px-3 py-1 hover:text-black',
                        'text-black border-b-2 border-black' => request()->routeIs('users.index'),
                    ])>
                        Games
                    </a>
                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.giving') }}" @class([
                        'px-3 py-1  hover:text-black',
                        'text-black border-b-2 border-black' => request()->routeIs('users.giving'),
                    ])>
                        Giving Back
                    </a>
                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.faq') }}" @class([
                        'px-3 py-1 hover:text-black',
                        'text-black border-b-2 border-black' => request()->routeIs('users.faq'),
                    ])>
                        FAQ’s
                    </a>
                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.rules') }}" @class([
                        'px-3 py-1 hover:text-black',
                        'text-black border-b-2 border-black' => request()->routeIs('users.rules'),
                    ])>
                        Rules
                    </a>
                </div>

                <div class="login-btns flex space-x-3">
                    <a href="{{ route('login') }}" class="bg-[#FDC741] font-semibold px-6 py-1 rounded">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                        class="border border-[#FDC741] text-[#FDC741] font-semibold px-6 py-1 rounded">
                        Register
                    </a>
                </div>
            </div>
        </nav>

        {{-- 2) MOBILE MENU --}}
        <div id="mobile-menu"
            class="absolute inset-x-0 top-16 bg-white p-6 transform -translate-y-full transition-transform duration-300 ease-in-out md:hidden z-40 shadow-lg">
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('users.index') }}" class="py-2 font-medium">Games</a>
                <a href="{{ route('users.giving') }}" class="py-2 font-medium">Giving Back</a>
                <a href="{{ route('users.faq') }}" class="py-2 font-medium">FAQ’s</a>
                <a href="{{ route('users.rules') }}" class="py-2 font-medium">Rules</a>
            </nav>
            <div class="mt-8">
                <a href="{{ route('register') }}"
                    class="block w-full text-center border border-[#FDC741] py-2 rounded font-semibold text-[#FDC741]">
                    Register
                </a>
            </div>
        </div>

        {{-- 4) TOGGLE SCRIPT --}}
        <script>
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('icon-open');
            const closeIcon = document.getElementById('icon-close');

            btn.addEventListener('click', e => {
                e.stopPropagation();
                if (menu.classList.contains('-translate-y-full')) {
                    menu.classList.replace('-translate-y-full', 'translate-y-0');
                    openIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    menu.classList.replace('translate-y-0', '-translate-y-full');
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            document.addEventListener('click', e => {
                if (
                    menu.classList.contains('translate-y-0') &&
                    !menu.contains(e.target) &&
                    !btn.contains(e.target)
                ) {
                    menu.classList.replace('translate-y-0', '-translate-y-full');
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });
        </script>


        <!-- Page Content -->
        <main>
            {{ $slot }}
            @yield('scripts')
        </main>

        <footer class="footer bg-[#0C0E34] text-white">
            <div class="mx-auto text-center">
                <!-- Social Media Icons -->
                <div class="top py-8 sm:py-16 px-3">
                    <div class="Logos flex justify-center space-x-6 mb-6">
                        <a href="http://www.youtube.com/@KingdomDraw" target="_blank" class="hover:opacity-75">
                            <svg width="46" height="46" class="w-5 sm:w-6 md:w-7 lg:w-8" viewBox="0 0 46 46"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 39.1641C26.3937 39.1641 29.6469 38.8285 32.6619 38.2135C36.4306 37.4448 38.3131 37.0623 40.0306 34.8535C41.75 32.6429 41.75 30.106 41.75 25.0323V21.421C41.75 16.3473 41.75 13.8085 40.0306 11.5998C38.3131 9.391 36.4306 9.00663 32.6619 8.23976C29.4809 7.60218 26.2442 7.28372 23 7.28913C19.6063 7.28913 16.3531 7.62476 13.3381 8.23976C9.56938 9.00851 7.68688 9.391 5.96938 11.5998C4.25 13.8104 4.25 16.3473 4.25 21.421V25.0323C4.25 30.106 4.25 32.6448 5.96938 34.8535C7.68688 37.0623 9.56938 37.4466 13.3381 38.2135C16.3531 38.8285 19.6063 39.1641 23 39.1641Z"
                                    stroke="white" stroke-width="2.8125" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M30.4288 23.8131C30.1513 24.9493 28.67 25.7631 25.7094 27.3962C22.4881 29.1718 20.8775 30.0587 19.5744 29.7156C19.1401 29.6034 18.7344 29.4009 18.3838 29.1212C17.375 28.3056 17.375 26.6124 17.375 23.2262C17.375 19.8399 17.375 18.1468 18.3838 17.3312C18.725 17.0556 19.1338 16.8512 19.5744 16.7368C20.8775 16.3937 22.4881 17.2806 25.7094 19.0562C28.6719 20.6874 30.1513 21.5031 30.4288 22.6393C30.5225 23.0256 30.5225 23.4268 30.4288 23.8131Z"
                                    stroke="white" stroke-width="2.8125" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                        </a>
                        <a href="http://facebook.com/kingdomsdraw" target="_blank" class="hover:opacity-75">
                            <svg width="46" height="46" class="w-5 sm:w-6 md:w-7 lg:w-8" viewBox="0 0 46 46"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M32.375 4.47656H26.75C24.2636 4.47656 21.879 5.46428 20.1209 7.22244C18.3627 8.98059 17.375 11.3652 17.375 13.8516V19.4766H11.75V26.9766H17.375V41.9766H24.875V26.9766H30.5L32.375 19.4766H24.875V13.8516C24.875 13.3543 25.0725 12.8774 25.4242 12.5257C25.7758 12.1741 26.2527 11.9766 26.75 11.9766H32.375V4.47656Z"
                                    stroke="white" stroke-width="2.875" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/kingdomsdraw" target="_blank" class="hover:opacity-75">
                            <svg width="46" height="46" class="w-5 sm:w-6 md:w-7 lg:w-8" viewBox="0 0 46 46"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 30.7266C24.9891 30.7266 26.8968 29.9364 28.3033 28.5299C29.7098 27.1233 30.5 25.2157 30.5 23.2266C30.5 21.2374 29.7098 19.3298 28.3033 17.9233C26.8968 16.5167 24.9891 15.7266 23 15.7266C21.0109 15.7266 19.1032 16.5167 17.6967 17.9233C16.2902 19.3298 15.5 21.2374 15.5 23.2266C15.5 25.2157 16.2902 27.1233 17.6967 28.5299C19.1032 29.9364 21.0109 30.7266 23 30.7266Z"
                                    stroke="white" stroke-width="2.875" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M6.125 30.7266V15.7266C6.125 13.2402 7.11272 10.8556 8.87087 9.09744C10.629 7.33928 13.0136 6.35156 15.5 6.35156H30.5C32.9864 6.35156 35.371 7.33928 37.1291 9.09744C38.8873 10.8556 39.875 13.2402 39.875 15.7266V30.7266C39.875 33.213 38.8873 35.5975 37.1291 37.3557C35.371 39.1138 32.9864 40.1016 30.5 40.1016H15.5C13.0136 40.1016 10.629 39.1138 8.87087 37.3557C7.11272 35.5975 6.125 33.213 6.125 30.7266Z"
                                    stroke="white" stroke-width="2.875" />
                                <path d="M33.3125 12.9327L33.3313 12.9121" stroke="white" stroke-width="2.875"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@kingdomsdrawofficial" target="_blank"
                            class="hover:opacity-75">
                            <svg width="46" height="46" class="w-5 sm:w-6 md:w-7 lg:w-8" viewBox="0 0 46 46"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.875 13.7344C37.5449 13.7316 35.3109 12.8047 33.6633 11.157C32.0156 9.50937 31.0887 7.27546 31.0859 4.94531C31.0859 4.66559 30.9748 4.39733 30.777 4.19954C30.5792 4.00174 30.311 3.89062 30.0312 3.89062H23C22.7203 3.89062 22.452 4.00174 22.2542 4.19954C22.0564 4.39733 21.9453 4.66559 21.9453 4.94531V28.1484C21.9449 28.8404 21.7588 29.5196 21.4065 30.1151C21.0542 30.7106 20.5485 31.2007 19.9423 31.5343C19.336 31.8678 18.6514 32.0326 17.9598 32.0114C17.2681 31.9903 16.5948 31.7839 16.0101 31.4139C15.4254 31.0439 14.9507 30.5237 14.6355 29.9077C14.3203 29.2918 14.1761 28.6025 14.218 27.9118C14.26 27.2211 14.4864 26.5543 14.8738 25.981C15.2612 25.4076 15.7953 24.9487 16.4205 24.6521C16.6009 24.5667 16.7532 24.4318 16.86 24.2631C16.9667 24.0945 17.0234 23.899 17.0234 23.6994V16.1953C17.0233 16.042 16.9897 15.8906 16.9251 15.7516C16.8604 15.6126 16.7663 15.4894 16.6491 15.3905C16.532 15.2916 16.3947 15.2194 16.2469 15.179C16.099 15.1386 15.9441 15.1309 15.793 15.1564C9.67578 16.2445 5.07031 21.8291 5.07031 28.1484C5.07031 31.5983 6.44077 34.9069 8.88021 37.3463C11.3197 39.7858 14.6282 41.1562 18.0781 41.1562C21.528 41.1562 24.8366 39.7858 27.276 37.3463C29.7155 34.9069 31.0859 31.5983 31.0859 28.1484V20.5775C33.7677 22.0904 36.796 22.8819 39.875 22.875C40.1547 22.875 40.423 22.7639 40.6208 22.5661C40.8186 22.3683 40.9297 22.1 40.9297 21.8203V14.7891C40.9297 14.5093 40.8186 14.2411 40.6208 14.0433C40.423 13.8455 40.1547 13.7344 39.875 13.7344ZM38.8203 20.7305C35.8737 20.5423 33.0402 19.5253 30.6465 17.7967C30.4887 17.6834 30.3027 17.6158 30.1089 17.6015C29.9152 17.5872 29.7213 17.6267 29.5486 17.7156C29.3758 17.8045 29.231 17.9394 29.1301 18.1054C29.0292 18.2713 28.976 18.462 28.9766 18.6562V28.1484C28.9766 31.0389 27.8283 33.8109 25.7845 35.8548C23.7406 37.8987 20.9686 39.0469 18.0781 39.0469C15.1877 39.0469 12.4156 37.8987 10.3718 35.8548C8.32791 33.8109 7.17969 31.0389 7.17969 28.1484C7.17969 23.2758 10.4264 18.9234 14.9141 17.5348V23.0771C14.0314 23.6279 13.3079 24.3996 12.815 25.3158C12.322 26.232 12.0768 27.2609 12.1035 28.301C12.1303 29.341 12.428 30.356 12.9673 31.2457C13.5067 32.1354 14.2689 32.8688 15.1786 33.3736C16.0884 33.8783 17.1141 34.1368 18.1544 34.1235C19.1947 34.1103 20.2135 33.8256 21.1101 33.2979C22.0066 32.7701 22.7499 32.0174 23.2663 31.1143C23.7828 30.2111 24.0545 29.1888 24.0547 28.1484V6H29.0275C29.2749 8.5132 30.3861 10.8629 32.1718 12.6485C33.9575 14.4342 36.3071 15.5454 38.8203 15.7928V20.7305Z"
                                    fill="white" />
                            </svg>

                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="Links flex flex-wrap justify-center items-center space-x-4 mb-4">
                        <a href="#"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            Contact Us
                        </a>
                        <a href="#"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            Privacy Policy
                        </a>
                        <a href="#"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            About Us
                        </a>
                        <a href="#"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            Terms & Conditions
                        </a>
                        <a href="{{ route('users.faq') }}"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            FAQ's
                        </a>
                        <a href="{{ route('users.rules') }}"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            Rules
                        </a>
                        <a href="{{ route('users.giving') }}"
                            class="font-medium text-sm sm:text-base md:text-lg lg:text-xl border-l-2 pl-4 hover:text-gray-300">
                            Giving Back
                        </a>
                    </div>
                </div>

                <hr class="border-gray-700" />

                <!-- Copyright -->
                <p class="text-gray-300 text-xs sm:text-sm md:text-base lg:text-lg py-3">
                    Copyright &copy; 2025 Freelancer Technology Pty Limited (ACN 142 189 765)
                </p>
            </div>
        </footer>

    </div>
</body>

</html>
