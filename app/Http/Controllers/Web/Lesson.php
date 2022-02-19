<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SubmitAssignmentsRequest;
use App\Services\LessonService;
use Illuminate\Http\Request;

class Lesson extends Controller
{
    /**
     * @var \App\Services\LessonService
     */
    protected $lessonService;

    /**
     *
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        $assign = [
            'lesson' => $this->lessonService->find($id, ['questions.answers'])
        ];

        return view('web.l2e.learn', $assign);
    }

    /**
     * Scoring for user assignments
     *
     * @param \App\Http\Requests\Web\SubmitAssignmentsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitAssignments(SubmitAssignmentsRequest $request)
    {
        return response()->json($this->lessonService->submitAssignments($request));
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
