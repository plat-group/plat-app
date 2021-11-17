<?php

namespace App\Services\Concerns;

use App\Services\Traits\MessageTraitService;
use Illuminate\Support\Facades\Auth;

abstract class BaseService extends SearchBaseServiceAbstract
{
    use MessageTraitService;

    /**
     * Base repository
     *
     * @var object | \App\Repositories\Concerns\BaseRepository
     */
    protected $repository;

    /**
     * Get repository of service
     *
     * @return \App\Repositories\Concerns\BaseRepository|object
     */
    public function repository()
    {
        return $this->repository;
    }

    /**
     * Custom find method with LoadMissing of eloquent
     *
     * @param  int | string  $id
     * @param  false  $with
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function find($id, $with = false)
    {
        $result = $this->repository->find($id);

        if (!$with) {
            return $result;
        }

        $this->withLoad = !is_array($with) ? : array_merge($this->withLoad, $with);

        return $result->loadMissing($this->withLoad);
    }

    /**
     * Detail of primary key with trashed and return null if failed
     *
     * @param  int | string  $id
     *
     * @return \Illuminate\Database\Eloquent\Model | null
     */
    public function getDetail($id)
    {
        try {
            return $this->repository->getDetail($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Custom delete eloquent. Check exits data before delete
     *
     * @param  int | string  $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $row = $this->find($id);
        $row->delete();

        return true;
    }

    /**
     * Store basic data has authentication
     *
     * @param  array  $request
     * @param  null  $elementId
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function storeBasic(array $request, $elementId = null)
    {
        $request['updated_by'] = Auth::id();

        /**
         * DO: Check create or update by $elementId
         */
        if (!$elementId) {
            $request['created_by'] = Auth::id();
            $element               = $this->repository->create($request);

            $this->withSuccess(trans('message.stored successfully'));
        } else {
            $element = $this->repository->update($request, $elementId);

            $this->withSuccess(trans('message.updated'));
        }

        return $element;
    }

    /**
     * Escape special characters for a LIKE query.
     *
     * @param string $value
     * @param string|null $char
     *
     * @return string
     */
    public function escapeLike(string $value, string $char = null)
    {
        $char = $char ?: '\\';

        return str_replace(
            [$char, '%', '_'],
            [$char . $char, $char . '%', $char . '_'],
            $value
        );
    }
}
