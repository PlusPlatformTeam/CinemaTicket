<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $table = 'cinemas';
    protected $casts = [
        'options' => 'json',
    ];

    public function options()
{
    return $this->hasMany(Option::class, 'id', 'options->option_id');
}
}
