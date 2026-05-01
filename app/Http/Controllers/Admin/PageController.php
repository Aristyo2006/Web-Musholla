<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug',
            'content' => 'nullable|string',
        ]);

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil ditambahkan!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pages', 'public');
            return response()->json([
                'success' => true,
                'url' => \Illuminate\Support\Facades\Storage::url($path)
            ]);
        }
        return response()->json(['success' => false], 400);
    }
}
