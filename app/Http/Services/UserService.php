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
            return redirect()->route('home');
        }
        return back()->with('error', 'password or email not valid');

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function index($id) {
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
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);  
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $data = $request->input();
        if(!is_null($data['email'])) User::where('id', $id)->update(['email' => $data['email']]);
        if(!is_null($data['username'])) User::where('id', $id)->update(['username' => $data['username']]);
        if(!is_null($data['name'])) User::where('id', $id)->update(['name' => $data['name']]);
        if(!is_null($imageName)) User::where('id', $id)->update(['image_url' => $imageName]);
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