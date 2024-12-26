<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;


class DashboardController extends Controller
{
   public function developer()
    {

    $visitorData = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                          ->where('created_at', '>=', Carbon::now()->subDays(7))
                          ->groupBy('date')
                          ->orderBy('date', 'asc')
                          ->get();

    $dates = $visitorData->pluck('date')->toArray();
    $counts = $visitorData->pluck('count')->toArray();

    return view('dashboard.developer', compact('dates', 'counts'));
    }

    public function user()
    {
    
        return view('dashboard.user');
    }
}
