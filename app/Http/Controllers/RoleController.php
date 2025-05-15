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
    
    public function getRole($id)
    {
        $role = Role::where('id',$id)->first();
        return response()->json($role);
    }
    
    public function deleteRole($id)
    {
        $role = Role::where('id',$id)->first();
        $role->delete();
        return back()->with('success','Delete Role Successfully.');
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
    
    public function editRole(Request $request)
    {

        $request->validate([
            'school_name' => 'required|string',
            'id' => 'required|integer',
            'role_name' => 'required|string',
        ]);

        $role = Role::where('id', $request->id)->first();
        if (!$role) {
            return back()->with('error','Role not found.');
        }
        
        $role->role_name = $request->role_name;
        $role->school_id = $request->school_name;
        $role->save();        
        
        return back()->with('success','Role Save Successfully');
    }
}
