<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/getRole/{id}',[RoleController::class ,'getRole']);
Route::get('/getSchool/{id}',[SchoolController::class ,'getSchool']);