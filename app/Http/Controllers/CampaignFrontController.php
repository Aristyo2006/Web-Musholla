<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignFrontController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount(['donations' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->withSum(['donations' => function ($query) {
                $query->where('status', 'confirmed');
            }], 'amount')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('campaigns.index', compact('campaigns'));
    }
}
