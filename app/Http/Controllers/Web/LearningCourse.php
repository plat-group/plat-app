<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearningCourse extends Controller
{

    public function index()
    {
        return view('web.l2e.learn');
    }

    public function create()
    {
        return view('web.l2e.course.create');
    }

    public function create2()
    {
        return view('web.l2e.create');
    }

    public function store(Request $request)
    {
        $mode = $request->mode;
        if($mode === 'new-lesson') {
            return $this->create2();
        }
        dd($request->toArray());
    }
}
