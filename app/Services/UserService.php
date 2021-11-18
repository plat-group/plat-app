<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    /**
     * UserService constructor.
     *
     * @param \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user data
     *
     * @param \Illuminate\Http\Request $request
     * @param string $roleDefault
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(Request $request, string $roleDefault = USER_ROLE)
    {

        $data = $request->only(['email', 'sex', 'birthday']);
        $data['name'] = "Hoàng";
        $data['password'] = $this->passwordHash($request->input('password'));
        $data['kind'] = $roleDefault;

        $this->withSuccess(trans('message.account_created'));

        return $this->repository->create($data);
    }

    /**
     * Processing information updates or creating a new record from requests submitted
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        // Check parameter name ID from request.
        // If ID is empty, action is create a new record
        if (!$id) {
            return $this->create($request, $request->input('role'));
        }

        // Remove request change email filed
        $data = $request->except(['email', 'password']);
        if ($request->filled('password')) {
            $data['password'] = $this->passwordHash($request->input('password'));
        }

        $this->withSuccess(trans('message.account_updated'));

        return $this->repository->update($data, $id);
    }

    /**
     * Create filter and response list by conditions
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function search($conditions = [])
    {
        $this->makeBuilder($conditions);

        /**
         * When users search by email, need to search with LIKE condition and process all records
         */
        if ($this->filter->has('email')) {
            $this->builder->where('email', 'LIKE', '%' . $this->filter->get('email') . '%');

            // Remove condition after apply query builder
            $this->cleanFilterBuilder('email');
        }

        return $this->endFilter();
    }

    public function delete($id)
    {
        $user = $this->find($id);
        if ($user->isAdmin()) {
            return $this->withErrors(trans('message.delete_user_failed_role'));
        }

        $user->delete();

        return $this->withSuccess(trans('message.user_deleted'));
    }

    /**
     * Encrypt the password field
     *
     * @param string $string password string
     *
     * @return string
     */
    protected function passwordHash($string)
    {
        return Hash::make($string);
    }
}
