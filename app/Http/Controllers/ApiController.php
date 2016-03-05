<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function test()
    {
        Log::info(Auth::guard('api')->user());
    }
}