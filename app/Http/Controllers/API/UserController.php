<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiBaseController
{
    /**
     * @param \App\Models\User $users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $users, Request $request)
    {
        $users = $users->search($request);

        $paginator = $request->get('perPage');

        $users = $users
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate($paginator);

        return $this->ok($users);
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return $this->ok($user);
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Http\Requests\API\UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->fill($request->validated());
        $user->save();

        return $this->noContent();
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->noContent();
    }
}
