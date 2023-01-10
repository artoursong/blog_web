<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function sign_up(Request $request) {
        $user_service = new UserService();
        return $user_service->register($request);
    }

    public function login(Request $request) {
        $user_service = new UserService();
        return $user_service->login($request);
    }

    public function logout(Request $request) {
        $user_service = new UserService();
        return $user_service->logout($request);
    }

    public function index() {
        $user_service = new UserService();
        return $user_service->index();
    }

    public function update($id, Request $request) {
        $user_service = new UserService();
        return $user_service->update($id, $request);
    }

    public function showProfile($id) {
        $user_service = new UserService();
        return $user_service->showProfile($id);
    }

    public function showEditProfile($id) {
        $user_service = new UserService();
        return $user_service->showEditProfile($id);
    }

    public function updatePass($id, Request $request) {
        $user_service = new UserService();
        return $user_service->updatePass($id, $request);
    }

    public function getPassPage($id) {
        $view = View::make('user.change_pass');
        return $view;
    }


}
