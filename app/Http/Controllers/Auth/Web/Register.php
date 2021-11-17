<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\AuthController;

class Register extends AuthController
{

    /**
     * Show form register
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        return view('auth.web.register');
    }
}
