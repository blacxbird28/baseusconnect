<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.dashboard.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // Other validations
        ]);

        User::create($validated);

        return redirect()->route('users.index');
    }
}

