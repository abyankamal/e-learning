<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Admin/index', [
            'menus' => $this->getMenuByRole()
        ]);
    }

    function getMenuByRole()
    {
        $menu = []; // Initialize an empty menu

        if (auth()->user()->role === 'admin') {
            $menu = [ // Build the admin menu
                'items' => [
                    [
                        'name' => "Dashboard",
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                    [
                        'name' => "Users",
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                    [
                        'name' => "Pengelolaan Absensi", // Maintain original names
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                    [
                        'name' => "Pengelolaan Murid",
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                    [
                        'name' => "Pengelolaan Kelas",
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                    [
                        'name' => "Pengelolaan Rombel",
                        'href' => route("dashboard"),
                        'current' => route("dashboard"),
                    ],
                ],
            ];
        }

        return $menu;
    }
}
