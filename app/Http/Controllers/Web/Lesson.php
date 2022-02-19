<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Lesson extends Controller
{

    public function index()
    {
        return view('web.l2e.learn');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        return view('web.l2e.learn');
    }

    public function create($course)
    {
        return view('web.l2e.lesson.create');
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        return $this->create();
    }
}
