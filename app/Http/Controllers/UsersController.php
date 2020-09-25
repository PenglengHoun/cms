<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';

        $user->save();

        session()->flash('success', 'User Made Admin Successfully');

        return redirect()->route('users');
    }
    
    public function update(Request $request){
        $user = auth()->user();

        $user->name = $request->name;
        $user->about = $request->about;

        $user->save();
        
        session()->flash('success', 'User\'s profile Update Successfully');
    
        return redirect()->route('users');
    }

    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }
}
