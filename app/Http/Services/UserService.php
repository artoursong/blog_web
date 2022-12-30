<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserService
{

    public function register(Request $request) {
        $request->validate([
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);  
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images'), $imageName);

        $data = $request->input();
        $user_check = User::where('username', $data['username'])->first();
        if ($data['password'] ==  $data['comfirm_password'] && !$user_check) {
            $user = new User([
                'name'=> $data['name'],
                'username'=> $data['username'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password']),
                'image_url' => $imageName,
            ]);
            $user->save();
            return redirect()->route('get.login')->with('success', 'Sign up success pls login');
        }
    }

    public function login(Request $request) {
        $data = $request->only('email', 'password');
        if(Auth::attempt($data)) {
            return redirect()->route('home');
        }
        else {
            return redirect()->back()->with('message', 'password or email not valid');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function index($id) {
        $view = View::make('user.index');
        return $view;
    }

    public function indexInfo($id) {
        $user = User::where('id', $id)->first();
        $view = View::make('user.information')->with('user', $user);
        return $view;
    }

    public function indexAvatar($id) {
        $user = User::where('id', $id)->first();
        $view = View::make('user.avatar')->with('user_avatar', $user->image_url);
        return $view;
    }

    public function update($id, Request $request) {
        $data = $request->input();
        User::where('id', $id)->update(['email' => $data['email'], 'username' => $data['username'], 'name' => $data['name']]);
        $user = User::where('id', $id)->first();
        $view = view('user.information', $user);
        return $view;
    }
}