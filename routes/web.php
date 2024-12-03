<?php

use App\Http\Controllers\JokesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/joke', [JokesController::class, 'index']);
