<?php

namespace App\Http\Controllers;

use App\Models\Tires;
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

    // Unused methods can remain empty for now.
    public function create() { /* Not in use */ }
    public function show(Tires $tires) { /* Not in use */ }
    public function edit(Tires $tires) { /* Not in use */ }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|unique:tires,name|max:255',
            'price'     => 'required|integer|min:0',
            'draw_date' => 'required|date'
        ]);

        $tire = Tires::create($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Ticket tier created successfully.',
                'tire'    => $tire,
            ]);
        }

        return redirect()->route('admin.tires.index')
            ->with('success', 'Ticket tier created successfully.');
    }

    public function update(Request $request, Tires $tires)
    {
        $data = $request->validate([
            'name'      => 'required|string|unique:tires,name|max:255',
            'price'     => 'required|integer|min:0',
            'draw_date' => 'required|date'
        ]);

        $tires->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Ticket tier updated successfully.',
                'tire'    => $tires,
            ]);
        }

        return redirect()->route('admin.tires.index')
            ->with('success', 'Ticket tier updated successfully.');
    }

    public function destroy(Tires $tires, Request $request)
    {
        $tires->delete();
        if ($request->ajax()) {
            return response()->json(['message' => 'Ticket tier deleted successfully.']);
        }
        return redirect()->route('admin.tires.index')
            ->with('success', 'Ticket tier deleted successfully.');
    }
}
