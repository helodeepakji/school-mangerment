<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassController extends Controller
{
    public function index()
    {
        $schools = School::all();
        $classes = ClassModel::with('school')->get();
        return view('class-list', compact('classes', 'schools'));
    }

    public function getClass($id)
    {
        $class = ClassModel::where('id', $id)->first();
        return response()->json($class);
    }

    public function deleteClass($id)
    {
        $class = ClassModel::where('id', $id)->first();
        $class->delete();
        return back()->with('success', 'Delete Class Successfully.');
    }

    public function saveClass(Request $request)
    {
        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'name' => 'required|string',
        ]);

        ClassModel::create([
            'name' => $request->name,
            'school_id' => $request->school_id
        ]);

        return back()->with('success', 'Class Create Successfully');
    }

    public function editClass(Request $request)
    {

        $request->validate([
            'school_id' => 'required|integer|exists:schools,id',
            'id' => 'required|integer|exists:classes,id',
            'name' => 'required|string',
        ]);

        $class = ClassModel::where('id', $request->id)->first();
        if (!$class) {
            return back()->with('error', 'Class not found.');
        }

        $class->name = $request->name;
        $class->school_id = $request->school_id;
        $class->save();

        return back()->with('success', 'Class Save Successfully');
    }
}
