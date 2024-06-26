<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Utility;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function index()
    {
        $monthNameAndYear = date('F-Y');
        $utilities = Utility::where('month', $monthNameAndYear)->get();
        return view('backend.utility.index', compact('monthNameAndYear', 'utilities'));
    }

    public function generateBill(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'amount' => 'required',
        ]);

        $month = generateMonthAndYear($request->month);
        $amount = $request->amount;

        $members = Member::all();
        foreach ($members as $member) {
            $exists = Utility::where('member_id', $member->id)->where('month', $month)->first();
            if (!$exists) {
                $bill = new Utility();
                $bill->member_id = $member->id;
                $bill->month = $month;
                $bill->amount = $amount;
                $bill->save();
            }
        }

        return redirect()->back()->with('message', 'Bill generated successfully');
    }

    public function payBill($id)
    {
        $bill = Utility::find($id);
        $bill->status = 'paid';
        if ($bill->save()) {
            $contact_number = Member::find($bill->member_id)->contact_number;
            $tempData = "আপনার ইউটিলিটি বিল পরিশোধ হয়েছে। মাস: " . $bill->month . ", পরিশোধের পরিমান: " . $bill->amount . " টাকা। - আমানুল্লাহ হাউজ";
            $smsSend = sms_send($contact_number, $tempData);
            $smsSend = json_decode($smsSend, true);
            if ($smsSend['response_code'] == 202) {
                $type = 'message';
                $msg = 'SMS Send Successfully!';
            } else {
                $type = 'error';
                $msg = 'Something Went Wrong!';
            }
        }
        return redirect()->back()->with($type, $msg);
    }
}
