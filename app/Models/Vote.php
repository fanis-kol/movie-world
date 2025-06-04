<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = [
        'user_id',
        'movie_id',
        'vote',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
