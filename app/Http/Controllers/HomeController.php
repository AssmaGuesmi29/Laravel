<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'totalUsers' => User::count(),
            'message' => 'Bienvenue sur notre application!'
        ]);
    }
}
