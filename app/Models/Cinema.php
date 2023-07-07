<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $table = 'cinemas';

    public function options()
    {
        return $this->belongsToMany(Option::class, 'cinemas_options');
    }
}
