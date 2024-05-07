<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\ReportedVideo;

class AdminVideoController extends Controller
{
    public function index()
    {

        $data = [];

        $data['reported'] = ReportedVideo::with(['video', 'reportedUser', 'reportingUser'])->where('checked', 0)->get();

        $data['pending'] = Video::whereHas('status', function($query) {

            $query->where('id', 3);

        })->get();

        return view('admin.videos', ['dataVideo' => $data]);
    }
}
