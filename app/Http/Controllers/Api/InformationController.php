<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function alluser()
    {
        return response()->json(getImportData());
    }

    public function details($user){
        $index = getNameToIndex($user);
        $data = [
            'meal_rate' => amount(getMealRate()),
            'previous_balance' => amount(previousBalance($index)),
            'adjust_balance' => amount(adjustBalance($index)),
            'total_deposit' => amount(getSingleTotalDeposit($index)),
            'meal_cost' => amount(singleMealCost($index)),
            'cooker_cost' => amount(singleCookerCost($index)),
            'dust_cost' => amount(singleDustCost($index)),
            'utility_cost' => amount(singleUtilityCost($index)),
            'others_cost' => amount(singleOtherCost($index)),
            'total_cost' => amount(getSingleTotalCost($index)),
            'total_meal' => amount(getSingleTotalMeal($index)),
            'balance' => amount(getSingleBalance($index)),
        ];

        return response()->json($data, 200);
    }

    public function mealDetails($user){
        $index = getNameToIndex($user);
        $meal = getSingleMeal($index);

        return response()->json($meal);
    }

    public function info()
    {
        $data = [
            'month' => getSetting('month_name'),
            'year' => date('Y'),
            'manager_name' => getSetting('manager_name'),
            'manager_room' => getSetting('manager_room'),
            'number' => getSetting('number'),
        ];

        return response()->json($data);
    }
}
