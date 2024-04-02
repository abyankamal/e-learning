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
        return Inertia::render('Admin/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:20|',
            'description' => 'required|unique:users,email',
        ]);

        Classes::create($request->all());
        return redirect()->route('users');
    }

    public function edit(Classes $user)
    {
        return Inertia::render('Admin/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, Classes $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : $user->password
        ]);
        return redirect()->route('users');
    }

    public function destroy(Classes $user)
    {
        $user->delete();
        return redirect()
            ->route('users')
            ->with('message', 'User deleted successfully');
    }
}
