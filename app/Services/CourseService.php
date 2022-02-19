<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Services\Concerns\BaseService;
use App\Services\Traits\Poolable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseService extends BaseService
{
    use Poolable;

    /**
     * Loading relationship
     *
     * @var array
     */
    protected $withLoad = ['creator'];

    /**
     * @param \App\Repositories\CourseRepository $repository
     */
    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $creatorId
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request, $creatorId)
    {
        $id = $request->input('id');
        $data = $request->toArray();

        $data['creator_id'] = $creatorId;
        $thumbnail = $this->thumbnailStore($request->file('thumbnail'));
        if (!$id) {
            $data['thumbnail'] = $thumbnail;

            $this->withSuccess(trans('message.course_created'));

            return $this->repository->create($data);
        }

        $course = $this->repository->find($id);
        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail;
            //Need to delete old image files to free up storage
            Storage::delete($course->thumbnail);
        }

        $this->withSuccess(trans('message.course_updated'));

        return $course->update($data);
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     *
     * @return string|false
     */
    public function thumbnailStore($file)
    {
        if (!$file) {
            return false;
        }

        $rootPath = 'courses/' . Str::random() . '/';
        $fileName = $file->hashName();

        if (!Storage::putFileAs($rootPath, $file, $fileName)) {
            return false;
        }

        return $rootPath . $fileName;
    }
}
