<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $table = 'cinemas';
    protected $guarded = [];
    protected $casts = [
        'location' => 'array',
    ];

    public function getScoreAttribute()
    {
        if (is_null($this->attributes['score']))   
            return '0'; 
        
        if (floor($this->attributes['score']) == $this->attributes['score'])
        {
            return intval($this->attributes['score']);
        }

        return number_format($this->attributes['score'] , 1);
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
