<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\AuthController;
use App\Http\Requests\Web\RegisterRequest;
use App\Services\UserService;

class Register extends AuthController
{

    /**
     * @var \App\Services\UserService
     */
    protected UserService $userService;

    /**
     * @param \App\Services\UserService $userService
     */
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
     * handle form register user
     *
     * @param \App\Http\Requests\Web\RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function register(RegisterRequest $request)
    {
        $this->userService->create($request, $request->input('request_role'));

        return redirect()->route(LOGIN_ROUTE);
    }
}
