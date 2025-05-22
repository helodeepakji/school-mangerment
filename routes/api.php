<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/getRole/{id}',[RoleController::class ,'getRole']);
Route::get('/getRoleBySchool/{id}',[RoleController::class ,'getRoleBySchool']);

Route::get('/getSchool/{id}',[SchoolController::class ,'getSchool']);
Route::get('/getClass/{id}',[ClassController::class ,'getClass']);
Route::get('/getUser/{id}',[UserController::class ,'getUser']);