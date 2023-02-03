<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    protected UserService $userservice;

    public function __construct()
    {
        $this->userservice = new UserService();
    }

    public function sign_up(Request $request) {
        return $this->userservice->register($request);
    }

    public function login(Request $request) {;
        return $this->userservice->login($request);
    }

    public function logout(Request $request) {
        return $this->userservice->logout($request);
    }

    public function index() {
        return $this->userservice->index();
    }

    public function update($id, Request $request) {
        return $this->userservice->update($id, $request);
    }

    public function showProfile($id) {
        return $this->userservice->showProfile($id);
    }

    public function showEditProfile($id) {
        return $this->userservice->showEditProfile($id);
    }

    public function updatePass($id, Request $request) {
        return $this->userservice->updatePass($id, $request);
    }

    public function getPassPage() {
        $view = View::make('user.change_pass');
        return $view;
    }


}
