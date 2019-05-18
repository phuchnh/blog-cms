<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class ExistController extends ApiBaseController
{
    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function users($email)
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::whereEmail($email);

        return $this->ok(['exist' => $user->exists()]);
    }
}
