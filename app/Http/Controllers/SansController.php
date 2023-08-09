<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Sans;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SansController extends Controller
{
    public function Show(Sans $sans)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }
    
        $currentUser = Auth::user()->id;
        $date = new \DateTime($sans->started_at);
        $jdate = new \jDateTime(true, true, 'Asia/Tehran');
        $maxRow = 8; 
        $maxCol = floor($sans->hall[0]->capacity / $maxRow);
        $seatReminder = $sans->hall[0]->capacity - $maxCol * $maxRow;
        $seats = Seat::where('sans_id', $sans->id)->get();
    


        $rowReserved = [];
        $colReserved = [];
        $currentUserReserved = [];
        if($seats){
               foreach ($seats as $seat) {
            $rowReserved[] = $seat->row; 
            $colReserved[] = $seat->col;
            $currentUserReserved[] = ($seat->user_id === $currentUser ? true : false);
        }
        }
     
    
        return view('user.sans', [
            'sans' => $sans,
            'time' => [
                'date' => $jdate->date('l j F', false, true, true, 'Asia/Tehran'),
                'clock' => $date->format('H:i')
            ],
            'rowReserved' => $rowReserved?$rowReserved:null,
            'colReserved' => $colReserved?$colReserved:null,
            'currentUserReserved' => $currentUserReserved,
            'seats' => [
                'maxRow' => $maxRow,
                'maxCol' => $maxCol,
                'reminder' => $seatReminder,
            ]
        ]);
    }


    public function buy(Request $request)
{
    try {
        $currentUser   = Auth::user()->id;
        $selectedItems = json_decode($request->input('selected_items'), true);
        $sansId        = $request->input('sansId');
        $sans          = Sans::where('id', $sansId)->first();

        foreach ($selectedItems as $item) {
            Seat::create([
                'row' => $item['row'],
                'col' => $item['col'],  
                'user_id' => $currentUser,
                'sans_id' => $sansId,
            ]);
        }

        return redirect()->route('movie.show', ['movie' => $sans->movie[0]->slug]);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function preFactor(Request $request)
    {
        $seatsDetail = json_decode($request->input('selected_items'));
        $sansSlug    = $request->input('sansSlug');
        $sans        = Sans::where('slug', $sansSlug)->first();
        $date = new \DateTime($sans->started_at);
        $jdate = new \jDateTime(true, true, 'Asia/Tehran');
        $countSelectedSeat=count($seatsDetail);
        $totalPriceCount=$countSelectedSeat*$sans->price;
        $taksPrice = 0.04 * $totalPriceCount;
        $totalPrice=$totalPriceCount+$taksPrice;

        return view('user.preFactor', [
        'seatsDetail'=>$seatsDetail,
        'sans'=>$sans,
        'totalPriceCount'=>$totalPriceCount,
        'taksPrice'=>$taksPrice,
        'totalPrice'=>$totalPrice,
        'time' => [
            'date' => $jdate->date('l j F', false, true, true, 'Asia/Tehran'),
            'clock' => $date->format('H:i')
        ],

        ]);

    }

}
