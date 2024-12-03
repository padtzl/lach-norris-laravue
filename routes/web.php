<?php

use App\Http\Controllers\ApiSettingController;
use App\Http\Controllers\JokesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/joke', [JokesController::class, 'index']);

Route::get('/api-settings', [ApiSettingController::class, 'index']);
Route::post('/api-settings', [ApiSettingController::class, 'toggle']);
