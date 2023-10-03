<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::with(['member','user'])->get();
        return view('backend.manager.index', compact('managers'));
    }

    public function create()
    {
        $member = Member::all();
        return view('backend.manager.create', compact('member'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'member_id' => 'required',
            'name' => 'required',
            'month' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);

        $monthName = extractMonthYear($request->month)['month'];
        $year = extractMonthYear($request->month)['year'];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Manager::create([
            'member_id' => $request->member_id,
            'user_id' => $user->id,
            'month' => $monthName,
            'year' => $year,
            'cash' => $request->cash,
        ]);

        return redirect()->route('manager.index')->with('message','Manager Added Successfully!!');
    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function delete(Request $request, $id){
        $manager = Manager::find($id);
        $manager->delete();
        $user = User::find($manager->user_id);
        $user->delete();
        return redirect()->back()->with('message', 'Manager deleted successfully!!');
    }   
}
