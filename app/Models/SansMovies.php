<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SansMovies extends Model
{
    use HasFactory;
    protected $table = 'sans_movies';
    protected $guarded = [''];

}
