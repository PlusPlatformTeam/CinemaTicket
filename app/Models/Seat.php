<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $table = 'seats';
    protected $fillable = [
        'row',
        'col',
        'sans_id',
        'user_id',
    ];

    public function sans()
    {
        return $this->belongsTo(Sans::class);
    }
}
