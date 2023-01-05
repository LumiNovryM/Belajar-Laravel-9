<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    # Index Data
    public function index()
    {
        $title = "Class";
        $class = ClassRoom::get();
        return view('classroom',[
            'classlist' => $class,
            'title' => $title
        ]);
    }

    # Detail Data
    public function show($id)
    {
        $class = ClassRoom::with(['student', 'teacher'])->findOrFail($id);
        return view('class-detail', ['class' => $class, 'title' => 'Class']);
    }

    # Create Data 
    public function create()
    {
        $teacher = Teacher::all();
        return view('class-add', [
            "title" => "Class",
            "teacher" => $teacher
        ]);
    }

    # Create Action
    public function store(Request $request)
    {
        ClassRoom::create($request->all());
        return redirect('/class');
    }
}
