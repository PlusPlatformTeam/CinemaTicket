<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function Show(Request $request)
    {
        return view('admin.manage_tickets', [
            'tickets' => Ticket::paginate(4)
        ]);
    }

    public function search(Request $request)
    {
        $jDate       = new \jDateTime(true, true, "Asia/Tehran");
        $started_at  = explode('/', $request->started_at);
        $end_at      = explode('/', $request->end_at);
        $startedDate = $jDate->toGregorian($started_at[0], $started_at[1], $started_at[2]);
        $endDate     = $jDate->toGregorian($end_at[0], $end_at[1], $end_at[2]);

        $start = "{$startedDate[0]}-{$startedDate[1]}-{$startedDate[2]} 00:00:00";
        $end   = "{$endDate[0]}-{$endDate[1]}-{$endDate[2]} 23:59:59";

        $query = PaymentLog::query();

        if ($request->has('hall') && !empty($request->hall)) {
            $query->where('hall_id', $request->hall);
        }

        if ($request->has('movie')  && !empty($request->movie)) {
            foreach ($request->movie as $movie) {
                $query->orWhere('movie_id', $movie);
            }
        }

        if ($request->has('started_at')  && !empty($request->started_at)) {
            $query->where('created_at', '>=', $start);
        }

        if ($request->has('end_at')  && !empty($request->end_at) ) {
            $query->where('created_at', '<=', $end);
        }

        if ($request->has('cinema') && !empty($request->cinema) && $request->cinema != '0') {
            $query->where('cinema_id', $request->cinema);
        }

        $result = $query->with(['user', 'cinema', 'factor', 'movie', 'hall'])->get();

        $totalPrice = 0;
        foreach($result as &$payment)
        {
            $totalPrice += $payment->factor->price;
            $payment->paid_time =  $jDate->date('j F Y', strtotime($payment->factor->paid_time));
            $payment->factor->price = convertDigitsToFarsi(number_format($payment->factor->price));
        }
        return response()->json(['payments' => $result,'sql'=>$query->toSql(), 'total' => count($result), 'totalPrice' => convertDigitsToFarsi(number_format($totalPrice))]);
    }
}
