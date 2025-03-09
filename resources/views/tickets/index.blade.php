<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Create New Ticket Button -->
                    <button id="create-ticket-btn" class="mb-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Ticket
                    </button>

                    <!-- Ticket List Container (to be loaded dynamically via AJAX) -->
                    <div id="ticket-list">
                        <!-- Ticket list will be injected here -->
                    </div>

                    <!-- Ticket Modal (hidden by default) -->
                    <div id="ticket-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg w-96">
                            <form id="ticket-form">
                                @csrf
                                <input type="hidden" name="ticket_id" id="ticket_id">
                                <div class="mb-4">
                                    <label for="tier" class="block text-sm font-medium text-gray-700">Tier</label>
                                    <select name="tier" id="tier" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="gold">Gold</option>
                                        <option value="platinum">Platinum</option>
                                        <option value="diamond">Diamond</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input type="number" name="price" id="price" min="0" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Save Ticket
                                    </button>
                                    <button type="button" id="cancel-ticket-btn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of Ticket Modal -->
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <!-- Load your custom jQuery AJAX script -->
        <script src="{{ asset('js/tickets.js') }}"></script>
    @endsection
</x-app-layout>
