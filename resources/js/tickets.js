$(document).ready(function () {
    // Helper: Show a loading spinner
    function showSpinner() {
        $("#ticket-list").html(`
            <div class="flex items-center justify-center py-8">
                <div class="w-12 h-12 border-4 border-t-4 border-t-[#2bacd5] border-gray-300 rounded-full animate-spin"></div>
            </div>
        `);
    }

    // Function to load tickets dynamically
    function loadTickets() {
        showSpinner();
        $.ajax({
            url: "/admin/tickets",
            method: "GET",
            dataType: "json",
            // success: function (data) {
            //     // If no tickets are returned, notify the user
            //     if (data.length === 0) {
            //         $("#ticket-list").html(
            //             '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded">No Tickets available. Please add a ticket.</div>'
            //         );
            //         return;
            //     }

            //     // Build the HTML table for tickets
            //     let html = `
            //     <div class="overflow-x-auto px-4 py-2">
            //       <table class="min-w-full border border-gray-300 rounded-lg shadow-md divide-y divide-gray-300">
            //         <thead class="bg-[#2bacd5] text-white">
            //           <tr>
            //             <th scope="col" class="w-1/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">ID</th>
            //             <th scope="col" class="w-2/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Ticket Name</th>
            //             <th scope="col" class="w-3/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Tier</th>
            //             <th scope="col" class="w-2/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Status</th>
            //             <th scope="col" class="w-4/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Actions</th>
            //           </tr>
            //         </thead>
            //         <tbody class="divide-y divide-gray-200">`;

            //     $.each(data, function (index, ticket) {
            //         html += `
            //           <tr class="hover:bg-gray-100">
            //             <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
            //                 ticket.id
            //             }</td>
            //             <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
            //                 ticket.ticket_number
            //             }</td>
            //             <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
            //                 ticket.tire?.name || "N/A"
            //             }</td>
            //             <td class="px-6 py-4 text-sm text-center border-b border-gray-200">
            //               <span class="px-2 py-1 inline-flex text-xs font-medium rounded-full ${
            //                   ticket.status === "active"
            //                       ? "bg-green-100 text-green-800"
            //                       : "bg-red-100 text-red-800"
            //               }">
            //                 ${
            //                     ticket.status.charAt(0).toUpperCase() +
            //                     ticket.status.slice(1)
            //                 }
            //               </span>
            //             </td>
            //             <td class="px-6 py-4 text-center border-b border-gray-200 flex justify-center gap-2">
            //               <button class="edit-ticket bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md shadow transform transition-transform hover:scale-105" data-id="${
            //                   ticket.id
            //               }">Edit</button>
            //               <button class="delete-ticket bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md shadow transform transition-transform hover:scale-105" data-id="${
            //                   ticket.id
            //               }">Delete</button>
            //             </td>
            //           </tr>`;
            //     });

            //     html += `
            //         </tbody>
            //       </table>
            //     </div>`;
            //     $("#ticket-list").html(html);
            // },
            success: function (data) {
                // If no tickets are returned, notify the user
                if (data.length === 0) {
                    $("#ticket-list").html(
                        '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded">No Tickets available. Please add a ticket.</div>'
                    );
                    return;
                }

                // Build the HTML table for tickets
                let html = `
                <div class="overflow-x-auto px-4 py-2">
                  <table id="tickets-table" class="table min-w-full border border-gray-300 rounded-lg shadow-md divide-y divide-gray-300">
                    <thead class="bg-[#2bacd5] text-white">
                      <tr>
                        <th scope="col" class="w-1/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">ID</th>
                        <th scope="col" class="w-2/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Ticket Name</th>
                        <th scope="col" class="w-3/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Tier</th>
                        <th scope="col" class="w-2/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Status</th>
                        <th scope="col" class="w-4/12 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase">Actions</th>
                      </tr>
                    </thead>
                    <tbody>`;

                $.each(data, function (index, ticket) {
                    html += `
                      <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
                            ticket.id
                        }</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
                            ticket.ticket_number
                        }</td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center border-b border-gray-200">${
                            ticket.tire?.name || "N/A"
                        }</td>
                        <td class="px-6 py-4 text-sm text-center border-b border-gray-200">
                          <span class="px-2 py-1 inline-flex text-xs font-medium rounded-full ${
                              ticket.status === "active"
                                  ? "bg-green-100 text-green-800"
                                  : "bg-red-100 text-red-800"
                          }">
                            ${
                                ticket.status.charAt(0).toUpperCase() +
                                ticket.status.slice(1)
                            }
                          </span>
                        </td>
                        <td class="px-6 py-4 text-center border-b border-gray-200 flex justify-center gap-2">
                          <button class="edit-ticket bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md transform transition-transform hover:scale-105" data-id="${
                              ticket.id
                          }">Edit</button>
                          <button class="delete-ticket bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md transform transition-transform hover:scale-105" data-id="${
                              ticket.id
                          }">Delete</button>
                        </td>
                      </tr>`;
                });

                html += `
                    </tbody>
                  </table>
                </div>`;
                $("#ticket-list").html(html);

                // Initialize DataTables
                $("#tickets-table").DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    columnDefs: [
                        { orderable: false, targets: 4 }, // Disable ordering for Actions column
                    ],
                    language: {
                        emptyTable: "No Tickets available.",
                    },
                });
            },
            error: function () {
                $("#ticket-list").html(
                    '<p class="text-red-500 p-4">Failed to load tickets. Please try again.</p>'
                );
            },
        });
    }

    // Initially load tickets
    loadTickets();

    // Show modal for creating a new ticket
    $("#create-ticket-btn").click(function () {
        $("#ticket-form")[0].reset();
        $("#ticket_id").val("");
        $("#ticket-modal")
            .removeClass("opacity-0 pointer-events-none")
            .addClass("opacity-100 pointer-events-auto");
    });

    // Close modal when clicking #close-modal or Cancel button
    $("#close-modal, #cancel-ticket-btn").click(function () {
        $("#ticket-modal")
            .removeClass("opacity-100 pointer-events-auto")
            .addClass("opacity-0 pointer-events-none");
    });

    $("#ticket-form").submit(function (e) {
        e.preventDefault();

        const ticketId = $("#ticket_id").val(); // Get the ticket ID (empty for new tickets)
        const formData = {
            tires_id: $("#tires_id").val(),
            status: $("#status").val(),
            quantity: $("#quantity").val() || 1, // Default to 1 if not provided
        };

        if (ticketId === "") {
            // Bulk creation or single creation
            $.ajax({
                url: "/admin/tickets",
                method: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#ticket-modal")
                        .removeClass("opacity-100 pointer-events-auto")
                        .addClass("opacity-0 pointer-events-none");
                    loadTickets(); // Refresh ticket list
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        for (let field in errors) {
                            alert(errors[field][0]);
                        }
                    } else {
                        alert("Error creating tickets.");
                    }
                },
            });
        } else {
            // Update existing ticket
            $.ajax({
                url: `/admin/tickets/${ticketId}`,
                method: "PUT",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#ticket-modal")
                        .removeClass("opacity-100 pointer-events-auto")
                        .addClass("opacity-0 pointer-events-none");
                    loadTickets(); // Refresh ticket list
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        for (let field in errors) {
                            alert(errors[field][0]);
                        }
                    } else {
                        alert("Error updating ticket.");
                    }
                },
            });
        }
    });

    // Edit ticket functionality
    $(document).on("click", ".edit-ticket", function () {
        const ticketId = $(this).data("id");
        $.ajax({
            url: `/admin/tickets/${ticketId}`,
            method: "GET",
            dataType: "json",
            success: function (ticket) {
                $("#ticket_id").val(ticket.id);
                $("#tier").val(ticket.tier);
                $("#status").val(ticket.status);
                $("#ticket-modal")
                    .removeClass("opacity-0 pointer-events-none")
                    .addClass("opacity-100 pointer-events-auto");
            },
            error: function () {
                alert("Failed to fetch ticket details.");
            },
        });
    });

    // Delete ticket functionality
    $(document).on("click", ".delete-ticket", function () {
        if (!confirm("Are you sure you want to delete this ticket?")) return;
        const ticketId = $(this).data("id");
        $.ajax({
            url: `/admin/tickets/${ticketId}`,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                alert(response.message);
                loadTickets();
            },
            error: function () {
                alert("Error deleting ticket.");
            },
        });
    });
});
