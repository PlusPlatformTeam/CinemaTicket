<?php

namespace App\Http\Controllers;

use App\Models\Sans;

class SansController extends Controller
{
    public function Show(Sans $sans)
    {
        $date         = new \DateTime($sans->started_at);
        $jdate        = new \jDateTime(true, true, 'Asia/Tehran');
        $maxRow       = 8; //config()
        $maxCol       = floor($sans->hall[0]->capacity / $maxRow);
        $seatReminder = $sans->hall[0]->capacity - $maxCol * $maxRow;
        
        return view('user.sans', [
            'sans'  => $sans,
            'time'  => [
                'date'  => $jdate->date('l j F', false, true, true, 'Asia/Tehran'),
                'clock' => $date->format('H:i')
            ],
            'seats' => [
                'maxRow'   => $maxRow,
                'maxCol'   => $maxCol,
                'reminder' => $seatReminder 
            ]
        ]);
    }
}
