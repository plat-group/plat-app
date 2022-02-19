<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Auth\Authenticates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        return view('auth.web.near_login', ['action' => 'login']);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt($this->credentials($request), $request->input('remember', false));
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        return ['username' => $request->input('account_id')];
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     *
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'account_id' => 'required|string',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $redirectRouteName = MARKET_GAME_ROUTE; // Default URL

        if(env('APP_TYPE') == 2) {
            $redirectRouteName = L2E_ROUTE;
        }else{
            // referrer should redirect to pool
            if(isReferral()) {
                $redirectRouteName = POOL_GAME_ROUTE;
            }elseif(isUser()) {
                $redirectRouteName = MY_TRANSACTION_ROUTE;
            }
        }
        return response()->json(['redirect' => route($redirectRouteName)]);
    }

    /**
     * The user has logged out of the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function loggedOut(Request $request)
    {
        return view('auth.web.near_login', ['action' => 'logout']);
    }
}
