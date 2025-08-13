<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <button id="create-product-btn" class="bg-[#223871] hover:bg-[#3b8fa8] text-white font-bold py-2 px-4 rounded">
                Add New Product
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="product-list">
                <!-- Products will be injected here via AJAX -->
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="product-modal"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center
                opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg transform
                   transition-all duration-300 scale-90">

            <button id="close-product-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <!-- ✕ icon -->
            </button>

            <form id="product-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" id="product_id">

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Product Name
                    </label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="product_price" class="block text-sm font-medium text-gray-700">
                        Price
                    </label>
                    <input type="number" id="product_price" name="price" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Duration Phrase -->
                <div class="mb-4">
                    <label for="product_duration_phrase" class="block text-sm font-medium text-gray-700">
                        Duration Phrase
                    </label>
                    <input type="text" id="product_duration_phrase" name="duration_phrase" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Prize Amount -->
                <div class="mb-4">
                    <label for="product_prize_amount" class="block text-sm font-medium text-gray-700">
                        Prize Amount
                    </label>
                    <input type="number" id="product_prize_amount" name="prize_amount" min="0" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Draw Date & Time -->
                <div class="mb-4">
                    <label for="product_draw_date" class="block text-sm font-medium text-gray-700">
                        Draw Date & Time
                    </label>
                    <input type="datetime-local" id="product_draw_date" name="draw_date" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Card Background Color -->
                <div class="mb-4">
                    <label for="product_bg_color" class="block text-sm font-medium text-gray-700">
                        Card Background Color
                    </label>
                    <input type="color" id="product_bg_color" name="bg_color" value="#ffffff" required
                           class="mt-1 block w-12 h-8 p-0 border-none">
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="product_image" class="block text-sm font-medium text-gray-700">
                        Product Image
                    </label>
                    <input type="file" id="product_image" name="image" accept="image/*"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-product-btn"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        @vite('resources/js/products.js')
    @endsection
</x-admin-layout>
