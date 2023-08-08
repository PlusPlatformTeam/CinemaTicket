<?php

namespace App\Http\Controllers;

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
            $currentUser = Auth::user()->id;
            $selectedItems = $request->input('selectedItems');
            $sansId = $request->input('sansId');

            foreach ($selectedItems as $item) {
                 Seat::create([
                    'row' => $item['row'],
                    'col' => $item['col'],  
                    'user_id' => $currentUser,
                    'sans_id' =>$sansId,
                              ]);
            }
            
            return response()->json(['message' => 'Request processed successfully'], 200);
        } catch (\Exception $e) {
            // Log or handle the exception
            Log::error($e->getMessage());
            return response()->json(['error' => $e], 500);
        }
    }

    public function preFactor(Request $request)
    {

        $currentUser = Auth::user()->id;
        $selectedItems = $request->input('selectedItems');
        $sansSlug = $request->input('sansSlug');


        dd( $selectedItems,$sansSlug);


        return view('user.preFactor', [

        ]);

    }

}
