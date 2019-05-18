<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;

class ApiBaseController extends Controller
{
    use HttpResponse;

    /**
     * ApiBaseController constructor.
     */
    public function __construct()
    {
    }
}
