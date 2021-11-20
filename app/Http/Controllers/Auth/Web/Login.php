<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Auth\Authenticates;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    use Authenticates;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectTo()
    {
        return redirect()->route(HOME_ROUTE);
    }
}
