<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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
        $tickets = Ticket::all();

        if ($request->ajax()) {
            return response()->json($tickets);
        }

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $ticket = $this->ticketService->createTicket($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Ticket created successfully', 'ticket' => $ticket], 201);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ticket $ticket)
    {
        if ($request->ajax()) {
            return response()->json($ticket);
        }
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
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

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
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
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
