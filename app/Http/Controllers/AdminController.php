<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __invoke()
    {
        return view('admin');
    }
}
