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
        $users = Member::all();
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
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->update([
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
            $member = Member::where('index', $key)->where('room_no', $value['room_no'])->first();
            if($member){
                $member->update([
                    'balance' => $value['balance'],
                    'index' => $key,
                ]);
            }else{
                $member = Member::create([
                    'room_no' => $value['room_no'],
                    'name' => $value['name'],
                    'balance' => $value['balance'],
                    'index' => $key,
                ]);
            }
        }


         return redirect()->back()->with('message', 'Data Import Successfully');
    }
}
