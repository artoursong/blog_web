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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'name' => 'required'
        ]);

        $data = $request->input();
        $user_check = User::where('username', $data['username'])->first();
        if (!$user_check) {
            $user = new User([
                'name'=> $data['name'],
                'username'=> $data['username'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password']),
            ]);
            $user->save();
            return redirect()->route('get.login')->with('success', 'Sign up success pls login');
        }
        else return back()->with('status', 'username is already exists');
    }

    public function login(Request $request) {
        $data = $request->only('email', 'password');
        if(Auth::attempt($data)) {
            if(session('url.intended') === url('/signup')) {
                return redirect()->route('get_new_blogs');
            }
            if(session('url.intended') === url('/login')) {
                return redirect()->route('get_new_blogs');
            }
            return redirect()->intended();
        }
        return back()->with('error', 'password or email not valid');

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('get_new_blogs');
    }

    public function index() {
        $view = View::make('user.index');
        return $view;
    }

    public function showProfile($id) {
        $user = User::where('id', $id)->first();
        $view = View::make('user.my_profile')->with('user', $user);
        return $view;
    }

    public function showEditProfile($id) {
        $user = User::where('id', $id)->first();
        $view = View::make('user.edit_profile')->with('user', $user);
        return $view;
    }

    public function update($id, Request $request) {
        $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required',
            'username' => 'required',
            'name' => 'required',
        ]);

        $user = User::where('id', $id)->first();

        $imageName = $user->image_url;

        if($request->image != null) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        User::where('id', $id)->update([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'image_url' => $imageName
        ]);
        $user = User::where('id', $id)->first();
        $view = view('user.my_profile')->with('user', $user);;
        return $view;
    }

    public function updatePass($id, Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::where('id', $id)->first();

        if(!Hash::check($request->old_password, $user->password)) {
            return back()->with("error", "old password doesnt match!");
        }

        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password change successfully!");
    }

}