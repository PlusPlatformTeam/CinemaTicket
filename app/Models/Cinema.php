<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $table = 'cinemas';

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
    
    public function options()
    {
        return $this->belongsToMany(Option::class, 'cinemas_options');
    }

    public function sans()
    {
        return $this->belongsToMany(Sans::class, 'sans_cinemas', 'cinema_id', 'sans_id');
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
