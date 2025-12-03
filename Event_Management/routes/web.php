<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Layout.app');
});
Route::resource('event',EventController::class);
