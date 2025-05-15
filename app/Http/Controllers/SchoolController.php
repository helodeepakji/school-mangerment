<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {
        return view('school-list');
    }
    
    public function saveSchool(Request $request) {

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

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'gender'=> $request->gender,
            'password'=> 'password123',
        ]);
        
        School::create([
            'name' => $request->school_name,
            'address'=> $request->school_address,
            'max_staff' => $request->max_staff,
            'expairy_date' => $request->expairy_date,
            'user_id'=> $user->id,
        ]);

        return back()->with('success','School Create Successfully');
    }
}
