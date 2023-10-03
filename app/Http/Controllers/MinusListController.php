<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MinusListController extends Controller
{
    public function index()
    {
        $minusLists = Member::where('balance', '<', 0)->get();
        return view('backend.minuslist.index', compact('minusLists'));
    }
}
