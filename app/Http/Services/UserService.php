<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;

class UserService
{
    public function register(Request $request) {
        $data = $request->input();
        $user_check = User::where('username', $data['username'])->first();
        if ($data['password'] ==  $data['comfirm_password'] && !$user_check) {
            $user = new User([
                'name'=> $data['name'],
                'username'=> $data['username'],
                'email'=> $data['email'],
                'password'=> $data['password'], 
            ]);
            $user->save();
            return redirect()->route('get.login')->with('success', 'Sign up success pls login');
        }
    }
}