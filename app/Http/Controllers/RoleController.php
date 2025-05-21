<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\School;

class RoleController extends Controller
{
    public function index()
    {
        $schools = School::all();
        $roles = Role::with('school')->get();
        return view('role-list',compact('roles','schools'));
    }
    
    public function getRole($id)
    {
        $role = Role::where('id',$id)->first();
        return response()->json($role);
    }
    
    public function deleteRole($id)
    {
        if($id == 1 || $id == 2){
            return back()->with('error','Admin Role is not delete.');
        }
        $role = Role::where('id',$id)->first();
        $role->delete();
        return back()->with('success','Delete Role Successfully.');
    }

    public function saveRole(Request $request)
    {
        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'role_name' => 'required|string',
        ]);

        Role::create([
            'role_name' => $request->role_name,
            'school_id' => $request->school_id
        ]);
        
        return back()->with('success','Role Create Successfully');
    }
    
    public function editRole(Request $request)
    {

        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'id' => 'required|integer|exists:roles,id',
            'role_name' => 'required|string',
        ]);

        $role = Role::where('id', $request->id)->first();
        if (!$role) {
            return back()->with('error','Role not found.');
        }
        
        $role->role_name = $request->role_name;
        $role->school_id = $request->school_id;
        $role->save();        
        
        return back()->with('success','Role Save Successfully');
    }
}
