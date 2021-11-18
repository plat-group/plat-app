<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\AuthController;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class Register extends AuthController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show form register
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        return view('auth.web.register');
    }

    /**
     *  Register User
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->toArray();

        $this->userService->create($request, $data['kind']);

        return route(LOGIN_ROUTE);

    }
}
