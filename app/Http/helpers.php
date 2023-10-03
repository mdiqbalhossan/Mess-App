<?php

use App\Models\Meal;
use App\Models\Setting;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Revolution\Google\Sheets\Facades\Sheets;
use Twilio\Rest\Client;

function getData(){
    $token = getSetting('excel_id');
    $sheets = Sheets::spreadsheet($token)->sheet('ALL')->all();
    return $sheets;
}

function getCash(){
    $token = getSetting('excel_id');
    $sheets = Sheets::spreadsheet($token)->sheet('Cash')->all();
    return $sheets;
}

function getMealRate(){
    return getData()[1][2];
}

function getTotalBazar(){
    return getData()[4][51];
}

function getTotalMember(){
    return getData()[70][2];
}

function getTotalMeal(){
    return getData()[70][51];
}

function getTotalCost(){
    return getData()[70][17];
}

function getTotalDeposit(){
    return getData()[70][9];
}

function getTotalNegative(){
    return getCash()[3][3];
}

function getTotalCash(){
    return getCash()[9][1];
}

/**Single Total Cost */
function getSingleTotalCost($index){
    return getData()[$index][17];
}

/**Single Total Deposit */
function getSingleTotalDeposit($index){
    return getData()[$index][9];
}

/**Single Total Meal */
function getSingleTotalMeal($index){
    return getData()[$index][51];
}
/**Single Meal */
function getSingleMeal($index){
    $sheets = getData();
    $meal = [];
    for($i=6; $i<=count($sheets) - 5; $i++){
        $k = 1;
        for($j = 20; $j<51; $j++){
            $meal[$k] = $sheets[28][$j];
            $k++;
        }
        return $meal;
    }
    return getData()[$index][51];
}

function getImportData(){
    $sheets = getData();
    $data = [];
    for($i=6; $i<=count($sheets) - 5; $i++){
        if(empty($sheets[$i][1]) || empty($sheets[$i][2])){
            continue;
        }
        $data[$i]['room_no'] = $sheets[$i][1];
        $data[$i]['name'] = $sheets[$i][2];
        $data[$i]['balance'] = $sheets[$i][18];
        $data[$i]['deposit'] = $sheets[$i][9];
    }
    return $data;
}

function getSetting($key, $default = null)
{
    $setting = Setting::where('key', $key)->first();

    return $setting ? $setting->value : $default;
}

function setSetting($key, $value)
{
    $setting = Setting::updateOrInsert(
        ['key' => $key],
        ['value' => $value],
    );

    return $setting;
}

function sumData() {
    $args = func_get_args(); // Get all the function arguments as an array
    $sum = 0;

    foreach ($args as $arg) {
        if (is_numeric($arg)) {
            $sum += $arg;
        }
    }

    return $sum;
}

function countTotal($data){
    $b = 0;
    $l = 0;
    $d = 0;
    foreach ($data as $key => $value) {
        if($value->breakfast){
            $b+=$value->breakfast;
        }
        if($value->lunch){
            $l+=$value->lunch;
        }
        if($value->dinner){
            $d+=$value->dinner;
        }
    }

    return [
        'breakfast' => $b,
        'lunch' => $l,
        'dinner' => $d,
        'total' => sumData($b, $l, $d),
    ];
}

function extractMonthYear($dateString){
    $date = new DateTime($dateString);

    $monthName = $date->format('F'); // 'F' format specifier for full month name
    $year = $date->format('Y');      // 'Y' format specifier for four-digit year

    return [
        'year' => $year,
        'month' => $monthName,
    ];
}


/** Get Meal By Member */
function getMeal($member_id){

    $currentYear = date('Y'); // Get the current year
    $currentMonth = date('m');
    $meal = Meal::where('member_id', $member_id)
        ->whereYear('date', $currentYear)
        ->whereMonth('date', $currentMonth)
        ->get();

    return $meal;
}

function getMealByDate($date){
    $meal = Meal::where('member_id', Auth::guard('member')->user()->id)
            ->whereDate('date', $date)
            ->first();
    return $meal;
}

function messageSend($mobile = "", $msg = ""){
    $whatsapp_cloud_api = new WhatsAppCloudApi([
        'from_phone_number_id' => '115660364951746',
        'access_token' => 'EAANdPfw9nMYBO6Silfc0c3mf6ZCyCyp4XxnugIBSubu5DpX2w07KkZAnQWuqN7z21EgVxFrM9W44o9aasmfR4WTPE7I6ejcOETrWZC7a4VXnb8pss8aN1eC01cHdYNTKTZAIHw4QfNCn2s6g4K6MPYHzjlnKLmRlT0YfqivhcSAln0ROia9YQAyTar7pYktLoMwTyPXRLHQsOgJIMg5ZBFh2H8ZCjHFxpaYqAZD',
    ]);

    $whatsapp_cloud_api->sendTextMessage('8801580358565', 'Hey there! I\'m using WhatsApp Cloud API. Visit https://www.netflie.es');
}

function notice()
{
    $notices = \App\Models\Notice::where('status', 1)->latest()->get();

    return $notices;
}
?>
