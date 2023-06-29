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

    const STATES = [self::EXPIRED, self::VALID, self::VOID];
}
