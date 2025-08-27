<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen relative overflow-hidden">
        <!-- Logo -->
        <a href="{{ route('users.index') }}" class="absolute top-4 left-5 z-20">
            <x-application-logo class="w-16 h-16 md:w-24 md:h-24 fill-current text-gray-500" />
        </a>

        <!-- Top Right SVG -->
        <svg aria-hidden="true" class="absolute top-0 right-0 w-4/5 sm:w-2/3 lg:w-1/2 h-auto z-0" viewBox="0 0 872 728"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet" shape-rendering="crispEdges">
            <g filter="url(#filter0_d_403_973)">
                <path
                    d="M265 134C129.4 146.8 37.1667 46 8 -6L872 -2.5V715.5H775.5C476.7 677.5 527 526 589.5 455C626 405.167 692 285.1 664 203.5C629 101.5 434.5 118 265 134Z"
                    fill="#0D2657" fill-opacity="0.01" />
            </g>
            <defs>
                <filter id="filter0_d_403_973" x="0" y="-10" width="880" height="737.5" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        result="hardAlpha" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="0" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.04 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_403_973" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_403_973" result="shape" />
                </filter>
            </defs>
        </svg>

        <!-- Bottom Left SVG -->
        <svg aria-hidden="true" class="absolute bottom-0 left-0 w-3/4 sm:w-1/2 lg:w-4/12 h-auto z-0"
            viewBox="0 0 580 491" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMaxYMax meet"
            shape-rendering="crispEdges">
            <g filter="url(#filter0_d_403_975)">
                <path
                    d="M403.405 389.458C493.523 380.951 554.82 447.941 574.204 482.5L0 480.174V3H64.1327C262.711 28.2543 229.283 128.939 187.746 176.125C163.489 209.244 119.626 289.039 138.234 343.269C161.495 411.057 290.757 400.091 403.405 389.458Z"
                    fill="#0D2657" fill-opacity="0.02" />
            </g>
            <defs>
                <filter id="filter0_d_403_975" x="-5.3167" y="0.341649" width="584.837" height="490.133"
                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        result="hardAlpha" />
                    <feOffset dy="2.65835" />
                    <feGaussianBlur stdDeviation="0" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.04 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_403_975" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_403_975" result="shape" />
                </filter>
            </defs>
        </svg>

        <!-- Page Content -->
        <div class="relative z-10 w-full h-screen flex items-center justify-center">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
