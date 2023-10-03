<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MessageSendController extends Controller
{
    public function index($id){
        $member = Member::find($id);
        $msg = "Hello, ".$member->name . ", your balance is ".$member->balance .".";
        $msg .= "Please deposit your balance.";
        $send = messageSend($member->wa_number, $msg);
        

        return redirect()->back()->with('msg', 'Nofification Send Successfully');
    }
}
