<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'department_id',
        'academic_year'
    ];

    // Casting published_at attribute to Carbon instance
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relationship with department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function year()
    {
        return $this->belongsTo(User::class, 'year_id');
    }

    // Scope to retrieve only published events
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }


    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }

    // Method to calculate estimated reading time of the event
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) / 250);

        return ($mins < 1) ? 1 : $mins;
    }
}
