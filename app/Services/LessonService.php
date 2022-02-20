<?php

namespace App\Services;

use App\Events\LessonCompletedEvent;
use App\Repositories\CampaignRepository;
use App\Repositories\LessonRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonService extends BaseService
{
    /**
     * @var \App\Repositories\CampaignRepository
     */
    protected $campaignRepository;

    /**
     * @param \App\Repositories\LessonRepository $repository
     * @param \App\Repositories\CampaignRepository $campaignRepository
     */
    public function __construct(LessonRepository $repository, CampaignRepository $campaignRepository)
    {
        $this->repository = $repository;
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Get list game published on market
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function market($conditions = [])
    {
        $this->makeBuilder($conditions);

        $this->builder->onMarket();

        //$this->cleanFilterBuilder([]);

        return $this->endFilter();
    }

    /**
     * Scoring for user assignments
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function submitAssignments(Request $request)
    {
        // Get lesson and questions
        $lesson = $this->find($request->input('lesson_id'), ['questions.answers']);

        $answered = $request->input('answered');
        $correctCount = 0;
        $wrongCount = 0;

        //Compare the correct answers and results
        foreach ($lesson->questions as $question) {
            $correct = $question->answers->where('correct', 1)->first();
            if (!array_key_exists($question->id, $answered) || $answered[$question->id] != $correct->id) {
                $wrongCount++;
                continue;
            }

            $correctCount++;
        }

        $earned = 0;
        $totalQuestion = $lesson->questions->count();
        $correctPercent = ($correctCount / $totalQuestion) * 100;
        if ($totalQuestion > $wrongCount && $correctPercent > 50) {
            $campaign = $this->campaignRepository->ofCourse($request->input('course_id'));
            $earned = $campaign->user_budget;

            // Fire event
            LessonCompletedEvent::dispatch(
                $lesson->withoutRelations(),
                $campaign->id,
                '1ec916ce-f2b3-67f8-87f9-20c9d07b7361', // tam thoi team plat se refer cho learn
                optional($request->user())->id
            );
        }

        return ['correct' => $correctCount, 'wrong' => $wrongCount, 'earned' => $earned];
    }
}
