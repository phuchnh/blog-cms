<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('jwt.refresh', ['only' => 'refresh']);
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = $this->auth()->attempt($credentials)) {
            return $this->unauthorized();
        }

        return $this->responseWithToken($token);
    }

    /**
     * Destroy access token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->auth()->logout();

        return $this->noContent();
    }

    /**
     * Display authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        $user = User::findOrFail($this->auth()->user()->id);
        return $this->ok($user, UserTransformer::class);
    }

    /**
     * Refresh token
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function refresh()
    {
        if (! $token = \JWTAuth::parseToken()->authenticate()) {
            return $this->forbidden();
        }

        return $this->responseWithToken(JWTAuth::refresh($token));
    }

    /**
     * Transform response
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithToken($token)
    {
        return $this->ok([
            'token'     => $token,
            'user'      => $this->auth()->user(),
            'expiresIn' => \JWTFactory::getTTL() * config('jwt.ttl'),
        ]);
    }

    /**
     * Define auth guard
     *
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    private function auth()
    {
        return auth('api');
    }
}
