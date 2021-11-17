<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class Pool extends Controller
{

    /**
     * Show list games for client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('web.poll.index');
    }
}
