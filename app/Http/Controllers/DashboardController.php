<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total residents
        $totalResidents = Resident::count();
        
        // Get gender statistics
        $maleCount = Resident::where('gender', 'male')->count();
        $femaleCount = Resident::where('gender', 'female')->count();
        
        // Get new residents this month
        $newResidentsThisMonth = Resident::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Get monthly data for the chart (last 12 months)
        $monthlyData = [];
        $monthlyLabels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyLabels[] = $date->locale('id')->translatedFormat('M Y');
            
            $count = Resident::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $monthlyData[] = $count;
        }
        
        // Calculate percentage change
        $lastMonthCount = Resident::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
            
        $currentMonthCount = Resident::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $percentageChange = $lastMonthCount > 0 
            ? round((($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 1)
            : 0;
        
        // Get recent activities
        $recentActivities = Resident::withTrashed()
            ->latest('updated_at')
            ->take(5)
            ->get()
            ->map(function($resident) {
                return [
                    'type' => $resident->deleted_at ? 'deleted' : ($resident->wasRecentlyCreated ? 'created' : 'updated'),
                    'name' => $resident->name,
                    'time' => $resident->updated_at->diffForHumans(),
                    'date' => $resident->updated_at->format('d M Y H:i')
                ];
            });
        
        return view('pages.dashboard', compact(
            'totalResidents',
            'maleCount',
            'femaleCount',
            'newResidentsThisMonth',
            'monthlyData',
            'monthlyLabels',
            'percentageChange',
            'recentActivities'
        ));
    }
}
