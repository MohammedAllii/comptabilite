<?php

// LoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function redirectTo()
    {
        if (Auth::check()) {
            switch(Auth::user()->role){
                case "Admin":
                case "Super":
                    return '/';
                    break;
            }
        }
        return '/';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
