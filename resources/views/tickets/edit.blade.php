<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="tier" class="block text-sm font-medium text-gray-700">Tier</label>
                            <select id="tier" name="tier" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="gold" {{ $ticket->tier === 'gold' ? 'selected' : '' }}>Gold</option>
                                <option value="platinum" {{ $ticket->tier === 'platinum' ? 'selected' : '' }}>Platinum</option>
                                <option value="diamond" {{ $ticket->tier === 'diamond' ? 'selected' : '' }}>Diamond</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" id="price" name="price" value="{{ $ticket->price }}" min="0" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="active" {{ $ticket->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $ticket->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Update Ticket
                            </button>
                            <a href="{{ route('tickets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
