<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    const PLAYING = 'Playing';
    const EXPIRED = 'Expired';

    const STATES = [self::PLAYING, self::EXPIRED];
}
