<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MinusListController extends Controller
{
    public function index()
    {
        $balancesMinus = [];
        $data = Member::all();
        foreach ($data as $key => $value) {
            if (amount($value->balance) < 0) {
                $balancesMinus[$value->id] = $value;
            }
        }
        return view('backend.minuslist.index', compact('balancesMinus'));
    }

    public function warning()
    {
        $balancesWarning = [];
        $data = Member::all();
        foreach ($data as $key => $value) {
            $amount = amount($value->balance);
            if ($amount > 0 && $amount <= 300) {
                $balancesWarning[$value->id] = $value;
            }
        }
        return view('backend.minuslist.warning', compact('balancesWarning'));
    }
}
