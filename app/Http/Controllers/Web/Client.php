<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Client extends Controller
{
    /**
     * Show list myGame for client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myGame()
    {
        return view('web.myGame.index');
    }

    /**
     * Show list myOrder for client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myOrder()
    {
        return view('web.myOrder.index');
    }
}
