<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class MyOrder extends Controller
{

    public function index()
    {

        return view('web.game.my_order');
    }
}
