<?php

namespace App\Traits;

use Flugg\Responder\Http\MakesResponses;
use Illuminate\Http\JsonResponse;

trait HttpResponse
{
    use MakesResponses;

    /**
     * @param null $data
     * @param null $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok($data = null, $transformer = null)
    {
        return $this->success($data, $transformer)->respond(JsonResponse::HTTP_OK);
    }

    /**
     * @param null $data
     * @param null $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function created($data = null, $transformer = null)
    {
        return $this->success($data, $transformer)->respond(JsonResponse::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent()
    {
        return $this->success()->respond(JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param string $errorCode
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized($errorCode = 'unauthorized', string $message = null)
    {
        return $this->error($errorCode, $message)->respond(JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string $errorCode
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function forbidden($errorCode = 'unauthenticated', string $message = null)
    {
        return $this->error($errorCode, $message)->respond(JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * @param string $errorCode
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound($errorCode = 'resource_not_found', string $message = null)
    {
        return $this->error($errorCode, $message)->respond(JsonResponse::HTTP_NOT_FOUND);
    }
}
