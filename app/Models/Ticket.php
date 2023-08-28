<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    const EXPIRED = 'Expired';
    const VOID = 'Void';
    const VALID = 'Valid';
    protected $fillable = [
        'user_id',
        'cinema_id',
        'sans_id',
        'factor_id',
        'state',
        'code',
        'count',
        'slug',
        'total_price'
    ];

    const STATES = [self::EXPIRED, self::VALID, self::VOID];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    public function sans()
    {
        return $this->belongsTo(Sans::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

}
