<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Tires;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TiresController extends Controller
{
    public function index(Request $request)
    {
        $tires = Tires::all();
        if ($request->ajax()) {
            return response()->json($tires);
        }
        return view('admin.tires.index', compact('tires'));
    }

    public function apicall()
    {
        // Fetch only future draws, order by soonest first
        $tires = Tires::where('draw_date', '>', now())
            ->orderBy('draw_date', 'asc')
            ->get([
                'id',
                'bg_color',
                'prize_amount',
                'multiplier',
                'price',
                'draw_date',
            ])
            ->map(function ($tire) {
                return [
                    'id'            => $tire->id,
                    'bg_color'      => $tire->bg_color,
                    'prize_amount'  => $tire->prize_amount,
                    'multiplier'    => $tire->multiplier,
                    'price'         => $tire->price,
                    // ISO string makes JavaScript Date happy
                    'draw_date'     => Carbon::parse($tire->draw_date)->toIso8601String(),
                ];
            });

        return response()->json($tires);
    }
    public function singleTicketapicall($id)
    {
        // Find the ticket by ID
        $tire = Tires::find($id, [
            'id',
            'bg_color',
            'prize_amount',
            'multiplier',
            'price',
            'draw_date',
        ]);

        if (!$tire) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticketData = [
            'id'            => $tire->id,
            'bg_color'      => $tire->bg_color,
            'prize_amount'  => $tire->prize_amount,
            'multiplier'    => $tire->multiplier,
            'price'         => $tire->price,
            'draw_date'     => Carbon::parse($tire->draw_date)->toIso8601String(),
        ];

        return response()->json($ticketData);
    }

    public function show(Tires $tire)
    {
        return response()->json($tire);
    }

    public function ticketShow($id)
    {
        $ticket = Tires::findOrFail($id);
        $tickets = Ticket::where('tires_id', $id)->where('status', 'active')->whereNull('user_id')->take(3)->get();

        return view('ticket.show', [
            'ticket'  => $ticket,
            'tickets' => $tickets,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|unique:tires,name|max:255',
            'price'         => 'required|integer|min:0',
            'draw_date'     => 'required|date',
            'prize_amount'  => 'required|integer|min:0',
            'multiplier'    => 'required|integer|min:1',
            'bg_color'      => ['required', 'string', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
        ]);

        $tire = Tires::create($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Ticket tier created successfully.',
                'tire'    => $tire,
            ]);
        }

        return redirect()
            ->route('admin.tires.index')
            ->with('success', 'Ticket tier created successfully.');
    }

    public function update(Request $request, Tires $tire)
    {
        $data = $request->validate([
            'name'          => 'required|string|unique:tires,name,' . $tire->id . '|max:255',
            'price'         => 'required|integer|min:0',
            'draw_date'     => 'required|date',
            'prize_amount'  => 'required|integer|min:0',
            'multiplier'    => 'required|integer|min:1',
            'bg_color'      => ['required', 'string', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
        ]);

        $tire->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Ticket tier updated successfully.',
                'tire'    => $tire,
            ]);
        }

        return redirect()
            ->route('admin.tires.index')
            ->with('success', 'Ticket tier updated successfully.');
    }

    public function destroy(Request $request, Tires $tire)
    {
        $tire->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Ticket tier deleted successfully.']);
        }

        return redirect()
            ->route('admin.tires.index')
            ->with('success', 'Ticket tier deleted successfully.');
    }
}
