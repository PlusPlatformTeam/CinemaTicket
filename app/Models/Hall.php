<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';

    public function sans()
    {
        return $this->belongsToMany(character::class,'sans_halls',  'hall_id', 'sans_id');
    }

    public function cinemas()
    {
        return $this->belongsToMany(Sans::class, 'cinemas');
    }
}
