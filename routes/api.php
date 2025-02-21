<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use \App\Http\Controllers\Api\CustomerController;

Route::middleware('auth.basic')->group(function(){
    Route::get('/users',[CustomerController::class, 'index']);
});
