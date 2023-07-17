<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('app.home.main');
    }
    
    public function search(Request $r)
    {
        // Database Request

        return view('app.home.search');
    }

    public function watch(Request $r)
    {

        return view('app.watch');

    }
}
