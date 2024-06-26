<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollments::all();
        return Inertia::render('Enrollments/index', [
            'enrollments' => $enrollments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'siswa')->get()->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
            ];
        });

        $courses = Courses::all()->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
            ];
        });

        $classes = Classes::all()->map(function ($class) {
            return [
                'id' => $class->id,
                'name' => $class->name,
            ];
        });

        return Inertia::render('Enrollments/Create', [
            'students' => $students,
            'courses' => $courses,
            'classes' => $classes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_number' => 'required|min:7',
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'class_id' => 'required|exists:classes,id',
        ]);

        Enrollments::create($validatedData);

        return redirect()->route('enrollments')->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollments $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollments $enrollment)
    {
        return view('enrollments.edit', compact('enrollment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollments $enrollment)
    {
        $validatedData = $request->validate([
            'order_number' => 'required|unique:enrollments,order_number,' . $enrollment->id,
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'class_id' => 'required|exists:classes,id',
        ]);

        $enrollment->update($validatedData);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollments $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
