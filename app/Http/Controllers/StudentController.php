<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show the list of students
   public function index()
{
    $students = Student::with(['school', 'role'])->get();
    $schools = \App\Models\School::all();
    $roles = \App\Models\Role::all();

    return view('student', compact('students', 'schools', 'roles'));
}

    // Save a new student
    public function saveStudent(Request $request)
    {
        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'role_id' => 'required|integer',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15|unique:students',
            'email' => 'required|email|unique:students',
            'full_name' => 'required|string|max:255',
        ]);



     $existingPhone = Student::where('phone', $request->phone)->first();
if ($existingPhone) {
    return back()->with('error', 'Phone no is already exists.');
}

$existingEmail = Student::where('email', $request->email)->first();
if ($existingEmail) {
    return back()->with('error', 'Email is already exists.');
}

Student::create([
    'email' => $request->email,
    'phone' => $request->phone,
    'school_id' => $request->school_id,
]);


        return back()->with('success', 'Student Created Successfully');
    }
}