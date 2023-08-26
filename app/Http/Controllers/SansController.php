<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Sans;
use App\Models\SansCinemas;
use App\Models\SansHalls;
use App\Models\SansMovies;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SansController extends Controller
{
    public function Index(Sans $sans)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $currentUser = Auth::user()->id;
        $date = new \DateTime($sans->started_at);
        $jdate = new \jDateTime(true, true, 'Asia/Tehran');
        $maxRow = $sans->hall[0]->maxRow;
        $maxCol = floor($sans->hall[0]->capacity / $maxRow);
        $seatReminder = $sans->hall[0]->capacity - $maxCol * $maxRow;
        $seats = Seat::where('sans_id', $sans->id)->get();



        $rowReserved = [];
        $colReserved = [];
        $currentUserReserved = [];
        if ($seats) {
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
            'rowReserved' => $rowReserved ? $rowReserved : null,
            'colReserved' => $colReserved ? $colReserved : null,
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
        $countSelectedSeat = count($seatsDetail);
        $totalPriceCount = $countSelectedSeat * $sans->price;
        $taksPrice = 0.04 * $totalPriceCount;
        $totalPrice = $totalPriceCount + $taksPrice;

        return view('user.preFactor', [
            'seatsDetail' => $seatsDetail,
            'sans' => $sans,
            'totalPriceCount' => $totalPriceCount,
            'taksPrice' => $taksPrice,
            'totalPrice' => $totalPrice,
            'time' => [
                'date' => $jdate->date('l j F', false, true, true, 'Asia/Tehran'),
                'clock' => $date->format('H:i')
            ],

        ]);
    }

    public function Show()
    {
        $today = date('Y-m-d H:i:s');
        $jdate = new \jDateTime(true, true, 'Asia/Tehran');

        $sans = Sans::with(['hall', 'movie', 'cinema'])
            ->where('started_at', '>', $today)
            ->paginate(2); 

        $sans->getCollection()->transform(function ($item) use ($jdate) {
            $started_at = $item->started_at;
            $transformedStartedAt = [];
            $transformedStartedAt['date'] = $jdate->date('j F', strtotime($started_at));
            $transformedStartedAt['clock'] = $jdate->date('H:i', strtotime($started_at));

            $item->started_at = $transformedStartedAt;
            $item->hall = isset($item->hall[0]) ? $item->hall[0] : null;
            $item->cinema = isset($item->cinema[0]) ? $item->cinema[0] : null;
            $item->movie = isset($item->movie[0]) ? $item->movie[0] : null;

            return $item;
        });

        return view('admin.manage_sans', [
            'sans' => $sans,
            'cinemas' => Cinema::all(['id', 'title']),
            'movies' => Movie::all(['id', 'title'])
        ]);
    }

    public function Create(Request $request)
    {
        $jDate = new \jDateTime(true, true, "Asia/Tehran");
        $started_at = explode('/', $request->started_at);
        $gregorianDate = $jDate->toGregorian($started_at[0], $started_at[1], $started_at[2]);

        $hall = Hall::find($request->hall);

        $sans = Sans::create([
            'cinema_id' => $request->cinema,
            'movie_id' => $request->movie,
            'hall_id' => $request->hall,
            'started_at' => "{$gregorianDate[0]}-{$gregorianDate[1]}-{$gregorianDate[2]}",
            'slug' => Str::random(10),
            'price' => $request->price,
            'capacity' => $hall->capacity
        ]);

        SansCinemas::create([
            'sans_id' => $sans->id,
            'cinema_id'=> $request->cinema
        ]);
        SansHalls::create([
            'sans_id' => $sans->id,
            'hall_id'=> $request->hall
        ]);
        SansMovies::create([
            'sans_id' => $sans->id,
            'movie_id'=> $request->movie
        ]);

        return redirect()->back()->with(
            'success' , 'سانس با موفقیت ایجاد شد',
        );
    }
}
