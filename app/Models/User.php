<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Subscriber;
use App\Models\Video;
use App\Models\View;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function scopeActive($query)
    {

        return $query->where('status', 1);

    }

    public function isAdmin()
    {

        return $this->is_admin === 1;

    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'user_channel_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id', 'id');
    }

    public function views()
    {
        return $this->hasMany(View::class, 'user_id', 'id');
    }
}
