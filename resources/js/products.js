$(document).ready(function () {

    // Show a loading spinner in the product list container
    function showProductSpinner() {
        $("#product-list").html(`
            <div class="flex items-center justify-center py-8">
                <div class="w-12 h-12 border-4 border-t-4 border-t-[#2bacd5] border-gray-300 rounded-full animate-spin"></div>
            </div>
        `);
    }

    // Load products via AJAX and render table
    function loadProducts() {
        showProductSpinner();
        $.ajax({
            url: "/admin/products",
            method: "GET",
            dataType: "json",
            success: function (data) {
                if (data.length === 0) {
                    $("#product-list").html(`
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded">
                            No products available. Please add a product.
                        </div>
                    `);
                    return;
                }

                let html = `
                <div class="overflow-x-auto px-4 py-2">
                  <table class="min-w-full border border-gray-300 rounded-lg shadow-md divide-y divide-gray-300">
                    <thead class="bg-[#223871] text-white">
                      <tr>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">ID</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Name</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Price</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Duration</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Prize Amount</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Draw Date</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">BG Color</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                `;

                $.each(data, function (_, product) {
                    html += `
                      <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.price}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.duration_phrase}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.prize_amount}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${product.draw_date}</td>
                        <td class="px-6 py-4 text-sm text-center">
                          <div class="w-6 h-6 mx-auto rounded" style="background: ${product.bg_color}"></div>
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                          <button
                            class="edit-product bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md shadow hover:scale-105"
                            data-id="${product.id}"
                          >Edit</button>
                          <button
                            class="delete-product bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md shadow hover:scale-105"
                            data-id="${product.id}"
                          >Delete</button>
                        </td>
                      </tr>
                    `;
                });

                html += `
                    </tbody>
                  </table>
                </div>`;

                $("#product-list").html(html);
            },
            error: function () {
                $("#product-list").html(`
                    <p class="text-red-500 p-4">
                        Failed to load products. Please try again.
                    </p>
                `);
            }
        });
    }

    // Initial load
    loadProducts();

    // Open modal for new product
    $("#create-product-btn").click(function () {
        $("#product-form")[0].reset();
        $("#product_id").val("");
        $("#product-modal")
            .removeClass("opacity-0 pointer-events-none")
            .addClass("opacity-100 pointer-events-auto");
    });

    // Close modal
    $("#close-product-modal, #cancel-product-btn").click(function () {
        $("#product-modal")
            .removeClass("opacity-100 pointer-events-auto")
            .addClass("opacity-0 pointer-events-none");
    });

    // Create / Update product
    $("#product-form").submit(function (e) {
        e.preventDefault();
        const productId = $("#product_id").val();
        const formData = new FormData(this);

        const ajaxOpts = {
            data: formData,
            processData: false,
            contentType: false,
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success(response) {
                alert(response.message);
                $("#product-modal")
                    .removeClass("opacity-100 pointer-events-auto")
                    .addClass("opacity-0 pointer-events-none");
                loadProducts();
            },
            error(xhr) {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.values(errors).forEach(msgs => alert(msgs[0]));
                } else {
                    alert(productId ? "Error updating product." : "Error creating product.");
                }
            }
        };

        if (!productId) {
            $.extend(ajaxOpts, { url: "/admin/products", method: "POST" });
        } else {
            // Laravel requires POST + _method=PUT for file uploads
            formData.append("_method", "PUT");
            $.extend(ajaxOpts, {
                url: `/admin/products/${productId}`,
                method: "POST"
            });
        }

        $.ajax(ajaxOpts);
    });

    // Edit: fetch and populate
    $(document).on("click", ".edit-product", function () {
        const productId = $(this).data("id");
        $.ajax({
            url: `/admin/products/${productId}`,
            method: "GET",
            dataType: "json",
            success: function (product) {
                $("#product_id").val(product.id);
                $("#product_name").val(product.name);
                $("#product_price").val(product.price);
                $("#product_duration_phrase").val(product.duration_phrase);
                $("#product_prize_amount").val(product.prize_amount);
                $("#product_draw_date").val(product.draw_date.substring(0, 16));
                $("#product_bg_color").val(product.bg_color);

                $("#product-modal")
                    .removeClass("opacity-0 pointer-events-none")
                    .addClass("opacity-100 pointer-events-auto");
            },
            error() {
                alert("Failed to fetch product details.");
            }
        });
    });

    // Delete product
    $(document).on("click", ".delete-product", function () {
        if (!confirm("Are you sure you want to delete this product?")) return;
        const productId = $(this).data("id");
        $.ajax({
            url: `/admin/products/${productId}`,
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success(response) {
                alert(response.message);
                loadProducts();
            },
            error() {
                alert("Error deleting product.");
            }
        });
    });
});
