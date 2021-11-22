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
     * Create a new game template
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $creator
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(Request $request, $creator)
    {
        $creatorId = $creator->getAuthIdentifier();

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
