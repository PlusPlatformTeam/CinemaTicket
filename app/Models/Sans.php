<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sans extends Model
{
    use HasFactory;
    protected $table = 'sans';
    protected $guarded = [''];
    
    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'sans_movies', 'sans_id', 'movie_id');
    }
    public function hall()
    {
        return $this->belongsToMany(Hall::class, 'sans_halls', 'sans_id', 'hall_id');
    }

    public function cinema()
    {
        return $this->belongsToMany(Cinema::class, 'sans_cinemas', 'sans_id', 'cinema_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
   
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}