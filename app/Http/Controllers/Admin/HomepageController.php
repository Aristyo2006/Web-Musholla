<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.homepage.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = ['hero_title', 'hero_subtitle', 'about_title', 'about_content'];
        
        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->$key]);
            }
        }

        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('homepage', 'public');
            
            // Delete old image if exists
            $oldImage = Setting::getByKey('about_image');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            Setting::updateOrCreate(['key' => 'about_image'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Konten Homepage berhasil diperbarui!');
    }
}
