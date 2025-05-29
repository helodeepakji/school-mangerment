<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::with('admin')->get();
        return view('school-list', compact('schools'));
    }

    public function getSchool($id)
    {
        $schools = School::with('admin')->where('id', $id)->first();
        return response()->json($schools);
    }

    public function deleteSchool($id)
    {
        if ($id) {
            return back()->with('error', 'Admin School is not delete');
        }

        $users = User::where('school_id', $id);
        $users->delete();

        $schools = School::where('id', $id);
        $schools->delete();
        return back()->with('success', 'School Delete Successfully');
    }

    public function saveSchool(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'school_name' => 'required|string',
            'school_address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15',
            'email' => 'required|email',
            'max_staff' => 'required|integer|min:1',
            'expairy_date' => 'required|date',
        ]);

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            return back()->with('error', 'Phone no is already exists.');
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return back()->with('error', 'Email Id is already exists.');
        }

        $school = School::create([
            'name' => $request->school_name,
            'address' => $request->school_address,
            'max_staff' => $request->max_staff,
            'expairy_date' => $request->expairy_date,
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => 2,
            'school_id' => $school->id,
            'gender' => $request->gender,
            'password' => 'password123',
        ]);

        return back()->with('success', 'School Create Successfully');
    }

    public function updateSchool(Request $request)
    {

        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'name' => 'required|string',
            'school_name' => 'required|string',
            'school_address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15',
            'email' => 'required|email',
            'max_staff' => 'required|integer|min:1',
            'expairy_date' => 'required|date',
        ]);


        $school = School::where('id', $request->school_id)->first();
        $school->name = $request->school_name;
        $school->address = $request->school_address;
        $school->max_staff = $request->max_staff;
        $school->expairy_date = $request->expairy_date;
        $school->save();

        $user = User::where('school_id', $request->school_id)->where('role_id', 2)->first();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->save();

        return back()->with('success', 'School Updated Successfully');
    }
}     