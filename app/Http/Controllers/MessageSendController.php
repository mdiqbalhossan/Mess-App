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

    public function send(Request $request){
        $id = $request->id ?? null;
        $contact_number = $request->contact_number;
        $template = $request->template;
        $templates = config('sms.template');
        $tempData =$templates['instructions'];
        if ($template != 'instructions'){
            $tempData = replaceTemplate($template, $id);
        }


        $smsSend = sms_send($contact_number, $tempData);
        $smsSend = json_decode($smsSend, true);
        if($smsSend['response_code'] == 202){
            $type='message';
            $msg = 'SMS Send Successfully!';
        }else{
            $type='error';
            $msg = 'Something Went Wrong!';
        }
        return redirect()->back()->with($type, $msg);
    }
}
