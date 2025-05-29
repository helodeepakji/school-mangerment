<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::with(['school', 'class'])->get();
        $schools = School::all();
        $class = ClassModel::all();

        return view('student', compact('students', 'schools', 'class'));
    }

    public function saveStudent(Request $request)
    {
        
        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'class_id' => 'required|integer|exists:classes,id',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15',
            'roll_no' => 'required|integer',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
        ]);
        

        Student::create([
            'name' => $request->full_name,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'gender' => $request->gender,
            'roll_no' => $request->roll_no,
            'address' => $request->address,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'school_id' => $request->school_id,
            'class_id' => $request->class_id,
        ]);


        return back()->with('success', 'Student Created Successfully');
    }
    
    public function editStudent(Request $request)
{
    $request->validate([
        'school_id' => 'required|integer|exists:schools,id',
        'class_id' => 'required|integer|exists:classes,id',
        'student_id' => 'required|integer|exists:students,id',
        'name' => 'required|string',
        'father_name' => 'required|string',
        'mother_name' => 'required|string',
        'dob' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'phone' => 'required|digits_between:7,15',
        'address' => 'required|string',
    ]);

    $student = Student::findOrFail($request->student_id);
    $student->name = $request->name;
    $student->father_name = $request->father_name;
    $student->mother_name = $request->mother_name;
    $student->dob = $request->dob;
    $student->gender = $request->gender;
    $student->phone = $request->phone;
    $student->address = $request->address;
    $student->school_id = $request->school_id;
    $student->class_id = $request->class_id;

    $student->save();

    return back()->with('success', 'Student updated successfully');
}
}