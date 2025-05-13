<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role-list',compact('roles'));
    }

    public function saveRole(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string',
            'role_name' => 'required|string',
        ]);

        Role::create([
            'role_name' => $request->role_name,
            'school_id' => 1
        ]);
        
        return back()->with('success','Role Create Successfully');
    }
}
