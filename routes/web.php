<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RoleController;

Route::get('/',function(){
    return view('index');
});


Route::get('/school-list',[SchoolController::class ,'index']);

Route::get('/role-list',[RoleController::class ,'index']);
Route::post('/role-list',[RoleController::class ,'saveRole']);

