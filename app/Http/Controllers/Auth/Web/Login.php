<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Auth\Authenticates;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    use Authenticates;

    public function showForm()
    {
        return view('auth.web.login');
    }
}
