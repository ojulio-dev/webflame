<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Models\Video;
use App\Models\User;
use App\Models\Interaction;
use App\Models\VideoStatus;

use App\Models\Comment;
use App\Models\Subscriber;
use App\Models\View;

class VideoController extends Controller
{

    public function createVideo(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'title-create' => 'required|max:70',
            'description-create' => 'required',
            'thumbnail-create' => 'required|image|mimes:jpg,jpeg,png,gif',
            'uploadVideo' => 'required|mimes:mp4,mov,avi'
        ]);

        if ($validator->fails()) {

            echo json_encode(['status' => false, 'error' => $validator->errors()->first()]);
            exit();

        }

        $data = [];

        $data['title'] = $r->get('title-create');

        $data['description'] = $r->get('description-create');

        $data['user_id'] = Auth::user()->id;

        $data['status_id'] = VideoStatus::where('name', 'pending')->value('id');

        $video = new Video($data);

        if (!$video->save()) {

            echo json_encode(['status' => false]);
            exit();

        }

        // Thumbnail validate
        $thumbnail = $r->file('thumbnail-create');

        $thumbnailName = $video->id . '.' . $thumbnail->getClientOriginalExtension();

        $thumbnail->move(public_path('assets/images/thumbnails'), $thumbnailName);

        // Video Validate
        $uploadVideo = $r->file('uploadVideo');

        $videoName = $video->id . '.' . $uploadVideo->getClientOriginalExtension();

        $uploadVideo->move(public_path('assets/videos'), $videoName);

        $video->thumbnail = $thumbnailName;

        $video->video = $videoName;

        if (!$video->save()) {

            echo json_encode(['status' => false]);
            exit();

        } else {

            echo json_encode(['response' => true]);
            exit();

        }
    }

    public function listVideos()
    {

        $videos = Video::activeVideos()->get();

        foreach ($videos as $key => $video) {

            $videos[$key]['views_count'] = $video->views->count();

            $videos[$key]['views_count'] .= $videos[$key]['views_count'] == 1 ? ' visualização' : ' visualizações';

            $videos[$key]['user'] = $video->user;

        }

        echo json_encode($videos);

        exit();
        
    }

    public function watch(Request $r)
    {

        if (!$r->video) {

            return redirect()->route('home');

        }

        $validateView = View::where([
            'video_id' => $r->video,
            'user_id' => Auth::id()
        ])->first();

        if (!$validateView) {

            $view = new View([
                'video_id' => $r->video,
                'user_id' => Auth::id()
            ]);
    
            $view->save();

        }

        $dataVideo = Video::with(['comments.user', 'comments.video', 'comments' => function($query) {

            $query->orderBy('created_at', 'desc');

        }, 'user'])->whereHas('status', function($query) {

            $query->where('name', 'public');

        })->activeVideos()->find($r->video);

        if (!$dataVideo) return redirect()->route('home');

        foreach($dataVideo['comments'] as $comment) {

            $comment->dataDiff();

        }

        $dataVideo['views_count'] = $dataVideo->views->count();

        $dataVideo['views_count'] .= $dataVideo['views_count'] == 1 ? ' visualização' : ' visualizações';

        $dataVideo['user']['subscribers_count'] = $dataVideo['user']->subscribers->count();   

        $dataVideo['hasRegister'] = Subscriber::where([
            'user_subscriber_id' => Auth::user()->id,
            'user_channel_id' => $dataVideo['user']['id']
        ])->first() ? true : false;


        $dataVideo['interactions'] = $dataVideo->interactions();
        
        return view('app.watch', compact(['dataVideo']));

    }

    public function updateVideo(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'title' => 'required|max:70',
            'description' => 'required',
            'thumbnail' => 'image|nullable',
            'id' => 'required'
        ]);

        if ($validator->fails()) {

            echo json_encode([
                'message' => 'Preencha as coisas certinho aí doido',
                'response' => false
            ]);

            exit();

        }

        $data = [];

        $data['id'] = $r->get('id');

        $data['title'] = $r->get('title');

        $data['description'] = $r->get('description');

        if ($r->file('thumbnail')) {

            $filePath = public_path('assets/images/thumbnails/');

            $fileName = $data['id'] . '.' . $r->file('thumbnail')->extension();

            $uploadFile = $r->file('thumbnail')->move($filePath, $fileName);

            $data['thumbnail'] = $uploadFile->getFilename();

        }

        $resultUpdate = Video::where('id', $data['id'])->update($data);

        if ($resultUpdate) {

            echo json_encode([
                'message' => 'Seu vídeo foi atualizado, nice demaaaaaais!',
                'response' => true
            ]);

            exit();

        } else {

            echo json_encode([
                'message' => 'Problemas internos parça, tenta depois aí...',
                'response' => false
            ]);

            exit();

        }

    }

    public function updateStatus(Request $r, $id)
    {

        $resultUpdate = Video::where('id', $r->get('video_id'))->update(['status_id' => $id]);

        if ($resultUpdate) {

            echo json_encode([
                'message' => 'Status do vídeo atualizado com sucesso!',
                'response' => true
            ]);

            exit();

        } else {

            echo json_encode([
                'message' => 'Status do vídeo não foi atualizado...',
                'response' => false
            ]);

            exit();

        }

    }

    public static function findVideoById(int $id)
    {

        $dataVideo = Video::activeVideos()->find($id);

        if (!$dataVideo) return [];
        
        $dataVideo->user;

        return $dataVideo;
    }

    public static function findVideo(string $search)
    {

        return Video::where('title', 'like', "{$search}%")->activeVideos()->get()->toArray();

    }

    public function delete(Request $r)
    {

        if (!isset($r->id)) {

            echo json_encode([
                'message' => 'Vídeo não foi deletado não...',
                'response' => false
            ]);

            exit();

        }

        $video = Video::where('id', $r->id)->first();

        if (!$video) {

            echo json_encode([
                'message' => 'Esse vídeo nem existe mano...',
                'response' => false
            ]);

            exit();

        }

        $videoPath = public_path('assets/videos/' . $video->video);

        $thumbnailPath = public_path('assets/images/thumbnails/' . $video->thumbnail);

        File::delete($videoPath, $thumbnailPath);

        $resultDelete = $video->delete();

        if (!$resultDelete) {
        
            echo json_encode([
                'message' => 'Vídeo não foi deletado não...',
                'response' => false
            ]);

            exit();

        }

        echo json_encode([
            'message' => 'Vídeo deletado com sucesso!',
            'response' => true
        ]);

        exit();

    }
}
