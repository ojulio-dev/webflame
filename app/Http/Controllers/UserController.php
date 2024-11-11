<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoStatus;
use App\Models\Interaction;

use App\Models\Subscriber;

class UserController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);

        $user['creation_date'] = date('d \d\e M \d\e Y', strtotime($user->created_at));

        return view('app.users.profile.main', compact('user'));
    }

    public function videos()
    {

        $videos = $this::listVideosByUserId(Auth::user()->id);

        $interactions = Interaction::all();

        return view('app.users.profile.videos', ['videos' => $videos, 'interactions' => $interactions]);
    }

    public function findUserView(Request $r)
    {

        $dataUser = $this->findUserByUsername($r->username);

        if (!$dataUser) {

            return redirect(route('home'));

        }

        $dataUser['hasSubscriber'] = Subscriber::where([
            'user_subscriber_id' => Auth::user()->id,
            'user_channel_id' => $dataUser->id
        ])->first() ? true : false;

        $dataUser['views'] .= $dataUser['views'] == 1 ? ' visualização' : ' visualizações';

        $dataUser['year_created'] = date_format($dataUser['created_at'], 'Y');

        return view('app.users.findUser', compact(['dataUser']));

    }

    /**
     * Find user by name or username
     *
     * @param string $search Name or Username
     * @return array Return info users array
    */
    public static function findUsers(string $search)
    {

        $dataUser = User::with(['videos'])

            ->where('username', 'like', "{$search}%")
            ->orWhere('name', 'like', "{$search}%")
            ->active()

        ->get();

        if (!$dataUser) return [];

        $dataUser = $dataUser->map(function($user) {

            $data = $user;

            $data['subscribers'] = $data->subscribers->count();

            $data['views'] = $data->views->count();

            $data['year_created'] = date_format($data['created_at'], 'Y');

            return $data;

        });

        return $dataUser->toArray();

    }

    public static function findUserByUsername($username)
    {

        $dataUser = User::with(['videos' => function($query) {

            $query->whereHas('status', function ($query) {
                $query->where('name', 'public'); // Substitua 'ativo' pelo nome do status que deseja verificar
            });

        }])->where('username', $username)->active()->first();

        if (!$dataUser) return [];

        $dataUser['subscribers'] = $dataUser->subscribers->count();

        $dataUser['views'] = $dataUser->views->count();

        $dataUser['year_created'] = date_format($dataUser['created_at'], 'Y');

        return $dataUser;

    }

    public static function listVideosByUserId($id)
    {

        $videos = Video::activeVideos()->where('user_id', $id)->get();

        foreach ($videos as $key => $video) {

            $videos[$key]['views_count'] = $video->views->count();

            $videos[$key]['views_count'] .= $videos[$key]['views_count'] == 1 ? ' visualização' : ' visualizações';

            $videos[$key]['user'] = $video->user;

            $videos[$key]['status'] = $video->status;

        }

       return $videos;

        exit();
        
    }

    public function update(Request $r)
    {

        if (!isset($r->id)) {

            $r->merge(['id' => Auth::user()->id ?? null]);

        }

        $validator = Validator::make($r->all(), [
            'id' => 'required',
            'name' => 'required|min:4',
            'username' => 'required|min:4',
            'icon' => 'image|nullable'
        ]);

        if ($validator->fails()) {

            echo json_encode([
                'message' => 'Preencha as coisas certinho aí doido',
                'response' => false
            ]);

            exit();

        }

        if (User::where('username', $r->username)->count() >= 1) {

            echo json_encode([
                'message' => 'Já existe alguém com este Username. Tente outro...',
                'response' => false
            ]);

            exit();

        }

        $data = $r->all();

        if ($r->file('icon')) {

            $iconPath = public_path('assets/images/users/');

            $iconName = $r->id . '.' . $r->file('icon')->extension();

            $uploadFile = $r->file('icon')->move($iconPath, $iconName);

            $data['icon'] = $uploadFile->getFilename();

        } else {

            unset($data['icon']);

        }

        $resultUpdate = User::where('id', $r->id)->update($data);

        if ($resultUpdate) {

            echo json_encode([
                'message' => 'Boaaaaa, agora o perfil tá bonitão!',
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

}
