<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\ReportedVideo;
use App\Models\ReportedUser;
use App\Models\VideoStatus;

use App\Models\User;

class ReportController extends Controller
{

    public function index()
    {

        return ReportedVideo::all();

    }

    public function validateReportVideo($videoId, $userId)
    {

        return ReportedVideo::where(['video_id' => $videoId, 'reported_user_id' => $userId, 'checked' => 0])->get();
        
    }

    public function validateReportUser($reportedUser, $reportingUser)
    {

        return ReportedUser::where(['reporting_user_id' => $reportingUser, 'reported_user_id' => $reportedUser, 'checked_at' => null])->get();

    }

    public function reportVideo(Request $r)
    {
        
        $validator = Validator::make($r->all(), [
            'reportedUser' => 'required|integer',
            'reportingUser' => 'required|integer',
            'videoId' => 'required|integer',
            'reason' => 'required|min:5|max:255',
        ], [
            'reason.required' => 'Preencha o furmulário antes, mano',
            'reason.min' => 'O número mínimo de caracteres do furmulário é 5',
            'reason.max' => 'O limite de caracteres do formulário foi ultrapassado...'
        ]);

        if ($validator->fails()) {

            echo json_encode([
                'response' => false,
                'message' => $validator->errors()->first()
            ]);

            exit();

        };

        $reportedVideo = new ReportedVideo();

        $reportedVideo->reported_user_id = $r->get('reportedUser');

        $reportedVideo->reporting_user_id = $r->get('reportingUser');

        $reportedVideo->video_id = $r->get('videoId');

        $reportedVideo->reason = $r->get('reason');

        if (!$reportedVideo->save()) {

            echo json_encode([
                'response' => false,
                'message' => 'Eita, algo deu errado...'
            ]);

            exit();

        }

        echo json_encode([
            'response' => true,
            'message' => 'Muito bem! Este vídeo suspeito será devidamente investigado, He He'
        ]);

        exit();

    }

    public function reportUser(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'reporting-user-id' => 'required|integer',
            'reported-user-id' => 'required|integer',
            'reason' => 'required|min:5|max:255'
        ], [
            'reason.required' => 'Preencha o furmulário antes, mano',
            'reason.min' => 'O número mínimo de caracteres do furmulário é 5',
            'reason.max' => 'O limite de caracteres do formulário foi ultrapassado...'
        ]);

        if ($validator->fails()) {

            echo json_encode([
                'response' => false,
                'message' => $validator->errors()->first()
            ]);

            exit();

        };

        $reportedUser = new ReportedUser();

        $reportedUser->reporting_user_id = $r->get('reporting-user-id');

        $reportedUser->reported_user_id = $r->get('reported-user-id');

        $reportedUser->reason = $r->get('reason');

        if (!$reportedUser->save()) {

            echo json_encode([
                'response' => false,
                'message' => 'Eita, algo deu errado...'
            ]);

            exit();

        }

        echo json_encode([
            'response' => true,
            'message' => 'Muito bem. Este canalzinho suspeito será devidamente investigado, He He'
        ]);

        exit();
    }

    public function getReportedVideos()
    {

        return ReportedVideo::with('video')->where('checked', 0)->get();


    }

    public function getReportedVideo($id)
    {

        $reportData = ReportedVideo::find($id);

        if (!$reportData) return [];

        $reportData->video;

        $reportData->reportedUser;

        $reportData->reportingUser;

        return $reportData;

    }

    public function removeReportedVideo($id)
    {

        $reportedVideo = ReportedVideo::with('video')->find($id);

        $reportedVideo->update(['checked' => 1]);

        $canceledStatus = VideoStatus::where('name', 'canceled')->first();

        $reportedVideo->video->update(['status_id' => $canceledStatus->id]);

        return $reportedVideo;

    }

    public function allowReportedVideo($id)
    {

        $reportedVideo = ReportedVideo::with('video')->find($id);

        $reportedVideo->update(['checked' => 1]);

        return $reportedVideo;

    }

    public function getReportedUsers()
    {

        $reportedUsers = ReportedUser::with(['reportedUser', 'reportingUser'])->where('checked_at', null)->get();

        $reportedUsers->map(function($reportedUser) {

            $reportedUser->reportedUser->videos;

            $reportedUser->reportedUser->subscribers;

        });

        return json_encode($reportedUsers);

    }

    public function getReportedUser($id)
    {

        $reportedUser = ReportedUser::with(['reportedUser', 'reportingUser'])->where('id', $id)->first();

        return json_encode($reportedUser);

    }

    public function removeReportedUser($id)
    {

        $reportedUser = ReportedUser::find($id);

        if (!$reportedUser) {

            return json_encode(['message' => 'ID inválido...']);

            exit();

        }

        $reportedUser->update(['checked_at' => date('Y-m-d H:i:s', strtotime('now'))]);

        $reportedUser->reportedUser->status = 0;

        $reportedUser->reportedUser->save();

        return $reportedUser;

    }

    public function allowReportedUser($id)
    {

        $reportedUser = ReportedUser::find($id);

        if (!$reportedUser) {

            return json_encode(['message' => 'ID inválido...']);

            exit();

        }

        $reportedUser->update(['checked_at' => date('Y-m-d H:i:s', strtotime('now'))]);

        $reportedUser->reportedUser;

        return $reportedUser ?? [];

    }
}
