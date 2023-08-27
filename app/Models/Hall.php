<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';
    protected $guarded = [''];

    public function sans()
    {
        return $this->belongsToMany(Sans::class,'sans_halls',  'hall_id', 'sans_id');
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }
}