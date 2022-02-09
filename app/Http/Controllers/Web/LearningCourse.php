<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearningCourse extends Controller
{

    public function myCourses()
    {
        return view('web.l2e.course.management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.l2e.learn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.l2e.course.create');
    }

    public function create2()
    {
        return view('web.l2e.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mode = $request->mode;
        if($mode === 'new-lesson') {
            return $this->create2();
        }
        return redirect(route(POOL_GAME_ROUTE));
    }
}
