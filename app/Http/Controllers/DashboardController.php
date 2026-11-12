<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $isAdmin = $user->role === 'admin';

        $baseQuery = Complaint::query();

        if (!$isAdmin) {
            $baseQuery->where('user_id', $user->id);
        }

        $total = (clone $baseQuery)->count();

        $pending = (clone $baseQuery)
            ->where('status', 'Pending')
            ->count();

        $approved = (clone $baseQuery)
            ->where('status', 'Approved')
            ->count();

        $rejected = (clone $baseQuery)
            ->where('status', 'Rejected')
            ->count();

        $complaints = (clone $baseQuery)
            ->with('user')
            ->latest()
            ->take(7)
            ->get();

        // Data grafik pengaduan selama enam bulan terakhir.
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonths($i);

            $chartLabels[] = $date->translatedFormat('M Y');

            $chartData[] = (clone $baseQuery)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return view('dashboard', compact(
            'total',
            'pending',
            'approved',
            'rejected',
            'complaints',
            'chartLabels',
            'chartData',
            'isAdmin'
        ));
    }
}
