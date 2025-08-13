<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Kingdoms Draw') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.css" />
</head>

<body class="font-sans antialiased">
    <div x-data class="min-h-screen flex flex-col w-full bg-white">
        @include('layouts.navigation')

        <div class="flex-1 min-w-0 transition-all duration-300 ease-in-out"
            :class="{ 'ml-64': $store.sidebar.pinned, 'ml-20': !$store.sidebar.pinned }">
            <!-- Page heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page content -->
            <main class="min-h-screen">
                {{ $slot }}
                @yield('scripts')
            </main>

            <!-- Footer -->
            <footer class="bg-white py-4 text-center">
                <p>&copy; {{ date('Y') }} Admin Panel </p>
            </footer>
        </div>
    </div>

</body>
</html>
