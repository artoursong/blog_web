<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserService;


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

    public function index($id) {
        $user_service = new UserService();
        return $user_service->index($id);
    }

    public function update($id, Request $request) {
        $user_service = new UserService();
        return $user_service->update($id, $request);
    }
}
