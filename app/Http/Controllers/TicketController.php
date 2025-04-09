<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Tires;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    protected TicketService $ticketService;
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with('tire')->get();
        $tires = Tires::all();

        if ($request->ajax()) {
            return response()->json($tickets);
        }

        return view('admin.tickets.index', compact('tickets', 'tires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tires_id' => 'required|exists:tires,id',
            'quantity' => 'required|integer|min:1',
            'status'   => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tire = \App\Models\Tires::findOrFail($request->tires_id);
        $quantity = $request->input('quantity');
        $createdTickets = [];

        // Get the current maximum ticket number for the tire
        $latestTicket = \App\Models\Ticket::whereHas('tire', function ($query) use ($tire) {
            $query->where('name', $tire->name);
        })->latest('id')->first();

        // Start the ticket number based on the latest one
        $currentNumber = $latestTicket ? intval(substr($latestTicket->ticket_number, 3)) : 0;

        for ($i = 0; $i < $quantity; $i++) {
            $currentNumber++; // Increment the ticket number

            // Generate a unique ticket number
            $ticketNumber = strtoupper(substr($tire->name, 0, 3)) . str_pad($currentNumber, 5, '0', STR_PAD_LEFT);

            $ticket = \App\Models\Ticket::create([
                'tires_id'      => $request->tires_id,
                'status'        => $request->status,
                'ticket_number' => $ticketNumber,
            ]);

            $createdTickets[] = $ticket;
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Tickets created successfully.',
                'tickets' => $createdTickets
            ], 201);
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Tickets created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'tier'   => 'required|in:gold,platinum,diamond',
            'price'  => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ticket = $this->ticketService->updateTicket($ticket, $request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Ticket updated successfully', 'ticket' => $ticket]);
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ticket $ticket)
    {
        $this->ticketService->deleteTicket($ticket);
        if ($request->ajax()) {
            return response()->json(['message' => 'Ticket deleted successfully']);
        }
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
