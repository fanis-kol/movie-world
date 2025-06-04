<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    // Optional: Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
