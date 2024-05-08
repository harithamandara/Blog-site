<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'approved_at',
        'featured',
    ];

    // Casting published_at attribute to Carbon instance
    protected $casts = [
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // Relationship with author (User)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with categories (Many-to-Many)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Relationship with comments (One-to-Many)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship with likes (Many-to-Many)
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    // Scope to retrieve only published posts
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    // Scope to retrieve posts with a specific category
    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    // Scope to retrieve only featured posts
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    // Scope to retrieve posts ordered by popularity (number of likes)
    public function scopePopular($query)
    {
        $query->withCount('likes')
            ->orderBy("likes_count", 'desc');
    }

    // Scope to search posts by title
    public function scopeSearch($query, string $search = '')
    {
        $query->where('title', 'like', "%{$search}%");
    }

    // Method to get post excerpt (first 150 characters of body)
    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }

    // Method to calculate estimated reading time of the post
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) / 250);

        return ($mins < 1) ? 1 : $mins;
    }

    // Method to get the URL of the post's thumbnail image
    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }
}
