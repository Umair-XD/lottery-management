<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();

        if ($request->ajax()) {
            return response()->json($products);
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * API call for front-end carousel or widget.
     */
    public function apicall()
    {
        $products = Product::where('draw_date', '>', now())
            ->orderBy('draw_date', 'asc')
            ->get([
                'id',
                'name',
                'price',
                'duration_phrase',
                'prize_amount',
                'bg_color',
                'image_url',
                'draw_date',
            ])
            ->map(function ($p) {
                return [
                    'id'              => $p->id,
                    'name'            => $p->name,
                    'image_url'       => $p->image_url,
                    'duration_phrase' => $p->duration_phrase,
                    'bg_color'        => $p->bg_color,
                    'prize_amount'    => $p->prize_amount,
                    'price'           => $p->price,
                    'draw_date'       => Carbon::parse($p->draw_date)->toIso8601String(),
                ];
            });

        return response()->json($products);
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|unique:products,name|max:255',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'duration_phrase' => 'nullable|string|max:255',
            'price'           => 'required|integer|min:0',
            'draw_date'       => 'nullable|date',
            'prize_amount'    => 'nullable|integer|min:0',
            'bg_color'        => ['required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
        ]);

        if ($file = $request->file('image')) {
            $path = $file->store('products', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $product = Product::create($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product created successfully.',
                'product' => $product,
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'            => 'required|string|unique:products,name,' . $product->id . '|max:255',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'duration_phrase' => 'nullable|string|max:255',
            'price'           => 'required|integer|min:0',
            'draw_date'       => 'nullable|date',
            'prize_amount'    => 'nullable|integer|min:0',
            'bg_color'        => ['required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
        ]);

        if ($file = $request->file('image')) {
            // delete old
            if ($product->image_url) {
                $old = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($old);
            }
            $path = $file->store('products', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $product->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product updated successfully.',
                'product' => $product,
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        // optionally delete file
        if ($product->image_url) {
            $old = str_replace('/storage/', '', $product->image_url);
            Storage::disk('public')->delete($old);
        }

        $product->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Product deleted successfully.']);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
