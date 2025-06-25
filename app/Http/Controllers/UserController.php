<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
    public function giving()
    {
        return view('users.giving');
    }
    public function faq()
    {
        return view('users.faq');
    }
}
