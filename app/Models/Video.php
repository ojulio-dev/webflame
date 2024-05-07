<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\View;
use App\Models\Comment;
use App\Models\VideoStatus;
use App\Models\VideoInteraction;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status_id'
    ];

    public function scopeActiveVideos($query)
    {

        return $query->whereHas('user', function ($query) {

            $query->active();
            
        });

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(VideoStatus::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeInteractions()
    {

        $interactions = Interaction::all();

        $interactions->each(function($interaction) {

            $interaction['count'] = VideoInteraction::where([
                'video_id' => $this->id,
                'interaction_id' => $interaction->id
            ])->count();

            $interaction['hasInteracted'] = false;

            $allInteractions = VideoInteraction::where([
                'video_id' => $this->id,
                'interaction_id' => $interaction->id
            ])->get();

            $interaction['hasInteracted'] = $allInteractions->contains('user_id', Auth::id());

        });

        return $interactions;
    }
}
