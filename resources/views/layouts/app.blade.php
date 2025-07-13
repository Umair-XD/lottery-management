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
        <div class="nav flex justify-between items-center px-14 py-3">
            <div class="logo flex items-center justify-center ">
                <a href="{{ route('users.index') }}"><x-application-logo class="w-24  fill-current text-gray-500" /></a>
            </div>

            <div class="flex justify-between items-center space-x-28">
                <div class="nav-links [&>*]:font-medium [&>*]:border-l-2 [&>*]:px-5 text-base">
                    <a href="" class="active:border-b-2 active:border-black active:pb-3">Games</a>
                    <a href="{{ route('users.giving') }}" :active="request() - > routeIs('users.giving')"
                        class="active:border-b-2 active:border-black active:pb-3">Giving Back</a>
                    <a href="{{ route('users.faq') }}" class="active:border-b-2 active:border-black active:pb-3">FAQ's</a>
                    <a href="" class="active:border-b-2 active:border-black active:pb-3">Rules</a>
                </div>
                <div class="login-btns flex justify-between items-center space-x-3">
                    <a href="{{ route('login') }}" class="bg-[#FDC741] text-[19px] font-semibold px-6 py-1 rounded-[4px] text">Sign In</a>
                    <a href="{{ route('register') }}"
                        class="border border-[#FDC741] text-[19px] text-[#FDC741] font-semibold px-6 py-1 rounded-[4px]">Register</a>
                </div>
            </div>
        </div>

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
