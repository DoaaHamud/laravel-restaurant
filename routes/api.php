<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'Register');
    Route::post('login', 'login');
    Route::get('profile', 'profile')->middleware('auth:sanctum');
    // Route::patch('UpdatePassword/{id}', 'UpdatePassword')->middleware('auth:sanctum');
    Route::delete('DeleteUser/{id}', 'DeleteUser')->middleware('auth:sanctum');

});

Route::controller(MenuController::class)->group(function(){
     Route::post('ContentMenu','ContentMenu');
     Route::get('GetContentMenu','GetContentMenu');
     Route::put('UpdateContentMenu/{id}','UpdateContentMenu');
     Route::get('GetContentMenu_id/{id}','GetContentMenu_id');
     Route::delete('DeleteContentMenu/{id}','DeleteContentMenu');
});
