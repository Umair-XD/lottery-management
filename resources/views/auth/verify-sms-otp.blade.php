<x-guest-layout>
    <!-- Welcome Header -->
    <div class="welcome flex flex-col items-center justify-center md:mt-16 mt-6">
        <h1 class="text-2xl md:text-3xl font-black text-center">Enter Verification Code</h1>
        <p class="text-sm md:text-lg text-center">
            We’ve sent a one-time code to your mobile. Please enter it below to verify your phone.
        </p>
    </div>
@if(session('status'))
  <div class="mb-4 text-green-600 text-center">
    {{ session('status') }}
  </div>
@endif
    <form method="POST" action="{{ route('sms.verify') }}">
        @csrf

        <div class="fields flex flex-col items-center mt-8">
            <!-- OTP Code -->
            <div class="relative mt-4">
                <!-- Key Icon -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#223871]" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <circle cx="3" cy="3" r="3" transform="matrix(-1 0 0 1 22 2)" stroke="#223871" stroke-width="1.5"/>
                        <path d="M14 2.2C13.354 2.069 12.685 2 12 2C10.179 2 8.471 2.487 7 3.338M21.8 10C21.93 10.646 22 11.315 22 12C22 17.523 17.523 22 12 22C10.4 22 8.888 21.624 7.548 20.957L6.399 20.823L4.173 21.419L3.178 17.601C3.28 17.216 3.221 16.809 3.043 16.452C2.376 15.112 2 13.6 2 12C2 10.179 2.487 8.471 3.338 7"
                              stroke="#223871" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <x-text-input id="otp" name="otp" type="text" :value="old('otp')" required
                              autocomplete="one-time-code"
                              class="peer block w-64 md:w-80 pl-10 pr-2 py-2 border border-gray-300 rounded placeholder-transparent"
                              placeholder="OTP Code" />
                <label for="otp"
                       class="absolute left-10 bg-white px-1 text-sm text-[#223871] transition-all duration-200 origin-left
                              top-0 -translate-y-1/2 scale-75
                              peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100
                              peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75">
                    OTP Code
                </label>
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>
        </div>

        <!-- Submit -->
        <div class="flex flex-col items-center justify-center mt-10">
            <div class="button flex justify-center w-full">
                <x-primary-button>{{ __('Verify Phone') }}</x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
