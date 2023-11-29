<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InformationController;



Route::get('users', [InformationController::class, 'alluser']);
