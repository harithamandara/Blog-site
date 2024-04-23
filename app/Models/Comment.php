<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    // making the relationship with the user who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the post the comment
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
