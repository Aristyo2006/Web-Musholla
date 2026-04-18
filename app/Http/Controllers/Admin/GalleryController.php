<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\CompressesImages;

class GalleryController extends Controller
{
    use CompressesImages;

    public function index()
    {
        $galleries = Gallery::orderBy('order')->latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $campaigns = Campaign::where('is_active', true)->get();
        return view('admin.galleries.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'campaign_id' => 'nullable|exists:campaigns,id'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->compressAndStore($file, 'galleries');
        }

        $validated['is_featured'] = $request->has('is_featured');

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        $campaigns = Campaign::where('is_active', true)->get();
        return view('admin.galleries.edit', compact('gallery', 'campaigns'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'campaign_id' => 'nullable|exists:campaigns,id'
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $this->compressAndStore($request->file('image'), 'galleries');
        }

        $validated['is_featured'] = $request->has('is_featured');

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
