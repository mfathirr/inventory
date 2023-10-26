<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function store(Request $request) {
        $input = $request->all();
        if ($request->input('password')) 
        {
            $input['password'] = bcrypt($input['password']);
        }
        User::create($input);
        return redirect('/user');
    }
}
