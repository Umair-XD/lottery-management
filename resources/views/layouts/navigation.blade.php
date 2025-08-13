<!-- Sidebar Navigation -->
<nav x-data="{ open: false }"
    class="fixed inset-y-0 left-0 z-50 bg-[#223871] border-r border-gray-100 shadow-lg transition-all duration-300 ease-in-out"
    :class="{ 'w-64': $store.sidebar.pinned, 'w-20': !$store.sidebar.pinned }">

    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-gray-600">
        <div class="flex items-center"
            :class="{ '': $store.sidebar.pinned, 'justify-center w-full': !$store.sidebar.pinned }">
            
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <div :class="{ 'h-10 w-auto': $store.sidebar.pinned, 'h-8 w-auto': !$store.sidebar.pinned }"
                        class="transition-all duration-200 flex items-center">
                        <x-application-logo class="h-full w-auto" />
                    </div>
                </a>
            </div>

            <!-- Title when expanded -->
            <div x-show="$store.sidebar.pinned" x-transition:enter="transition-opacity duration-300 delay-100"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="ml-3 text-white font-bold text-lg">
                Admin Panel
            </div>
        </div>

        <!-- Pin/Unpin Button -->
        <button x-show="$store.sidebar.pinned" @click="$store.sidebar.toggle()"
            class="p-1 rounded-md text-gray-300 hover:text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7">
                </path>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 px-2 py-4 space-y-2">
        <!-- Dashboard -->
        <div>
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-3 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white' : 'text-gray-200 hover:bg-gray-600 hover:text-white' }}"
                :class="{ 'justify-center': !$store.sidebar.pinned }">
                <svg class="flex-shrink-0 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                </svg>
                <span x-show="$store.sidebar.pinned" class="ml-3">{{ __('Dashboard') }}</span>
            </a>
        </div>

        <!-- Tires -->
        <div>
            <a href="{{ route('admin.tires.index') }}"
                class="flex items-center px-3 py-3 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.tires.*') ? 'bg-blue-800 text-white' : 'text-gray-200 hover:bg-gray-600 hover:text-white' }}"
                :class="{ 'justify-center': !$store.sidebar.pinned }">
                <svg class="flex-shrink-0 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <span x-show="$store.sidebar.pinned" class="ml-3">{{ __('Tires') }}</span>
            </a>
        </div>

        <!-- Tickets -->
        <div>
            <a href="{{ route('admin.tickets.index') }}"
                class="flex items-center px-3 py-3 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.tickets.*') ? 'bg-blue-800 text-white' : 'text-gray-200 hover:bg-gray-600 hover:text-white' }}"
                :class="{ 'justify-center': !$store.sidebar.pinned }">
                <svg class="flex-shrink-0 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 11-0-4V7a2 2 0 00-2-2H5z">
                    </path>
                </svg>
                <span x-show="$store.sidebar.pinned" class="ml-3">{{ __('Tickets') }}</span>
            </a>
        </div>

        <!-- Home -->
        <div>
            <a href="{{ route('users.index') }}"
                class="flex items-center px-3 py-3 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-800 text-white' : 'text-gray-200 hover:bg-gray-600 hover:text-white' }}"
                :class="{ 'justify-center': !$store.sidebar.pinned }">
                <svg class="flex-shrink-0 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span x-show="$store.sidebar.pinned" class="ml-3">{{ __('Home') }}</span>
            </a>
        </div>
    </div>

    <!-- User Settings Section -->
    <div class="border-t border-gray-600 p-4">
        <div class="flex items-center mb-3"
            :class="{ '': $store.sidebar.pinned, 'justify-center': !$store.sidebar.pinned }">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <span
                        class="text-white text-sm font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </div>

            <div x-show="$store.sidebar.pinned" x-transition:enter="transition-opacity duration-300 delay-100"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="ml-3">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div x-show="$store.sidebar.pinned" x-transition:enter="transition-opacity duration-300 delay-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="space-y-1">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-3 py-2 text-sm text-gray-200 rounded-md hover:bg-gray-600 hover:text-white transition-colors duration-200">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ __('Profile') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-3 py-2 text-sm text-gray-200 rounded-md hover:bg-gray-600 hover:text-white transition-colors duration-200">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Hamburger -->
    <div class="sm:hidden absolute -right-3 top-4">
        <button @click="open = !open"
            class="inline-flex items-center justify-center p-2 rounded-full bg-[#223871] border border-gray-300 text-gray-200 hover:text-white hover:bg-gray-600 focus:outline-none focus:bg-gray-600 focus:text-white transition duration-150 ease-in-out">
            <svg class="h-4 w-4" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Expand Button (when collapsed) -->
    <button x-show="!$store.sidebar.pinned" @click="$store.sidebar.toggle()"
        class="absolute top-4 -right-3 w-6 h-6 bg-[#223871] border border-gray-300 rounded-full flex items-center justify-center text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Mobile responsive menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden absolute top-20 left-0 right-0 bg-[#223871] border-t border-gray-600 shadow-lg">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-blue-800' : 'text-gray-200 hover:text-white hover:bg-gray-600' }}">{{ __('Dashboard') }}</a>
            <a href="{{ route('admin.tires.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.tires.*') ? 'text-white bg-blue-800' : 'text-gray-200 hover:text-white hover:bg-gray-600' }}">{{ __('Tires') }}</a>
            <a href="{{ route('admin.tickets.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.tickets.*') ? 'text-white bg-blue-800' : 'text-gray-200 hover:text-white hover:bg-gray-600' }}">{{ __('Tickets') }}</a>
            <a href="{{ route('users.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('users.*') ? 'text-white bg-blue-800' : 'text-gray-200 hover:text-white hover:bg-gray-600' }}">{{ __('Home') }}</a>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-600 px-4">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <span
                        class="text-white text-sm font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-white hover:bg-gray-600">{{ __('Profile') }}</a>
                <form method="POST" action="{{ route('logout') }}"> @csrf
                    <button type="submit"
                        class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-white hover:bg-gray-600">{{ __('Log Out') }}</button>
                </form>
            </div>
        </div>
    </div>
</nav>
