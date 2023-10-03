<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $query = Meal::query();
        if ($request->filled('date')) {
            $today = $request->input('date');
            $query->with('member')->whereDate('date', $today);
        }else{
            $today = Carbon::now()->toDateString();
            $query->with('member')->whereDate('date', $today);
        }

        // $today = Carbon::now()->toDateString();
        // $data = Meal::with('member')->whereDate('date', $today)->get();
        $data = $query->get();
        return view('backend.meal.index', compact('data','today'));
    }

    public function update(Request $request)
    {
        $meal = Meal::find($request->id);
        if($request->has('lunch')){
            $meal->lunch = $request->lunch;
        }
        if($request->has('dinner')){
            $meal->dinner = $request->dinner;
        }
        $meal->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Meal Updated Successfully!!'
        ]);
    }
}
