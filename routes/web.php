<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MessageSendController;
use App\Http\Controllers\MinusListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function (){
    // Clear the application cache
    Artisan::call('cache:clear');

    // Clear the route cache
    Artisan::call('route:clear');

    // Clear the configuration cache
    Artisan::call('config:clear');

    // Clear the view cache
    Artisan::call('view:clear');
});


// use Revolution\Google\Sheets\Sheets as SheetsSheets;

// Route::redirect('/', '/dashboard');
Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::post('/user-id', 'checkUserId')->name('check.userid');
    Route::post('/meal/save', 'meal')->name('save.meal');
});

Route::controller(UserDashboardController::class)->prefix('user')->group(function(){
    Route::get('/dashboard', 'index')->name('user.dashboard');
    Route::get('/meal-info','mealInfo')->name('meal.info');
});


Route::get('/test', function() {
    echo "<pre>";
    print_r(getSingleMeal(28));

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // Member Controller
    Route::resource('member', MemberController::class);
    Route::get('members/import', [MemberController::class, 'import'])->name('member.import');
    // Deposit Controller
    Route::controller(DepositController::class)->group(function () {
        Route::get('/deposit', 'index')->name('deposit');
    });
    // MinusListController
    Route::controller(MinusListController::class)->group(function(){
        Route::get('/minuslist', 'index')->name('minuslist');
    });

    // Message Send Controller
    Route::controller(MessageSendController::class)->group(function(){
        Route::get('/messagesend/{id}', 'index')->name('messagesend');
    });

    // Setting Controller
    Route::controller(SettingController::class)->middleware('is_admin')->group(function(){
        Route::get('/setting', 'index')->name('setting.index');
        Route::post('/setting', 'post')->name('setting.post');
    });

    // Meal Controller
    Route::controller(MealController::class)->group(function(){
        Route::get('/meal', 'index')->name('meal.index');
        Route::post('/meal', 'update')->name('meal.update');
    });

    // Manager Controller
    Route::controller(ManagerController::class)->middleware('is_admin')->group(function(){
        Route::get('/manager', 'index')->name('manager.index');
        Route::get('/manager/create', 'create')->name('manager.create');
        Route::post('/manager/create', 'store')->name('manager.store');
        Route::get('/manager/{id}/edit', 'edit')->name('manager.edit');
        Route::post('/manager/{id}/edit', 'update')->name('manager.update');
        Route::post('/manager/{id}/delete', 'delete')->name('manager.delete');
    });

//   Notice Contrroller
    Route::resource('notice', \App\Http\Controllers\NoticeController::class);


});


require __DIR__.'/auth.php';
