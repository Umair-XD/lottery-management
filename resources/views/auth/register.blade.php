{{-- <x-guest-layout>
    <!-- Welcome Header -->
    <div class="welcome flex flex-col items-center justify-center md:mt-16 mt-6">
        <h1 class="text-2xl md:text-3xl font-black text-center">Welcome to KingdomsDraw</h1>
        <p class="text-sm md:text-lg text-center">Please create your account and start the adventure</p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="feilds flex flex-col items-center mt-8">

            <!-- Name Field -->
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
                <!-- Name Input with Floating Placeholder -->
                <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                    autocomplete="name"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Name" />
                <!-- Floating Label -->
                <label for="name"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                          top-0 -translate-y-1/2 scale-75
                          peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                          peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Name
                </label>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Field -->
            <div class="relative mt-4">
                <!-- Envelope Icon for Email -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#223871">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.4816 5.82475 21.7706 6.69989 21.8985 8"
                                stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                            <path
                                d="M18 8L15.8411 9.79908C14.0045 11.3296 13.0861 12.0949 12 12.0949C11.3507 12.0949 10.7614 11.8214 10 11.2744M6 8L6.9 8.75L7.8 9.5"
                                stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <!-- Email Input with Floating Placeholder -->
                <x-text-input id="email" name="email" type="email" :value="old('email')" required
                    autocomplete="username"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Email" />
                <!-- Floating Label -->
                <label for="email"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                          top-0 -translate-y-1/2 scale-75
                          peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                          peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Email
                </label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password Field -->
            <div class="relative mt-4">
                <!-- Padlock Icon for Password -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Password Input with Floating Placeholder -->
                <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
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

            <!-- Confirm Password Field -->
            <div class="relative mt-4">
                <!-- Lock Icon for Confirm Password (reusing the password icon) -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Confirm Password Input with Floating Placeholder -->
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Confirm Password" />
                <!-- Floating Label -->
                <label for="password_confirmation"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                          top-0 -translate-y-1/2 scale-75
                          peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                          peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Confirm Password
                </label>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Submit and Login Link -->
        <div class="flex flex-col items-center justify-center mt-12">
            <div class="button flex justify-center w-full">
                <x-primary-button class="ms-4">{{ __('Register') }}</x-primary-button>
            </div>

            <div class="flex items-center text-sm md:text-base mt-2">
                <a class="text-gray-900 font-bold" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
                <a class="font-black text-[#223871] ml-1" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <!-- Welcome Header -->
    <div class="welcome flex flex-col items-center justify-center md:mt-16 mt-6">
        <h1 class="text-2xl md:text-3xl font-black text-center">Register at KingdomsDraw</h1>
        <p class="text-sm md:text-lg text-center">
            Please fill in the required fields to create your account and start the adventure
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="fields flex flex-col items-center mt-8">
            <!-- Full Name (as per CNIC) -->
            <div class="relative mt-4">
                <!-- Person Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="6" r="4" stroke-width="1.5"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634" />
                    </svg>
                </div>
                <x-text-input id="full_name" name="full_name" type="text" :value="old('full_name')" required autofocus
                    autocomplete="name"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Full Name (as per CNIC)" />
                <label for="full_name"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Full Name (as per CNIC)
                </label>
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="relative mt-4">
                <!-- Envelope Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#223871">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.4816 5.82475 21.7706 6.69989 21.8985 8" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M18 8L15.8411 9.79908C14.0045 11.3296 13.0861 12.0949 12 12.0949C11.3507 12.0949 10.7614 11.8214 10 11.2744M6 8L6.9 8.75L7.8 9.5" />
                    </svg>
                </div>
                <x-text-input id="email" name="email" type="email" :value="old('email')" required
                    autocomplete="username"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Email Address" />
                <label for="email"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Email Address
                </label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Mobile Number -->
            <div class="relative mt-4">
                <!-- Mobile Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg viewBox="-2.4 -2.4 28.80 28.80" class="w-6 h-6 text-[#223871]" fill="none"
                        xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M4.00655 7.93309C3.93421 9.84122 4.41713 13.0817 7.6677 16.3323C8.45191 17.1165 9.23553 17.7396 10 18.2327M5.53781 4.93723C6.93076 3.54428 9.15317 3.73144 10.0376 5.31617L10.6866 6.4791C11.2723 7.52858 11.0372 8.90532 10.1147 9.8278C10.1147 9.8278 10.1147 9.8278 10.1147 9.8278C10.1146 9.82792 8.99588 10.9468 11.0245 12.9755C13.0525 15.0035 14.1714 13.8861 14.1722 13.8853C14.1722 13.8853 14.1722 13.8853 14.1722 13.8853C15.0947 12.9628 16.4714 12.7277 17.5209 13.3134L18.6838 13.9624C20.2686 14.8468 20.4557 17.0692 19.0628 18.4622C18.2258 19.2992 17.2004 19.9505 16.0669 19.9934C15.2529 20.0243 14.1963 19.9541 13 19.6111"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <x-text-input id="mobile" name="mobile" type="tel" :value="old('mobile')" required autocomplete="tel"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Mobile Number" />
                <label for="mobile"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Mobile Number
                </label>
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
            </div>

            <!-- OTP -->
            <div class="relative mt-4">
                <!-- OTP Icon (Key icon) -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#223871]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a3 3 0 00-3-3H7a3 3 0 00-3 3v8a3 3 0 003 3h5l4 4v-4a3 3 0 003-3V7z" />
                    </svg>
                </div>
                <x-text-input id="otp" name="otp" type="text" :value="old('otp')" required
                    autocomplete="one-time-code"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="OTP" />
                <label for="otp"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    OTP
                </label>
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <!-- Password Field -->
            <div class="relative mt-4">
                <!-- Padlock Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Password" />
                <label for="password"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Password
                </label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password Field -->
            <div class="relative mt-4">
                <!-- Lock Icon for Confirm Password (reusing padlock icon) -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#223871" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password"
                    class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                    placeholder="Confirm Password" />
                <label for="password_confirmation"
                    class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    Confirm Password
                </label>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- User Agreements -->
            <div class="mt-6 w-64 md:w-80">
                <div class="flex items-center mt-2">
                    <input id="age_confirm" name="age_confirm" type="checkbox"
                        class="rounded border-gray-300 text-[#223871] focus:ring-[#223871]">
                    <label for="age_confirm" class="ml-2 text-sm text-gray-700">
                        I am 18 years or older.
                    </label>
                </div>
                <div class="flex items-center mt-2">
                    <input id="terms" name="terms" type="checkbox"
                        class="rounded border-gray-300 text-[#223871] focus:ring-[#223871]">
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        I agree to the <a href="#" class="underline">Terms &amp; Conditions</a>.
                    </label>
                </div>
                <div class="flex items-center mt-2">
                    <input id="privacy" name="privacy" type="checkbox"
                        class="rounded border-gray-300 text-[#223871] focus:ring-[#223871]">
                    <label for="privacy" class="ml-2 text-sm text-gray-700">
                        I agree to the <a href="#" class="underline">Privacy Policy</a>.
                    </label>
                </div>
                <div class="flex items-center mt-2">
                    <input id="responsible_play" name="responsible_play" type="checkbox"
                        class="rounded border-gray-300 text-[#223871] focus:ring-[#223871]">
                    <label for="responsible_play" class="ml-2 text-sm text-gray-700">
                        I understand and accept the <a href="#" class="underline">Responsible Play policy</a>.
                    </label>
                </div>
                <x-input-error :messages="$errors->get('agreements')" class="mt-2" />
            </div>
        </div>

        <!-- Submit and Login Link -->
        <div class="flex flex-col items-center justify-center mt-12">
            <div class="button flex justify-center w-full">
                <x-primary-button class="ms-4">{{ __('Register') }}</x-primary-button>
            </div>

            <div class="flex items-center text-sm md:text-base mt-2">
                <a class="text-gray-900 font-bold" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
                <a class="font-black text-[#223871] ml-1" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
