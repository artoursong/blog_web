<?php
namespace App\Http\Controllers;

use App\Http\Services\PasswordResetService;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    protected PasswordResetService $passwordresetservice;

    public function __construct()
    {
        $this->passwordresetservice = new PasswordResetService();
    }

    public function submitForgetPasswordForm(Request $request) {
        return $this->passwordresetservice->submitForgetPasswordForm($request);
    }

    public function showResetPasswordForm($token) {
        return $this->passwordresetservice->showResetPasswordForm($token);
    }

    public function submitResetPasswordForm(Request $request) {
        return $this->passwordresetservice->submitForgetPasswordForm($request);
    }
  
}