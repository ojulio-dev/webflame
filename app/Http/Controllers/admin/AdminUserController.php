<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReportedUser;

class AdminUserController extends Controller
{
    public function index()
    {

        $reportedUsers = ReportedUser::with(['reportedUser'])->where('checked_at', null)->get();

        $reportedUsers->map(function($reportedUser, $index) {

            $reportedUser->reportedUser->subscribers;

            $reportedUser->reportedUser->videos;

        });

        return view('admin.users', ['users' => $reportedUsers]);
    }
}
