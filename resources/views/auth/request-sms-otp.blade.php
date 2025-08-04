<x-guest-layout>
    <!-- Welcome Header -->
    <div class="welcome flex flex-col items-center justify-center md:mt-16 mt-6">
        <h1 class="text-2xl md:text-3xl font-black text-center">Verify Your Phone</h1>
        <p class="text-sm md:text-lg text-center">
            Enter your mobile number below and we'll send you a one-time code.
        </p>
    </div>

    <form method="POST" action="{{ route('sms.send') }}">
        @csrf

        <div class="fields flex flex-col items-center mt-8">
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
        </div>

        <!-- Submit -->
        <div class="flex flex-col items-center justify-center mt-10">
            <div class="button flex justify-center w-full">
                <x-primary-button>{{ __('Send OTP') }}</x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
