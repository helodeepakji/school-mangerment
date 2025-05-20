<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RoleController;

Route::get('/',function(){
    return view('index');
});

// school
Route::get('/school-list',[SchoolController::class ,'index']);
Route::post('/school-list',[SchoolController::class ,'saveSchool']);
Route::post('/school-update',[SchoolController::class ,'updateSchool']);
Route::get('/delete-school/{id}',[SchoolController::class ,'deleteSchool']);

// role
Route::get('/role-list',[RoleController::class ,'index']);
Route::post('/role-list',[RoleController::class ,'saveRole']);
Route::post('/role-edit',action: [RoleController::class ,'editRole']);
Route::get('/delete-role/{id}',[RoleController::class ,'deleteRole']);

