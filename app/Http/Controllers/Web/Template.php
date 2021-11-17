<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class Template extends Controller
{

    /**
     * Show list games for client
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('web.template.index');
    }
}
