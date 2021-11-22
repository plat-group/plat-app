<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Auth\Authenticates;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    use Authenticates;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show form login
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        return view('auth.web.login');
    }

    /**
     * Redirect after authenticated
     *
     * @return string
     */
    public function redirectTo()
    {
        return route(HOME_ROUTE);
    }
}
