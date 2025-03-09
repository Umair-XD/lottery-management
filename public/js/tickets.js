$(document).ready(function () {
    // Function to load tickets dynamically
    function loadTickets() {
        $.ajax({
            url: "/tickets",
            method: "GET",
            dataType: "json",
            success: function (data) {
                let html =
                    '<table class="table"><thead><tr><th>ID</th><th>Tier</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
                $.each(data, function (index, ticket) {
                    html += "<tr>";
                    html += "<td>" + ticket.id + "</td>";
                    html += "<td>" + ticket.tier + "</td>";
                    html += "<td>" + ticket.price + "</td>";
                    html += "<td>" + ticket.status + "</td>";
                    html += "<td>";
                    html +=
                        '<button class="btn btn-sm btn-warning edit-ticket" data-id="' +
                        ticket.id +
                        '">Edit</button> ';
                    html +=
                        '<button class="btn btn-sm btn-danger delete-ticket" data-id="' +
                        ticket.id +
                        '">Delete</button>';
                    html += "</td>";
                    html += "</tr>";
                });
                html += "</tbody></table>";
                $("#ticket-list").html(html);
            },
        });
    }

    // Initially load tickets
    loadTickets();

    // Show modal for creating new ticket
    $("#create-ticket-btn").click(function () {
        $("#ticket-form")[0].reset();
        $("#ticket_id").val("");
        $("#ticket-modal").show();
    });

    // Cancel modal
    $("#cancel-ticket-btn").click(function () {
        $("#ticket-modal").hide();
    });

    // Submit form for create/update
    $("#ticket-form").submit(function (e) {
        e.preventDefault();
        const ticketId = $("#ticket_id").val();
        const formData = {
            tier: $("#tier").val(),
            price: $("#price").val(),
            status: $("#status").val(),
        };

        if (ticketId === "") {
            // Create ticket
            $.ajax({
                url: "/tickets",
                method: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#ticket-modal").hide();
                    loadTickets();
                },
                error: function (response) {
                    alert("Error creating ticket.");
                },
            });
        } else {
            // Update ticket
            $.ajax({
                url: "/tickets/" + ticketId,
                method: "PUT",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert(response.message);
                    $("#ticket-modal").hide();
                    loadTickets();
                },
                error: function (response) {
                    alert("Error updating ticket.");
                },
            });
        }
    });

    // Edit ticket
    $(document).on("click", ".edit-ticket", function () {
        const ticketId = $(this).data("id");
        $.ajax({
            url: "/tickets/" + ticketId,
            method: "GET",
            dataType: "json",
            success: function (ticket) {
                $("#ticket_id").val(ticket.id);
                $("#tier").val(ticket.tier);
                $("#price").val(ticket.price);
                $("#status").val(ticket.status);
                $("#ticket-modal").show();
            },
            error: function () {
                alert("Failed to fetch ticket details.");
            },
        });
    });

    // Delete ticket
    $(document).on("click", ".delete-ticket", function () {
        if (!confirm("Are you sure you want to delete this ticket?")) return;
        const ticketId = $(this).data("id");
        $.ajax({
            url: "/tickets/" + ticketId,
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
