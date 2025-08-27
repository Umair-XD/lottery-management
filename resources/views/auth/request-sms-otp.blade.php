<x-guest-layout>
    <!-- Centered Container -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10 w-[90%] max-w-[30rem] relative z-10">
        <!-- Welcome Header -->
        <div class="text-center">
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                Verify Your Phone
            </h1>
            <p class="mt-2 text-sm md:text-base text-gray-600">
                Enter your mobile number below and we'll send you a one-time code.
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('sms.send') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Mobile Number -->
            <div class="relative flex flex-col">
                <div class="relative">
                    <!-- Icon -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M4.00655 7.93309C3.93421 9.84122 4.41713 13.0817 7.6677 16.3323C8.45191 17.1165 9.23553 17.7396 10 18.2327M5.53781 4.93723C6.93076 3.54428 9.15317 3.73144 10.0376 5.31617L10.6866 6.4791C11.2723 7.52858 11.0372 8.90532 10.1147 9.8278C10.1146 9.82792 8.99588 10.9468 11.0245 12.9755C13.0525 15.0035 14.1714 13.8861 14.1722 13.8853C15.0947 12.9628 16.4714 12.7277 17.5209 13.3134L18.6838 13.9624C20.2686 14.8468 20.4557 17.0692 19.0628 18.4622C18.2258 19.2992 17.2004 19.9505 16.0669 19.9934C15.2529 20.0243 14.1963 19.9541 13 19.6111"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>

                    <x-text-input id="mobile" name="mobile" type="tel"
                        class="peer block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md placeholder-transparent focus:ring-2 focus:ring-[#223871] focus:border-[#223871]"
                        placeholder="Mobile Number" value="{{ old('mobile') }}" required autocomplete="tel" />

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

            <!-- Submit -->
            <div class="flex flex-col items-center justify-center mt-10">
                <div class="button flex justify-center w-full">
                    <x-primary-button>{{ __('Send OTP') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
