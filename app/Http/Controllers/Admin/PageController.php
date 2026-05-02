<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function editAboutUs()
    {
        $page = Page::firstOrCreate(
            ['slug' => 'tentang-kami'],
            [
                'title' => 'Tentang Kami',
                'content' => '<h2>Membangun Kebaikan Bersama</h2><p>Tuliskan deskripsi tentang musholla di sini menggunakan editor Quill.</p>',
            ]
        );

        return view('admin.pages.edit', compact('page'));
    }

    public function index()
    {
        // Auto-create Tentang Kami if missing (for fresh databases or accidental deletion)
        if (!Page::where('slug', 'tentang-kami')->exists()) {
            Page::create([
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<h2>Membangun Kebaikan Bersama</h2><p>Tuliskan deskripsi tentang musholla di sini menggunakan editor Quill.</p>',
            ]);
        }

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
