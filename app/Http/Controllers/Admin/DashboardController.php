<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasAdminAccess()) {
            // ===== ADMIN DATA =====
            $totalConfirmedAmount = Donation::where('status', 'confirmed')->sum('amount');
            $pendingDonationsCount = Donation::where('status', 'pending')->count();
            $totalCampaigns = Campaign::count();
            $totalDonors = Donation::where('status', 'confirmed')->distinct('user_id')->count('user_id');
            if ($totalDonors == 0) {
                $totalDonors = Donation::where('status', 'confirmed')->distinct('donator_name')->count('donator_name');
            }

            $days = 30;
            $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
            
            $donations = Donation::where('status', 'confirmed')
                ->where('created_at', '>=', $startDate)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
                ->groupBy('date')->orderBy('date', 'ASC')->get()
                ->pluck('total', 'date')->toArray();

            $chartLabels = [];
            $chartData = [];
            for ($i = 0; $i < $days; $i++) {
                $date = $startDate->copy()->addDays($i)->format('Y-m-d');
                $displayDate = $startDate->copy()->addDays($i)->format('d M');
                $chartLabels[] = $displayDate;
                $chartData[] = $donations[$date] ?? 0;
            }

            return view('dashboard', compact(
                'totalConfirmedAmount', 'pendingDonationsCount',
                'totalCampaigns', 'totalDonors', 'chartLabels', 'chartData'
            ));
        }

        // ===== DONOR / USER BIASA DATA =====
        $days = 30;
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $userDonations = Donation::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
            ->groupBy('date')->orderBy('date', 'ASC')->get()
            ->pluck('total', 'date')->toArray();

        $userChartLabels = [];
        $userChartData = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $displayDate = $startDate->copy()->addDays($i)->format('d M');
            $userChartLabels[] = $displayDate;
            $userChartData[] = $userDonations[$date] ?? 0;
        }

        $totalPersonalAmount = Donation::where('user_id', $user->id)->where('status', 'confirmed')->sum('amount');
        $pendingPersonal = Donation::where('user_id', $user->id)->where('status', 'pending')->count();
        $totalPersonalCount = Donation::where('user_id', $user->id)->where('status', 'confirmed')->count();

        $donationHistory = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest()
            ->paginate(8);

        return view('dashboard', compact(
            'totalPersonalAmount', 'pendingPersonal', 'totalPersonalCount',
            'userChartLabels', 'userChartData', 'donationHistory'
        ));
    }
}
