<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RoleController;

Route::get('/',function(){
    return view('index');
});


Route::get('/school-list',[SchoolController::class ,'index']);
Route::post('/school-list',[SchoolController::class ,'saveSchool']);

// role
Route::get('/role-list',[RoleController::class ,'index']);
Route::post('/role-list',[RoleController::class ,'saveRole']);
Route::post('/role-edit',action: [RoleController::class ,'editRole']);
Route::get('/delete-role/{id}',[RoleController::class ,'deleteRole']);

