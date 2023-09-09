<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $table = 'payment_logs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
