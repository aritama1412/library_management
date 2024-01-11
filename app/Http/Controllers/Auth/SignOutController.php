<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SignOutController extends Controller
{
    public function sign_out() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
