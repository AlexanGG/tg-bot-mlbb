<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => 'Everything is working!']);
    }
}
