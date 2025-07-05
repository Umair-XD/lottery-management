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
        <div class="nav relative flex justify-between items-center px-4 lg:px-14 py-3 bg-white">
            <!-- Hamburger (mobile only) -->
            <button id="menu-btn" class="md:hidden w-20 p-2 text-gray-600 hover:text-black focus:outline-none"
                aria-label="Toggle menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="logo flex items-center justify-center">
                <a href="{{ route('users.index') }}">
                    <x-application-logo class="w-20 md:w-24 fill-current text-gray-500" />
                </a>
            </div>
            <a href="{{ route('login') }}"
                class="md:hidden w-20 text-center bg-[#FDC741] py-2 rounded font-semibold">Sign In</a>

            <!-- Desktop links/buttons -->
            <div class="hidden md:flex md:items-center space-x-5 lg:space-x-28">
                <div class="nav-links flex items-center text-base font-medium text-[#808080]">
                    <a href="{{ route('users.index') }}" @class([
                        'px-3 py-1',
                        'text-black border-b-2 border-black' => request()->routeIs('users.index'),
                    ])>
                        Games
                    </a>

                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.giving') }}" @class([
                        'px-3 py-1',
                        'text-black border-b-2 border-black' => request()->routeIs('users.giving'),
                    ])>
                        Giving Back
                    </a>

                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.faq') }}" @class([
                        'px-3 py-1',
                        'text-black border-b-2 border-black' => request()->routeIs('users.faq'),
                    ])>
                        FAQ’s
                    </a>

                    <span class="h-6 border-l-2 border-black mx-2"></span>
                    <a href="{{ route('users.rules') }}" @class([
                        'px-3 py-1',
                        'text-black border-b-2 border-black' => request()->routeIs('users.rules'),
                    ])>
                        Game Rules
                    </a>
                </div>

                <div class="login-btns flex space-x-3">
                    <a href="{{ route('login') }}"
                        class="bg-[#FDC741] lg:text-[19px] font-semibold px-6 py-1 rounded">Sign In</a>
                    <a href="{{ route('register') }}"
                        class="border border-[#FDC741] text-[#FDC741] lg:text-[19px] font-semibold px-6 py-1 rounded">Register</a>
                </div>
            </div>

            <!-- Side-drawer Mobile Menu -->
            <div id="mobile-menu"
                class="fixed inset-y-0 left-0 w-64 sm:w-3/4 bg-white p-6
              transform -translate-x-full transition-transform duration-300 ease-in-out
              md:hidden z-50 shadow-lg">
                <!-- Close button -->
                <div class="flex justify-end mb-8">
                    <button id="menu-close" class="p-2 text-gray-600 hover:text-black" aria-label="Close menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Links -->
                <nav class="flex flex-col space-y-4">
                    <a href="" class="block py-2 font-medium">Games</a>
                    <a href="{{ route('users.giving') }}" class="block py-2 font-medium">Giving Back</a>
                    <a href="{{ route('users.faq') }}" class="block py-2 font-medium">FAQ’s</a>
                    <a href="{{ route('users.rules') }}" class="block py-2 font-medium">Game Rules</a>
                </nav>
                <!-- Auth Buttons -->
                <div class="mt-auto pt-8 space-y-4">
                    {{-- <a href="{{ route('login') }}"
                        class="block w-full text-center bg-[#FDC741] py-2 rounded font-semibold">Sign In</a> --}}
                    <a href="{{ route('register') }}"
                        class="block w-full text-center border border-[#FDC741] py-2 rounded font-semibold text-[#FDC741]">Register</a>
                </div>
            </div>
            <script>
                const openBtn = document.getElementById('menu-btn');
                const closeBtn = document.getElementById('menu-close');
                const menu = document.getElementById('mobile-menu');

                openBtn.addEventListener('click', () => {
                    menu.classList.toggle('-translate-x-full');
                    menu.classList.toggle('translate-x-0');
                });

                closeBtn.addEventListener('click', () => {
                    menu.classList.add('-translate-x-full');
                    menu.classList.remove('translate-x-0');
                });
            </script>
        </div>
x
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
            @yield('scripts')
        </main>

        <footer class="footer bg-[#0C0E34] text-white">
            <div class="mx-auto text-center">
                <!-- Social Media Icons -->
                <div class="top py-16">
                    <div class="flex justify-center space-x-6 mb-6">
                        <a href="https://www.youtube.com" target="_blank" class="hover:opacity-75">
                            <img src="path/to/youtube-icon.png" alt="YouTube" class="w-6 h-6" />
                        </a>
                        <a href="https://www.facebook.com" target="_blank" class="hover:opacity-75">
                            <img src="path/to/facebook-icon.png" alt="Facebook" class="w-6 h-6" />
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="hover:opacity-75">
                            <img src="path/to/instagram-icon.png" alt="Instagram" class="w-6 h-6" />
                        </a>
                        <a href="https://www.tiktok.com" target="_blank" class="hover:opacity-75">
                            <img src="path/to/tiktok-icon.png" alt="TikTok" class="w-6 h-6" />
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="flex justify-center space-x-4 mb-4">
                        <a href="#" class="hover:text-gray-300 font-medium text-xl border-l-2 pl-4">About</a>
                        <a href="#" class="hover:text-gray-300 font-medium text-xl border-l-2 pl-4">Contact</a>
                        <a href="#" class="hover:text-gray-300 font-medium text-xl border-l-2 pl-4">Privacy
                            Policy</a>
                        <a href="#" class="hover:text-gray-300 font-medium text-xl border-l-2 pl-4">Terms of
                            Service</a>
                    </div>
                </div>
                <hr>
                <!-- Copyright -->
                <p class="text-gray-300 text-sm py-3"> Copyright &copy; 2025 Freelancer Technology Pty Limited (ACN 142
                    189
                    765)
                </p>
            </div>
        </footer>
    </div>
</body>

</html>
