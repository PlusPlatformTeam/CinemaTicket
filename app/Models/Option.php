<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';

    public function cinemas()
    {
        return $this->belongsToMany(Cinema::class, 'cinemas_options');
    }
}
