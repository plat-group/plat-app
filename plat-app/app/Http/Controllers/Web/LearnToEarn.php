<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearnToEarn extends Controller
{

    public function index()
    {
        return view('web.l2e.learn');
    }

    public function create()
    {

        return view('web.l2e.create');
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        return $this->create();
    }
}
