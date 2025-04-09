<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket Tiers') }}
            </h2>
            <button id="create-tire-btn" class="bg-[#2bacd5] hover:bg-[#3b8fa8] text-white font-bold py-2 px-4 rounded">
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
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg transform transition-all duration-300 scale-90">
            <button id="close-tire-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form id="tire-form">
                @csrf
                <input type="hidden" name="tire_id" id="tire_id">
                <div class="mb-4">
                    <label for="tire_name" class="block text-sm font-medium text-gray-700">Tier Name</label>
                    <input type="text" name="tire_name" id="tire_name" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="tire_price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="tire_price" id="tire_price" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="tire_draw_date" class="block text-sm font-medium text-gray-700">Draw Date</label>
                    <input type="date" name="tire_draw_date" id="tire_draw_date" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
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
</x-app-layout>
