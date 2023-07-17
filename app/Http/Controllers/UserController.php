<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('app.users.profile.main');
    }

    public function videos()
    {
        return view('app.users.profile.videos');
    }

    public function findUser(Request $r)
    {

        return view('app.users.findUser');

    }
}
