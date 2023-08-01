<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    const PLAYING = 'Playing';
    const EXPIRED = 'Expired';

    const STATES = [self::PLAYING, self::EXPIRED];

    public function getScoreAttribute()
    {
        $score = $this->averageScore();
        if (is_null($score))   
            return '0'; 
        
        if (floor($score) == $score)
        {
            return intval($score);
        }

        return number_format($score, 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function characters()
    {
        return $this->belongsToMany(character::class, 'video_characters');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comments');
    }

    public function sans()
    {
        return $this->belongsToMany(Sans::class, 'sans_movies', 'movie_id', 'sans_id');
    }

    public function scores()
    {
        return $this->morphMany(Score::class, 'scorable');
    }

    public function averageScore()
    {
        return $this->scores()->average('score');
    }
}
