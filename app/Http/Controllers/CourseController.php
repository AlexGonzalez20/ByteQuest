<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.Courses', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso añadido correctamente');
    }

    public function show(Course $course)
    {
        //
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.EditCourses', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'nombre_curso' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente');
    }
}
