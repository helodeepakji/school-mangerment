<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

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


// class
Route::get('/class-list',[ClassController::class ,'index']);
Route::post('/class-list',[ClassController::class ,'saveClass']);
Route::post('/class-edit', [ClassController::class ,'editClass']);
Route::get('/delete-class/{id}',[ClassController::class ,'deleteClass']);


// user
Route::get('/user-list',[UserController::class ,'index']);
Route::post('/user-list',[UserController::class ,'saveUser']);
Route::post('/user-update', [UserController::class ,'editUser']);
Route::get('/delete-user/{id}',[UserController::class ,'deleteUser']);

//Student
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students/save', [StudentController::class, 'saveStudent'])->name('students.store');