<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return redirect()->route('login');
//        return view('welcome');
    }

    public function checkUserId(Request $request)
    {
        if (Auth::guard('member')->attempt($request->only(['u_id','password']), $request->get('remember'))){
            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully. Please Wait a Moment!!',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Wrong User Id. Please try again with valid user id!!',
            ]);
        }
    }

    public function meal(Request $request){
        $member_id = Auth::guard('member')->id();
        $meal = Meal::where('member_id', $member_id)->whereDate('date', $request->date)->first();
        if($meal !== null){
            if($request->mealType == "lunch"){
                $meal->update([
                    'lunch' => $request->value,
                ]);
            }

            if($request->mealType == "dinner"){
                $meal->update([
                    'dinner' => $request->value,
                ]);
            }

        }else{
            if($request->mealType == "lunch"){
                Meal::create([
                    'member_id' => $member_id,
                    'lunch' => $request->value,
                    'date' => $request->date,
                ]);
            }

            if($request->mealType == "dinner"){
                Meal::create([
                    'member_id' => $member_id,
                    'dinner' => $request->value,
                    'date' => $request->date,
                ]);
            }
        }



        return response()->json([
            'status' => 'success',
            'message' => 'Meal Updated Successfully!!',
        ]);
    }
}
