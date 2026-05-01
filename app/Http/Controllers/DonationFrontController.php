<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Traits\CompressesImages;
use App\Mail\DonationPendingMail;
use App\Mail\DonationAdminNotificationMail;

class DonationFrontController extends Controller
{
    use CompressesImages;
    public function index(\App\Models\Campaign $campaign)
    {
        $campaign->load('galleries');
        return view('donasi', compact('campaign'));
    }

    public function uploadManual(Request $request, \App\Models\Campaign $campaign)
    {
        $rules = [
            'amount' => 'required|numeric|min:10000',
            'proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];

        if ($campaign->show_name) $rules['donator_name'] = 'nullable|string|max:255';
        if ($campaign->show_email) $rules['email'] = 'nullable|email|max:255';
        if ($campaign->show_address) $rules['donator_address'] = 'nullable|string|max:500';
        if ($campaign->show_message) $rules['notes'] = 'nullable|string|max:1000';

        $request->validate($rules);

        $path = $this->compressAndStore($request->file('proof'), 'donations');

        $orderId = 'DONASI-' . uniqid() . '-' . time();

        // Anonymous logic
        $donatorName = $request->donator_name;
        if (!$campaign->show_name || empty($donatorName)) {
            $donatorName = 'Anonim';
        }

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'campaign_id' => $campaign->id,
            'donator_name' => $donatorName,
            'email' => $request->email,
            'donator_address' => $request->donator_address,
            'amount' => $request->amount,
            'status' => 'pending',
            'order_id' => $orderId,
            'payment_type' => 'manual',
            'proof_path' => $path,
            'notes' => $request->notes ?? ('Donasi: ' . $campaign->title),
        ]);

        // Send emails (non-blocking)
        try {
            // A: Email pending ke donatur (jika email tersedia)
            if ($donation->email) {
                Mail::to($donation->email)->send(new DonationPendingMail($donation));
            }

            // B: Notifikasi ke admin
            $adminEmail = config('mail.from.address', 'admin@yysalkautsar.or.id');
            Mail::to($adminEmail)->send(new DonationAdminNotificationMail($donation));

        } catch (\Exception $e) {
            Log::error('Gagal kirim email donasi pending: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Bukti donasi berhasil diunggah. Menunggu verifikasi admin.'
        ]);
    }
}
