<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect admin ke dashboard admin
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

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

        return view('donor.dashboard', compact(
            'totalPersonalAmount', 'pendingPersonal', 'totalPersonalCount',
            'userChartLabels', 'userChartData', 'donationHistory'
        ));
    }
}
