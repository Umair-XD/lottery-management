$(document).ready(function () {
    // Helper: Show a loading spinner in the tire list container
    function showTireSpinner() {
        $("#tire-list").html(`
            <div class="flex items-center justify-center py-8">
                <div class="w-12 h-12 border-4 border-t-4 border-t-[#2bacd5] border-gray-300 rounded-full animate-spin"></div>
            </div>
        `);
    }

    // Function to load tire tiers dynamically
    function loadTires() {
        showTireSpinner();
        $.ajax({
            url: "/admin/tires",
            method: "GET",
            dataType: "json",
            success: function (data) {
                // If no tire tiers are returned, notify the user
                if (data.length === 0) {
                    $("#tire-list").html(
                        '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded">No Ticket tiers available. Please add a tier.</div>'
                    );
                    return;
                }

                // Build the HTML table for tire tiers
                let html = `
                <div class="overflow-x-auto px-4 py-2">
                  <table class="min-w-full border border-gray-300 rounded-lg shadow-md divide-y divide-gray-300">
                    <thead class="bg-[#2bacd5] text-white">
                      <tr>
                        <th scope="col" class="w-1/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">ID</th>
                        <th scope="col" class="w-3/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Tier Name</th>
                        <th scope="col" class="w-3/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Price</th>
                        <th scope="col" class="w-3/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Draw Date</th>
                        <th scope="col" class="w-2/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">`;

                $.each(data, function (index, tire) {
                    html += `
                      <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${tire.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${tire.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${tire.price}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${tire.draw_date}</td>
                        <td class="px-6 py-4 text-center border-b border-gray-200 flex justify-center gap-2">
                          <button class="edit-tire bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md shadow transform transition-transform hover:scale-105" data-id="${tire.id}">Edit</button>
                          <button class="delete-tire bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md shadow transform transition-transform hover:scale-105" data-id="${tire.id}">Delete</button>
                        </td>
                      </tr>`;
                });

                html += `
                    </tbody>
                  </table>
                </div>`;
                $("#tire-list").html(html);
            },
            error: function () {
                $("#tire-list").html(
                    '<p class="text-red-500 p-4">Failed to load ticket tiers. Please try again.</p>'
                );
            },
        });
    }

    // Initially load tire tiers
    loadTires();

    // Show modal for creating a new tire tier
    $("#create-tire-btn").click(function () {
        $("#tire-form")[0].reset();
        $("#tire_id").val("");
        $("#tire-modal")
            .removeClass("opacity-0 pointer-events-none")
            .addClass("opacity-100 pointer-events-auto");
    });

    // Close modal when clicking close or cancel buttons
    $("#close-tire-modal, #cancel-tire-btn").click(function () {
        $("#tire-modal")
            .removeClass("opacity-100 pointer-events-auto")
            .addClass("opacity-0 pointer-events-none");
    });

    // Submit form for creating/updating tire tiers
    $("#tire-form").submit(function (e) {
        e.preventDefault();
        const tireId = $("#tire_id").val();
        const formData = {
            name: $("#tire_name").val(),
            price: $("#tire_price").val(),
            draw_date: $("#tire_draw_date").val(),
        };

        if (tireId === "") {
            // Create a new tire tier
            $.ajax({
                url: "/admin/tires",
                method: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#tire-modal")
                        .removeClass("opacity-100 pointer-events-auto")
                        .addClass("opacity-0 pointer-events-none");
                    loadTires();
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        for (let field in errors) {
                            alert(errors[field][0]);
                        }
                    } else {
                        alert("Error creating tire tier.");
                    }
                },
            });
        } else {
            // Update existing tire tier
            $.ajax({
                url: `/admin/tires/${tireId}`,
                method: "PUT",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#tire-modal")
                        .removeClass("opacity-100 pointer-events-auto")
                        .addClass("opacity-0 pointer-events-none");
                    loadTires();
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        for (let field in errors) {
                            alert(errors[field][0]);
                        }
                    } else {
                        alert("Error updating tire tier.");
                    }
                },
            });
        }
    });

    // Edit tire tier: Fill modal with existing data
    $(document).on("click", ".edit-tire", function () {
        const tireId = $(this).data("id");
        $.ajax({
            url: `/admin/tires/${tireId}`,
            method: "GET",
            dataType: "json",
            success: function (tire) {
                $("#tire_id").val(tire.id);
                $("#tire_name").val(tire.name);
                $("#tire_price").val(tire.price);
                $("#tire_draw_date").val(tire.draw_date);
                $("#tire-modal")
                    .removeClass("opacity-0 pointer-events-none")
                    .addClass("opacity-100 pointer-events-auto");
            },
            error: function () {
                alert("Failed to fetch tire tier details.");
            },
        });
    });

    // Delete tire tier
    $(document).on("click", ".delete-tire", function () {
        if (!confirm("Are you sure you want to delete this tire tier?")) return;
        const tireId = $(this).data("id");
        $.ajax({
            url: `/admin/tires/${tireId}`,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                alert(response.message);
                loadTires();
            },
            error: function () {
                alert("Error deleting tire tier.");
            },
        });
    });
});
