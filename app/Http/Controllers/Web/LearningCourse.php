<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreCourseRequest;
use App\Services\CourseService;
use Illuminate\Http\Request;

class LearningCourse extends Controller
{
    /**
     * @var \App\Services\CourseService
     */
    protected CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function myCourses(Request $request)
    {
        $courses = $this->courseService->search(['creator_id' => $request->user()->id]);

        return view('web.l2e.course.management', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('web.l2e.course.create');
    }

    /**
     * @param string $id
     */
    public function edit($id)
    {
        $assign = [
            'course' => $this->courseService->find($id)
        ];

        return view('web.l2e.course.edit', $assign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StoreCourseRequest $request)
    {
        $this->courseService->store($request, $request->user()->getAuthIdentifier());

        return redirect()->route(MY_COURSE_ROUTE);
    }
}
