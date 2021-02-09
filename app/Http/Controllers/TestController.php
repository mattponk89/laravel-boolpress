<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function guest()
    {
        return view('hello.index');
    }
    public function logged()
    {
        $user = Auth::user();
        return view('hello.index', compact('user'));
    }
}
