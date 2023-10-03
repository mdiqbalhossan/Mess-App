<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard');
    }

    public function mealInfo()
    {
        return view('frontend.meal');
    }

}
