$(document).ready(function () {

    // Show a loading spinner in the tire list container
    function showTireSpinner() {
        $("#tire-list").html(`
            <div class="flex items-center justify-center py-8">
                <div class="w-12 h-12 border-4 border-t-4 border-t-[#2bacd5] border-gray-300 rounded-full animate-spin"></div>
            </div>
        `);
    }

    // Load tire tiers via AJAX and render table
    function loadTires() {
        showTireSpinner();
        $.ajax({
            url: "/admin/tires",
            method: "GET",
            dataType: "json",
            success: function (data) {
                if (data.length === 0) {
                    $("#tire-list").html(`
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded">
                            No ticket tiers available. Please add a tier.
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
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Tier Name</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Price</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Entries/Ticket</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Prize Amount</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Multiplier</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Draw Date</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">BG Color</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                `;

                $.each(data, function (_, tire) {
                    html += `
                      <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.price}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.prize_amount}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.multiplier}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">${tire.draw_date}</td>
                        <td class="px-6 py-4 text-sm text-center">
                          <div class="w-6 h-6 mx-auto rounded" style="background: ${tire.bg_color}"></div>
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                          <button
                            class="edit-tire bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md shadow hover:scale-105"
                            data-id="${tire.id}"
                          >Edit</button>
                          <button
                            class="delete-tire bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md shadow hover:scale-105"
                            data-id="${tire.id}"
                          >Delete</button>
                        </td>
                      </tr>
                    `;
                });

                html += `
                    </tbody>
                  </table>
                </div>`;

                $("#tire-list").html(html);
            },
            error: function () {
                $("#tire-list").html(`
                    <p class="text-red-500 p-4">
                        Failed to load ticket tiers. Please try again.
                    </p>
                `);
            }
        });
    }

    // Initial load
    loadTires();

    // Open modal for new tier
    $("#create-tire-btn").click(function () {
        $("#tire-form")[0].reset();
        $("#tire_id").val("");
        $("#tire-modal")
            .removeClass("opacity-0 pointer-events-none")
            .addClass("opacity-100 pointer-events-auto");
    });

    // Close modal
    $("#close-tire-modal, #cancel-tire-btn").click(function () {
        $("#tire-modal")
            .removeClass("opacity-100 pointer-events-auto")
            .addClass("opacity-0 pointer-events-none");
    });

    // Create / Update tier
    $("#tire-form").submit(function (e) {
        e.preventDefault();
        const tireId = $("#tire_id").val();
        const formData = {
            name: $("#tire_name").val(),
            price: $("#tire_price").val(),
            prize_amount: $("#tire_prize_amount").val(),
            multiplier: $("#tire_multiplier").val(),
            draw_date: $("#tire_draw_date").val(),
            bg_color: $("#tire_bg_color").val(),
        };

        const ajaxOpts = {
            data: formData,
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success(response) {
                alert(response.message);
                $("#tire-modal")
                    .removeClass("opacity-100 pointer-events-auto")
                    .addClass("opacity-0 pointer-events-none");
                loadTires();
            },
            error(xhr) {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.values(errors).forEach(msgs => alert(msgs[0]));
                } else {
                    alert(tireId ? "Error updating tire tier." : "Error creating tire tier.");
                }
            }
        };

        if (tireId === "") {
            $.extend(ajaxOpts, { url: "/admin/tires", method: "POST" });
        } else {
            $.extend(ajaxOpts, {
                url: `/admin/tires/${tireId}`,
                method: "PUT"
            });
        }

        $.ajax(ajaxOpts);
    });

    // Edit: fetch and populate
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
                $("#tire_prize_amount").val(tire.prize_amount);
                $("#tire_multiplier").val(tire.multiplier);

                // Trim ISO to YYYY-MM-DDThh:mm for datetime-local
                $("#tire_draw_date").val(tire.draw_date.substring(0, 16));
                $("#tire_bg_color").val(tire.bg_color);

                $("#tire-modal")
                    .removeClass("opacity-0 pointer-events-none")
                    .addClass("opacity-100 pointer-events-auto");
            },
            error() {
                alert("Failed to fetch tire tier details.");
            }
        });
    });

    // Delete tier
    $(document).on("click", ".delete-tire", function () {
        if (!confirm("Are you sure you want to delete this tire tier?")) return;
        const tireId = $(this).data("id");
        $.ajax({
            url: `/admin/tires/${tireId}`,
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success(response) {
                alert(response.message);
                loadTires();
            },
            error() {
                alert("Error deleting tire tier.");
            }
        });
    });
});
