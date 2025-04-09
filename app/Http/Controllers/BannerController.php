<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('banner_image')->store('uploads/banners', 'public');

        Banner::create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner uploaded successfully!');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            Storage::disk('public')->delete($banner->image_path);

            $imagePath = $request->file('banner_image')->store('uploads/banners', 'public');
            $banner->image_path = $imagePath;
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        Storage::disk('public')->delete($banner->image_path);

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }
}
