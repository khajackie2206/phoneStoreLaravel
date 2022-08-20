<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.authentication.login', [
        ]);
    }
}
