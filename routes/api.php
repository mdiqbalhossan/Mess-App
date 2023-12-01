<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InformationController;



Route::get('users', [InformationController::class, 'alluser']);
Route::get('/details/{user}', [InformationController::class, 'details']);
Route::get('/meal/{user}', [InformationController::class, 'mealDetails']);
Route::get('/info', [InformationController::class, 'info']);
