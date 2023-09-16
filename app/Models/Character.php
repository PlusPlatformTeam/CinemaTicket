<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    use HasFactory;
    protected $table = 'characters';
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class,'video_characters');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }



}
