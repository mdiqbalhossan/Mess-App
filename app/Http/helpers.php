<?php

use App\Models\Meal;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
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
    return getData()[1][2] ?? 0;
}


function getTotalBazar(){
    return getData()[4][51] ?? 0;
}

function getTotalMember(){
    return getData()[70][2] ?? 0;
}

function getTotalMeal(){
    return getData()[70][51] ?? 0;
}

function getTotalCost(){
    return getData()[70][17] ?? 0;
}

function getTotalDeposit(){
    return getData()[70][9] ?? 0;
}

function getTotalNegative(){
    return getCash()[3][3] ?? 0;
}

function getTotalCash(){
    return getCash()[9][1] ?? 0;
}

/**Single Total Cost */
function getSingleTotalCost($index){
    return getData()[$index][17] ?? 0;
}

/**Single User Previous Meal */
function previousBalance($index){
    return getData()[$index][4] ?? 0;
}

/** Single User Adjust Balance */
function adjustBalance($index)
{
    return getData()[$index][10] ?? 0;
}

/**Single Meal Cost */
function singleMealCost($index){
    return getData()[$index][11] ?? 0;
}

/**Single Cooker Cost */
function singleCookerCost($index){
    return getData()[$index][12] ?? 0;
}

/**Single Dust Cost */
function singleDustCost($index)
{
    return getData()[$index][14] ?? 0;
}

/**Single Utility Cost */
function singleUtilityCost($index)
{
    return getData()[$index][15] ?? 0;
}

/**Single Other Cost */
function singleOtherCost($index)
{
    return getData()[$index][16] ?? 0;
}

/**Single Total Deposit */
function getSingleTotalDeposit($index){
    return getData()[$index][9] ?? 0;
}

/**Single Total Meal */
function getSingleTotalMeal($index){
    return getData()[$index][51] ?? 0;
}
/** Get Single Balance */
function getSingleBalance($index){
    return getData()[$index][18] ?? 0;
}

/** Number Format */
function amount($amount){
    $amoutWithoutcommas = str_replace(',', '', $amount);
    $floatValue = (float)$amoutWithoutcommas;
    return $floatValue;
}

/** After Total Meal  */

function balanceMeal($index){
    $numberWithoutCommas = str_replace(',', '', getSingleBalance($index));
    $integerValue = (int)$numberWithoutCommas;
    $meal = (int)($integerValue / getMealRate());
    return $meal;
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
        $data[$i]['index_value'] = $i;
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

function getNameToIndex($name){
    $index = null;
    $data = getImportData();
    foreach ($data as $key => $value) {
        if($value['name'] == $name){
            $index = $key;
            break;
        }
    }

    return $index;
}

function replaceTemplate($template, $id = null){
    if($id != null){
        $member = \App\Models\Member::find($id);
        $balance = amount($member->balance);
        $templates = config('sms.template');
        $temData = $templates[$template];
        $temData = str_replace('{taka}', $balance, $temData);

        return $temData;
    }

    return null;
}

function sms_send($num, $msg) {
    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = "c9nCew142yHM6rlp59Zf";
    $senderid = "8809617614290";
    $number = $num;
    $message = $msg;

    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>
