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
}
