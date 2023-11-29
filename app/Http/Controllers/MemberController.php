<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = ucfirst(getSetting('month_name'));
        $users = Member::orderBy('room_no', 'desc')
                ->where('month', $month)
                ->where('year', date('Y'))
                ->get();
        return view('backend.member.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_no' => 'required',
            'name' => 'required',
        ]);

        Member::create([
            'room_no' => $request->room_no,
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'wa_number' => $request->wa_number,
        ]);

        return redirect()->route('member.index')->with('message', 'Data Save Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('backend.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'room_no' => 'required',
            'name' => 'required',
        ]);

        $member->update([
            'room_no' => $request->room_no,
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'wa_number' => $request->wa_number,
        ]);

        return redirect()->route('member.index')->with('message', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('message', 'Data Delete Successfully');
    }

    public function import(){
        $data = getImportData();
        foreach ($data as $key => $value) {
            $member = Member::where('room_no', $value['room_no'])->where('name', $value['name'])->first();
            if($member){
                $member->update([
                    'balance' => $value['balance'],
                    'month' => date("F"),
                    'year' => date("Y"),
                    'index' => $key,
                ]);
            }else{
                $u_id = $value['room_no'].rand(10,99);
                $member = Member::create([
                    'room_no' => $value['room_no'],
                    'name' => $value['name'],
                    'balance' => $value['balance'],
                    'month' => date("F"),
                    'year' => date("Y"),
                    'index' => $key,
                ]);
            }

            $deposit = Deposit::where('member_id', $member->id)->first();
            if($deposit){
                $deposit->update([
                    'amount' => $value['deposit'],
                    'month' => date("F"),
                    'year' => date("Y"),
                ]);
            }else{
                $deposit = Deposit::create([
                    'member_id' => $member->id,
                    'amount' => $value['deposit'],
                    'month' => date("F"),
                    'year' => date("Y"),
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data Sync Successfully. Latest Data Reflected in your system.'
        ]);

        // return redirect()->back()->with('message', 'Data Import Successfully');
    }
}
