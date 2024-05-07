<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Video;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'video_id',
        'user_id'
    ];

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function video()
    {

        return $this->belongsTo(Video::class);

    }

    public function dataDiff()
    {

        $carbon = new Carbon();

        $this->dataDiff = $carbon->diffForHumans($this->created_at);

    }
}
