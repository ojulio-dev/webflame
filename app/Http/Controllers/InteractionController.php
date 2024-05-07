<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Interaction;
use App\Models\VideoInteraction;

class InteractionController extends Controller
{
    
    public function listInteractionsByVideo($videoId)
    {

        $interactions = Interaction::all();

        $interactions->each(function($interaction) use ($videoId) {

            $interaction['count'] = VideoInteraction::where([
                'video_id' => $videoId,
                'interaction_id' => $interaction->id
            ])->count();

            $interaction['hasInteracted'] = false;

            $allInteractions = VideoInteraction::where([
                'video_id' => $videoId,
                'interaction_id' => $interaction->id
            ])->get();

            $interaction['hasInteracted'] = $allInteractions->contains('user_id', Auth::id());

        });

        return $interactions;

    }

    public function create(Request $r)
    {

        $data = $r->validate([
            'video_id' => 'required|integer',
            'user_id' => 'required|integer',
            'interaction_id' => 'required|integer'
        ]);

        $validateInteraction = VideoInteraction::where($data)->first();

        if ($validateInteraction) {

            return json_encode([
                'response' => false,
                'message' => 'Esta interação já existe!'
            ]);

        }

        $deleteInteraction = VideoInteraction::where([
            'video_id' => $data['video_id'],
            'user_id' => $data['user_id']

        ]);

        $deleteInteraction->delete();

        $videoInteraction = new VideoInteraction($data);

        if ($videoInteraction->save()) {

            return json_encode([
                'response' => true,
                'message' => 'Interação criado com sucesso!'
            ]);

        } else {

            return json_encode([
                'response' => false,
                'message' => 'Eita, algo deu errado...'
            ]);

        }

    }

    public function destroy(Request $r)
    {
        $data = $r->validate([
            'video_id' => 'required|integer',
            'user_id' => 'required|integer',
            'interaction_id' => 'required|integer'
        ]);

        $videoInteraction = VideoInteraction::where($data)->first();

        if (!$videoInteraction) {
            
            return json_encode([
                'response' => false,
                'message' => 'Interação não encontrada'
            ]);

        }

        $resultDelete = $videoInteraction->delete();

        if ($resultDelete) {

            return json_encode([
                'response' => true,
                'message' => 'Interação removida com sucesso!'
            ]);

        } else {

            return json_encode([
                'response' => false,
                'message' => 'Eita, algo deu errado...'
            ]);

        }

    }

}
