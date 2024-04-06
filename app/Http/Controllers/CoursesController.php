<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $courses = Courses::with('teacher', 'lessons', 'enrolledStudents')->get();
        $courses = Courses::with('teacher')->paginate(10);
        return Inertia::render('Courses/index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'guru')->get();

        return Inertia::render('Courses/Create', [
            'teachers' => $teachers->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                ];
            }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:courses',
            'description' => 'required',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course = Courses::create($validatedData);

        return redirect()->route('courses')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $course)
    {
        $course->load('teacher', 'lessons', 'enrolledStudents');

        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $course)
    {
        $teachers = User::role('teacher')->get();

        return Inertia::render('Courses/Edit', [
            'course' => $course,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:courses,title,' . $course->id,
            'description' => 'required',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course->update($validatedData);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
