<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserRequest;
use App\Http\Requests\API\UpdateUserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return $this->ok($user, UserTransformer::class);
    }

    /**
     * @param \App\Http\Requests\API\CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->password = Hash::make($request->post('password'));
        $user->save();

        return $this->created($user);
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Http\Requests\API\UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->fill($request->validated());
        if ($request->post('password')) {
            $user->password = Hash::make($request->post('password'));
        }
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

    /**
     * @param \App\Models\User $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function recentUser(User $users)
    {
        $users = $users->query()->orderBy('created_at', 'desc')->take(10)->get();
        return $this->ok($users);
    }
}
