<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\AuthController;

class Register extends AuthController
{

    public function showForm()
    {
        return view('auth.web.register');
    }
}
