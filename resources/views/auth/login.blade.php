<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="welcome flex flex-col items-center justify-center md:mt-16 mt-6">
        <h1 class='text-2xl md:text-3xl font-black text-center'>Welcome to KingdomsDraw</h1>
        <p class="text-sm md:text-lg text-center">Please sign in to your account and start the adventure</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="fields flex flex-col items-center mt-8">
            <!-- Email or Username Field -->
            <div class="relative mt-4">
                <!-- Person Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="6" r="4" stroke-width="1.5"></circle>
                        <path
                            d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                            stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
                <!-- Input Field with Floating Placeholder -->
                <x-text-input id="email" name="email" type="text" :value="old('email')" required autofocus
                    autocomplete="username"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Email or username" />
                <!-- Floating Label -->
                <label for="email"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                            /* Default (non-empty) state: floated */
                            top-0 -translate-y-1/2 scale-75
                            /* When input is empty, show label inside */
                            peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                            /* When input is focused, force float */
                            peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Email or username
                </label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password Field -->
            <div class="relative mt-4">
                <!-- Padlock Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                                stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                            <path
                                d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <!-- Input Field with Floating Placeholder -->
                <x-text-input id="password" name="password" type="password" required autocomplete="current-password"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Password" />
                <!-- Floating Label -->
                <label for="password"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                            top-0 -translate-y-1/2 scale-75
                            peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                            peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Password
                </label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

        </div>

        <div class="flex flex-col items-center justify-center mt-12">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <div class="button flex justify-center w-full">
                <x-primary-button>{{ __('Sign in') }}</x-primary-button>
            </div>

            <div class="flex items-center text-sm md:text-base mt-2">
                <a class="text-gray-900 font-bold">
                    {{ __("Don't have and account?") }}
                </a>
                <a class="font-black text-[#223871] ml-1" href="{{ route('register') }}">
                    {{ __('Sign Up') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
