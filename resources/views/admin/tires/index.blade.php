<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket Tiers') }}
            </h2>
            <button id="create-tire-btn" class="bg-[#223871] hover:bg-[#3b8fa8] text-white font-bold py-2 px-4 rounded">
                Add New Tier
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="tire-list">
                <!-- Ticket tiers will be injected here via AJAX -->
            </div>
        </div>
    </div>

    <!-- Ticket Tier Modal -->
    <div id="tire-modal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg transform
              transition-all duration-300 scale-90">

            <button id="close-tire-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <!-- ✕ icon -->
            </button>

            <form id="tire-form">
                @csrf
                <input type="hidden" name="tire_id" id="tire_id">

                <!-- Tier Name -->
                <div class="mb-4">
                    <label for="tire_name" class="block text-sm font-medium text-gray-700">
                        Tier Name
                    </label>
                    <input type="text" id="tire_name" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="tire_price" class="block text-sm font-medium text-gray-700">
                        Price
                    </label>
                    <input type="number" id="tire_price" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Prize Amount -->
                <div class="mb-4">
                    <label for="tire_prize_amount" class="block text-sm font-medium text-gray-700">
                        Prize Amount
                    </label>
                    <input type="number" id="tire_prize_amount" min="0" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Multiplier -->
                <div class="mb-4">
                    <label for="tire_multiplier" class="block text-sm font-medium text-gray-700">
                        Multiplier
                    </label>
                    <input type="number" id="tire_multiplier" min="1" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Draw Date/Time -->
                <div class="mb-4">
                    <label for="tire_draw_date" class="block text-sm font-medium text-gray-700">
                        Draw Date & Time
                    </label>
                    <input type="datetime-local" id="tire_draw_date" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Background Color -->
                <div class="mb-4">
                    <label for="tire_bg_color" class="block text-sm font-medium text-gray-700">
                        Card Background Color
                    </label>
                    <input type="color" id="tire_bg_color" value="#ffffff" required
                        class="mt-1 block w-12 h-8 p-0 border-none">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-tire-btn"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Tier
                    </button>
                </div>
            </form>
        </div>
    </div>


    @section('scripts')
        @vite('resources/js/tires.js')
    @endsection
</x-admin-layout>
