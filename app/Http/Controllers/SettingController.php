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

        return redirect()->back()->with('message', 'Setting Updated Successfully!');
    }
}
