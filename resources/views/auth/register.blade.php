<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10 w-[90%] max-w-[30rem] relative z-10">
        <!-- Welcome Text -->
        <div class="text-center mb-5">
            <h1 class="text-2xl md:text-3xl font-black text-[#223871]">Register at KingdomsDraw</h1>
            <p class="text-xs mt-2 md:text-base text-gray-600">Please fill in the fields below to create your account and
                start the adventure</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="space-y-6">
                <!-- Full Name -->
                <div class="relative flex flex-col">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <!-- Person Icon -->
                            <svg class="w-5 h-5 text-[#223871]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                shape-rendering="geometricPrecision" vector-effect="non-scaling-stroke">
                                <circle cx="12" cy="6" r="4" stroke-width="1.5"></circle>
                                <path
                                    d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                                    stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                            class="peer block w-full pl-10 pr-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#223871] placeholder-transparent"
                            placeholder="Full Name" />
                        <label for="name"
                            class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                                   top-0 -translate-y-1/2 scale-75
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                            Full Name
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="relative flex flex-col">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <!-- Envelope Icon -->
                            <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                shape-rendering="geometricPrecision" vector-effect="non-scaling-stroke">
                                <path
                                    d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.4816 5.82475 21.7706 6.69989 21.8985 8"
                                    stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M18 8L15.8411 9.79908C14.0045 11.3296 13.0861 12.0949 12 12.0949C11.3507 12.0949 10.7614 11.8214 10 11.2744M6 8L6.9 8.75L7.8 9.5"
                                    stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <x-text-input id="email" name="email" type="email" :value="old('email')" required
                            class="peer block w-full pl-10 pr-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#223871] placeholder-transparent"
                            placeholder="Email Address" />
                        <label for="email"
                            class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                                   top-0 -translate-y-1/2 scale-75
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                            Email Address
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- <!-- Mobile Number -->
                <div class="relative flex flex-col">
                    <div class="relative">
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
                        <x-text-input id="mobile" name="mobile" type="tel" :value="old('mobile')" required
                            autocomplete="tel"
                            class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                            placeholder="Mobile Number" />
                        <label for="mobile"
                            class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                            Mobile Number
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
                </div>

                <!-- OTP -->
                <div class="relative flex flex-col">
                    <div class="relative">
                        <!-- OTP Icon (Key icon) -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <circle cx="3" cy="3" r="3" transform="matrix(-1 0 0 1 22 2)"
                                        stroke="#223871" stroke-width="1.5"></circle>
                                    <path
                                        d="M14 2.20004C13.3538 2.06886 12.6849 2 12 2C10.1786 2 8.47087 2.48697 7 3.33782M21.8 10C21.9311 10.6462 22 11.3151 22 12C22 17.5228 17.5228 22 12 22C10.4003 22 8.88837 21.6244 7.54753 20.9565C7.19121 20.7791 6.78393 20.72 6.39939 20.8229L4.17335 21.4185C3.20701 21.677 2.32295 20.793 2.58151 19.8267L3.17712 17.6006C3.28001 17.2161 3.22094 16.8088 3.04346 16.4525C2.37562 15.1116 2 13.5997 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                        stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                                </g>
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
                    </div>
                    <x-input-error :messages="$errors->get('otp')" class="mt-1" />
                </div> --}}

                <!-- Password -->
                <div class="relative flex flex-col">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <!-- Padlock Icon -->
                            <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                                shape-rendering="geometricPrecision" vector-effect="non-scaling-stroke">
                                <path
                                    d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                                    stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                    stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <x-text-input id="password" name="password" type="password" required
                            class="peer block w-full pl-10 pr-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#223871] placeholder-transparent"
                            placeholder="Password" />
                        <label for="password"
                            class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                                   top-0 -translate-y-1/2 scale-75
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                            Password
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="relative flex flex-col">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <!-- Reuse Padlock -->
                            <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                                shape-rendering="geometricPrecision" vector-effect="non-scaling-stroke">
                                <path
                                    d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                                    stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                    stroke="#223871" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            required
                            class="peer block w-full pl-10 pr-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#223871] placeholder-transparent"
                            placeholder="Confirm Password" />
                        <label for="password_confirmation"
                            class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                                   top-0 -translate-y-1/2 scale-75
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:translate-y-[-50%] peer-placeholder-shown:scale-100
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                            Confirm Password
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox"
                        class="rounded border-gray-300 text-[#223871] focus:ring-[#223871]">
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        I agree to the
                        <a href="{{ route('users.terms') }}" class="underline">Terms and Conditions</a> &amp;
                        <a href="{{ route('users.privacy') }}" class="underline">Privacy Policy</a>.
                    </label>
                    <x-input-error :messages="$errors->get('terms')" class="mt-1" />
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col items-center mt-6 space-y-4">
                <div class="button flex justify-center w-full">
                    <x-primary-button>{{ __('Register') }}</x-primary-button>
                </div>

                <div class="flex items-center text-sm md:text-base">
                    <span class="text-gray-600">{{ __('Already have an account?') }}</span>
                    <a class="font-black text-[#223871] ml-1 hover:underline" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
