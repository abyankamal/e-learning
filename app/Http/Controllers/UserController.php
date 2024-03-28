<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::paginate(10);
        return Inertia::render('Admin/index', [
            'users' => $user
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Create');
    }
}
