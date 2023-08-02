<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'cinema_id',
        'movie_id',
        'user_id',
    ];

    const PENDING = 'Pending';
    const ACCEPT = 'Accept';
    const REJECT = 'Reject';

    const STATES = [self::PENDING, self::ACCEPT, self::REJECT];

    public function movie()
    {
        return $this->belongsTo(Movie::class,'movies');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'users');
    }



}
