<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DonationExport;
use App\Models\Gallery;
use App\Traits\CompressesImages;

class CampaignController extends Controller
{
    use CompressesImages;

    public function index()
    {
        $campaigns = Campaign::withCount('donations')
            ->withSum('donations', 'amount')
            ->latest()
            ->get();
            
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . time();
        $validated['is_active'] = $request->has('is_active');
        $validated['show_name'] = $request->has('show_name');
        $validated['show_email'] = $request->has('show_email');
        $validated['show_message'] = $request->has('show_message');
        $validated['show_address'] = $request->has('show_address');
        $validated['show_name'] = $request->has('show_name');
        $validated['show_email'] = $request->has('show_email');
        $validated['show_message'] = $request->has('show_message');
        $validated['show_address'] = $request->has('show_address');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->compressAndStore($request->file('image'), 'campaigns');
        }

        $campaign = Campaign::create($validated);

        // Handle multi-image documentation
        if ($request->hasFile('documentation_images')) {
            foreach ($request->file('documentation_images') as $file) {
                $path = $this->compressAndStore($file, 'galleries');

                Gallery::create([
                    'campaign_id' => $campaign->id,
                    'image' => $path,
                    'title' => 'Dokumentasi: ' . $campaign->title,
                    'description' => $campaign->description,
                    'badge' => 'PROGRES',
                    'is_featured' => false,
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Program Donasi berhasil dibuat.');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['show_name'] = $request->has('show_name');
        $validated['show_email'] = $request->has('show_email');
        $validated['show_message'] = $request->has('show_message');
        $validated['show_address'] = $request->has('show_address');

        if ($request->title !== $campaign->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = $this->compressAndStore($request->file('image'), 'campaigns');
        }

        $campaign->update($validated);

        // Handle multi-image documentation
        if ($request->hasFile('documentation_images')) {
            foreach ($request->file('documentation_images') as $file) {
                $path = $this->compressAndStore($file, 'galleries');

                Gallery::create([
                    'campaign_id' => $campaign->id,
                    'image' => $path,
                    'title' => 'Dokumentasi: ' . $campaign->title,
                    'description' => $campaign->description,
                    'badge' => 'PROGRES',
                    'is_featured' => false,
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Program Donasi berhasil diperbarui.');
    }

    public function show(Campaign $campaign)
    {
        $donations = $campaign->donations()
            ->where('status', 'confirmed')
            ->oldest() // For chart order
            ->get();

        // Prepare chart data (Cumulative Sum)
        $chartData = [];
        $runningTotal = 0;
        
        foreach ($donations as $donation) {
            $runningTotal += $donation->amount;
            $chartData[] = [
                't' => $donation->updated_at->format('Y-m-d H:i'),
                'y' => $runningTotal
            ];
        }

        $donationsLatest = $campaign->donations()
            ->where('status', 'confirmed')
            ->latest()
            ->paginate(10);

        return view('admin.campaigns.show', compact('campaign', 'donations', 'chartData', 'donationsLatest'));
    }

    public function export(Campaign $campaign)
    {
        $fileName = 'donatur_' . Str::slug($campaign->title) . '_' . date('Y-m-d') . '.xlsx';
        
        return Excel::download(new DonationExport($campaign), $fileName);
    }

    public function getDonators(Campaign $campaign)
    {
        $donations = $campaign->donations()
            ->where('status', 'confirmed')
            ->latest()
            ->get()
            ->map(function($donation) {
                return [
                    'name' => $donation->donator_name,
                    'amount' => 'Rp ' . number_format($donation->amount, 0, ',', '.'),
                    'date' => $donation->updated_at->format('d M Y H:i'),
                    'notes' => $donation->notes ?? '-'
                ];
            });

        return response()->json([
            'title' => $campaign->title,
            'donators' => $donations,
            'total_amount' => 'Rp ' . number_format($campaign->donations()->where('status', 'confirmed')->sum('amount'), 0, ',', '.'),
            'count' => $donations->count()
        ]);
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }
        $campaign->delete();

        return back()->with('success', 'Program Donasi berhasil dihapus.');
    }
}
