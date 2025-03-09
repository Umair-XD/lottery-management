<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    /**
     * Create a new ticket.
     */
    public function createTicket(array $data): Ticket
    {
        $data['user_id'] = Auth::id();
        return Ticket::create($data);
    }

    /**
     * Update an existing ticket.
     */
    public function updateTicket(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    /**
     * Delete a ticket.
     */
    public function deleteTicket(Ticket $ticket): bool
    {
        return $ticket->delete();
    }

    /**
     * Retrieve all tickets.
     */
    public function getTickets()
    {
        return Ticket::all();
    }
}
