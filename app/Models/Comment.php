<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    const PENDING = 'Pending';
    const ACCEPT = 'Accept';
    const REJECT = 'Reject';

    const STATES = [self::PENDING, self::ACCEPT, self::REJECT];
}
