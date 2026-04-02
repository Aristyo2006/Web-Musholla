<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::latest()->get();
        $totalDonation = Donation::where('status', 'confirmed')->sum('amount');
        return view('admin.donations.index', compact('donations', 'totalDonation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donator_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        Donation::create($validated);

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dicatat!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        $donation->update($validated);

        return redirect()->route('admin.donations.index')->with('success', 'Status donasi diperbarui!');
    }

    /**
     * Approve and send invoice.
     */
    public function approve(Donation $donation)
    {
        if ($donation->status === 'confirmed') {
            return back()->with('error', 'Donasi sudah pernah di-approve.');
        }

        $donation->update(['status' => 'confirmed']);

        if ($donation->email) {
            try {
                \Illuminate\Support\Facades\Mail::to($donation->email)->send(new \App\Mail\DonationApprovedMail($donation));
            } catch (\Exception $e) {
                // Biarkan lolos jika email gagal (misal koneksi terputus), 
                // tapi catat di log. Approve tetap sukses.
                \Illuminate\Support\Facades\Log::error("Gagal kirim email invoice: " . $e->getMessage());
                return back()->with('success', 'Donasi di-approve, namun pengiriman email invoice gagal (cek log).');
            }
        }

        return back()->with('success', 'Donasi berhasil di-approve dan Invoice terkirim bila email tersedia!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Catatan donasi dihapus!');
    }
}
