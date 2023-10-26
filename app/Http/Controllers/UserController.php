<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Arr;
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

    public function show($id){
        $user = User::findOrFail($id);
        $ruangan = Ruangan::where('id_user', $id)->get()->all();
        return view('user.detail', compact('user', 'ruangan'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $data = $request->all();

        if ($request->input('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data = Arr::except($data,['password']);
        }

        $user->update();
        return redirect('/user');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }
}
