<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CourseService;

class Learning extends Controller
{

    /**
     * @var CourseService
     */
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $assign = [
            'courses' => $this->courseService->search()
        ];

        return view('web.l2e.index', $assign);
    }
}
