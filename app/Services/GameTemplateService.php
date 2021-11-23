<?php

namespace App\Services;

use App\Repositories\GameTemplateRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameTemplateService extends BaseService
{

    /**
     * @param \App\Repositories\GameTemplateRepository $repository
     */
    public function __construct(GameTemplateRepository $repository)
    {
        $this->repository = $repository;
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

        return $this->endFilter();
    }

    /**
     * Create a new game template
     *
     * @param \Illuminate\Http\Request $request
     * @param string $creatorId
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(Request $request, $creatorId)
    {
        $data = $request->only(['name', 'introduction']);
        $data['creator_id'] = $creatorId;
        $data['status']     = CREATING_GAME_STATUS;

        if ($request->hasFile('thumb')) {
            $data['thumb'] = $this->uploadThumb($request->file('thumb'), $creatorId);
        }

        $record = $this->repository->create($data);

        $this->withSuccess(trans('message.game_template_created'));

        return $record;
    }

    /**
     * Upload thumb image of game
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    protected function uploadThumb($file, $createId = null)
    {
        return Storage::putFile('game_template/' . $createId, $file);
    }
}
