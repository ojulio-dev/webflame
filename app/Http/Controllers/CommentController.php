<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Video;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($videoId)
    {
        
        $comments = Comment::with(['user', 'video', 'video.user'])->where('video_id', $videoId)->orderBy('created_at', 'desc')->get();

        $comments->map(function($comment) {

            $comment->dataDiff();

        });

        return $comments;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {
     
        $data = $r->validate([
            'comment' => 'required|string',
            'video_id' => 'required|integer'
        ]);

        $data['user_id'] = Auth::user()->id;

        $comment = new Comment($data);

        if ($comment->save()) {

            return json_encode([
                'response' => true,
                'message' => 'Comentário cadastrado com sucesso!'
            ]);

        } else {

            return json_encode([
                'response' => false,
                'message' => 'Algo deu errado...'
            ]);

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
