<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Sluggable: https://github.com/cviebrock/eloquent-sluggable

    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'slug',
        'url',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
