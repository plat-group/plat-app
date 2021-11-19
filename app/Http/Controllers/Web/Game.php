<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Game extends Controller
{
    /**
     * Show list myOrder for client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function uploadGame()
    {
        return view('web.uploadGame.index');
    }
}
