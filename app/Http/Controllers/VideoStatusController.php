<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;

class VideoStatusController extends Controller
{
    
    public function findVideosByStatusId($id)
    {

        $videos = Video::activeVideos()->where('status_id', $id)->get();

        foreach($videos as $key => $video) {

            $video->user;

        }

        return $videos;

    }

}
