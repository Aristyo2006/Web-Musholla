<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DonationFrontController extends Controller
{
    public function index(\App\Models\Campaign $campaign)
    {
        return view('donasi', compact('campaign'));
    }

    public function uploadManual(Request $request, \App\Models\Campaign $campaign)
    {
        $request->validate([
            'donator_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1000',
            'proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $file = $request->file('proof');
        $extension = $file->extension() ?: 'jpg';
        $filename = uniqid('manual_', true) . '.' . $extension;
        $path = $file->storeAs('donations', $filename, 'public');

        $orderId = 'DONASI-' . uniqid() . '-' . time();

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'campaign_id' => $campaign->id,
            'donator_name' => $request->donator_name,
            'email' => $request->email,
            'amount' => $request->amount,
            'status' => 'pending',
            'order_id' => $orderId,
            'payment_type' => 'manual',
            'proof_path' => $path,
            'notes' => 'Transfer Manual: ' . $campaign->title,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti donasi berhasil diunggah. Menunggu verifikasi admin.'
        ]);
    }
}
