<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function post(Request $request){
        

        if($request->has('month_name')){
            setSetting('month_name', $request->month_name);
        }
        if($request->has('excel_id')){
            setSetting('excel_id', $request->excel_id);
        }
        if($request->has('manager_name')){
            setSetting('manager_name', $request->manager_name);
        }
        if($request->has('manager_room')){
            setSetting('manager_room', $request->manager_room);
        }
        if ($request->has('number')) {
            setSetting('number', $request->number);
        }
        if ($request->has('management_phone')) {
            setSetting('management_phone', $request->management_phone);
        }
        if ($request->has('default_adjust_utility_bill')) {
            setSetting('default_adjust_utility_bill', $request->default_adjust_utility_bill);
        }

        return redirect()->back()->with('message', 'Setting Updated Successfully!');
    }
}
