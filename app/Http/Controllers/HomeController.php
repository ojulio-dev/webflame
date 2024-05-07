<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {

        $videos = Video::activeVideos()->where('status_id', '1')->get();

        $currentTime = new Carbon();

        $videos = $videos->map(function($video) use ($currentTime) {

            $videoData = $video->toArray();

            $videoData['dataDifference'] = $currentTime->diffForHumans($video->created_at);

            $videoData['user'] = $video->user->toArray();

            return $videoData;

        });

        return view('app.home.main', ['videos' => $videos]);
    }
    
    public function search(Request $r)
    {
        if (!isset($r->q)) {

            return redirect()->route('home');

        }

        $videos = Video::join('users', 'videos.user_id', 'users.id')
            ->select('videos.*', 'users.icon', 'users.name', 'users.username')
            ->where('videos.title', 'like', "%{$r->q}%")
            ->orWhere('users.name', 'like', "%{$r->q}%")
            ->orWhere('users.username', 'like', "%{$r->q}%")
            ->activeVideos()
        ->get();

        $users = User::orWhere('username', 'like', '%' . $r->q . '%')->orWhere('name', 'like', '%' . $r->q . '%')->active()->get();

        $users = $users->map(function($user) {

            $dataUser = $user;

            $dataUser['subscribers'] = $dataUser->subscribers->count();

            return $dataUser;

        });

        return view('app.home.search', ['videos' => $videos, 'users' => $users]);
    }

    public function searchPreview(Request $r)
    {

        $data['users'] = User::where('name', 'like', "{$r->search}%")
            ->active()
            ->select('name AS value')
            ->limit(5)
        ->get();

        $data['videos'] = Video::where('title', 'like', "{$r->search}%")
            ->activeVideos()
            ->select('title AS value')
            ->limit(5)
        ->get();

    return json_encode($data);

    }
}
