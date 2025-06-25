<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tickets') }}
            </h2>
            <button id="create-ticket-btn" class="bg-[#223871] hover:bg-[#3b8fa8] text-white font-bold py-2 px-4 rounded">
                Create New Ticket
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="ticket-list">
                <!-- Ticket list will be injected here via AJAX -->
            </div>
        </div>
    </div>

    <!-- Ticket Modal -->
    <div id="ticket-modal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg transform transition-all duration-300 scale-90">
            <button id="close-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form id="ticket-form">
                @csrf
                <input type="hidden" name="ticket_id" id="ticket_id">
                <div class="mb-4">
                    <label for="tires_id" class="block text-sm font-medium text-gray-700">Tier</label>
                    <select name="tires_id" id="tires_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select a Tier</option>
                        @foreach ($tires as $tire)
                            <option value="{{ $tire->id }}">{{ $tire->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Save Tickets
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- End of Ticket Modal -->

    @section('scripts')
        @vite('resources/js/tickets.js')
    @endsection
</x-app-layout>
