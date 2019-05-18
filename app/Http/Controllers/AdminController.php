<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
        $this->middleware('auth.token');
    }

    public function __invoke()
    {
        return view('admin.app');
    }
}
