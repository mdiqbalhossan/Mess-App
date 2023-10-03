<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->format('Y');
        // Fetch the top 5 members with the lowest balance for the current month and year
        $top5Members = Member::where('month', $currentMonth)
            ->where('year', $currentYear)
            ->where('balance', '<', 0)
            ->orderByRaw('CAST(balance AS DECIMAL(10,2)) ASC')
            ->take(5)
            ->get();
        // dd($top5Members);

        $top5Deposit = Deposit::with('member')
                        ->where('month', $currentMonth)
                        ->where('year', $currentYear)
                        ->orderByRaw('CAST(amount AS UNSIGNED) DESC')
                        ->take(5)
                        ->get();

        return view('backend.dashboard', compact('top5Members','top5Deposit'));
    }
}
