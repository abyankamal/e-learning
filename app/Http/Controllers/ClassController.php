<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::paginate(10);
        return Inertia::render('Class/index', [
            'classes' => $classes
        ]);
    }

    public function create()
    {
        return Inertia::render('Class/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_name' => 'required|unique:classes,class_name',
            'description' => 'required|unique:classes|min:20',
        ]);

        Classes::create($validatedData);
        return redirect()->route('classes');
    }

    public function edit(Classes $class)
    {
        return Inertia::render('Class/Edit', [
            'classes' => $class
        ]);
    }

    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'class_name' => 'required|unique:classes,class_name',
            'description' => 'required|min:20',
        ]);

        $class->update([
            'class_name' => $request->class_name,
            'description' => $request->description,
        ]);
        return redirect()->route('classes');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()
            ->route('classes')
            ->with('message', 'User deleted successfully');
    }
}
