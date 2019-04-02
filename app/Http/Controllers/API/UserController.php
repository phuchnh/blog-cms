<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UpdateUserRequest;
use App\Models\User;

class UserController extends ApiBaseController
{
    public function index(User $users)
    {
        return $this->ok($users->orderBy('id', 'desc')->get());
    }

    public function show(User $user)
    {
        return $this->ok($user);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->fill($request->validated());
        $user->save();

        return $this->noContent();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->noContent();
    }
}
