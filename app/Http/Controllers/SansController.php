<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Factor;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Sans;
use App\Models\SansCinemas;
use App\Models\SansHalls;
use App\Models\SansMovies;
use App\Models\Score;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            $data          = explode(",",Cache::get($currentUser));
            $factorId      = $data[0];
            $totalPrice    = $data[2];

            Factor::where('id', $factorId)
                    ->update([
                    'state' => Factor::PAID,
                    'paid_time' => date('Y-m-d H:i:s'),
            ]);

            Ticket::create([
                'user_id' => $currentUser,
                'cinema_id' => $sans["cinema_id"],
                'sans_id' => $sansId,   
                'factor_id' =>  $factorId,  
                'state' => Ticket::VALID,
                'code'  => rand(100000, 999999) ,
                'count' => count($selectedItems),
                'slug' => rand(1000, 9999),
                'total_price' =>  $totalPrice,
            ]);

            $movie        = Movie::find($sans['movie_id']);
            $movie->sale += $totalPrice;
            $movie->save();

            $sans['capacity'] -= count($selectedItems);
            $sans->save();

            foreach ($selectedItems as $item) {
                Seat::create([
                    'row' => $item['row'],
                    'col' => $item['col'],
                    'user_id' => $currentUser,
                    'sans_id' => $sansId,
                ]);
            }

            return redirect()->route('user.tickets');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function preFactor(Request $request)
    {
        $currentUser           = Auth::user()->id;
        $seatsDetail           = json_decode($request->input('selected_items'));
        $sansSlug              = $request->input('sansSlug');
        $sans                  = Sans::where('slug', $sansSlug)->first();
        $date                  = new \DateTime($sans->started_at);
        $jdate                 = new \jDateTime(true, true, 'Asia/Tehran');
        $countSelectedSeat     = count($seatsDetail);
        $totalPriceCount       = $countSelectedSeat * $sans->price;
        $taksPrice             = 0.04 * $totalPriceCount;
        $totalPrice            = $totalPriceCount + $taksPrice;

       $factor = Factor::create([
            'user_id' => $currentUser,
            'state' => Factor::UNPAID,       
        ]);


        Cache::set($currentUser,$factor["id"].",".$totalPrice.','.$totalPriceCount);

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
            'started_at' => "{$gregorianDate[0]}-{$gregorianDate[1]}-{$gregorianDate[2]} " .$request->time.':00',
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

    public function Delete(Request $request)
    {
        $isReservedSeat = Seat::where('sans_id', $request->sans)->first();

        if ($isReservedSeat)
        {
            return response(['message' => 'این سانس را نمی توان پاک کرد'], 403);
        }
        
        $sans = Sans::find($request->sans);
        if ($sans){
            $sans->delete();
            return response(['message' => 'سانس با موفقیت پاک شد']);
        }
    }

    public function GetMovies(Request $request)
    {
        $jdate      = new \jDateTime(true, true, 'Asia/Tehran');
        $timezone   = new \DateTimeZone('+0330');
        $start      = new \DateTime('now', $timezone);
        $startTime  = date('Y-m-d') < $request->date ? '00:00:00' : $start->format('H:i:s');
        $start      = $request->date.' '.$startTime;
        $end        = $request->date . ' 23:59:59';
        $sans       = Sans::with(['cinema', 'movie.characters', 'movie.category', 'hall'])
                        ->where('cinema_id', $request->cinema)
                        ->whereBetween('started_at', [$start, $end])
                        ->get()->toArray();
        $movies = [];
        foreach ($sans as $key => $value) {
            $movie = $value['movie'][0];
            $movie['score']      = convertDigitsToFarsi($movie['score'].'/'.'5');
            $movie['totalScore'] = convertDigitsToFarsi(Score::where('scorable_type', Movie::class)
                                                             ->where('scorable_id', $movie['id'])->count());
            if (array_key_exists($movie['slug'], $movies)) {
                $movies[$movie['slug']]['sans'][] = [
                    'id' => $value['id'],
                    'slug' => $value['slug'],
                    'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                    'name' => $value['hall'][0]['title'],
                    'price' => convertDigitsToFarsi(number_format($value['price'])),
                ];
            } else {
                $movie['sans'][] = [
                    'id' => $value['id'],
                    'slug' => $value['slug'],
                    'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                    'name' => $value['hall'][0]['title'],
                    'price' => convertDigitsToFarsi(number_format($value['price'])),
                ];
            
                $movies[$movie['slug']] = $movie;
            }
        } 
        return response(['data' => $movies , 'total' => count($movies)]);
    }

    public function GetCinemas(Request $request)
    {
        $selectedCityId = isset($_COOKIE['selectedCityId']) ? $_COOKIE['selectedCityId'] : null;
        $jdate      = new \jDateTime(true, true, 'Asia/Tehran');
        $timezone   = new \DateTimeZone('+0330');
        $start      = new \DateTime('now', $timezone);
        $startTime  = date('Y-m-d') < $request->date ? '00:00:00' : $start->format('H:i:s');
        $start      = $request->date.' '.$startTime;
        $end        = $request->date . ' 23:59:59';
        $allSans    = Sans::with(['cinema', 'hall'])
                ->where('movie_id', $request->movie)
                ->whereBetween('started_at', [$start, $end])
                ->select('sans.*')
                ->get()
                ->toArray();

        if ($selectedCityId) {
            $sans = Sans::with(['cinema', 'hall'])
                ->join('cinemas', 'sans.cinema_id', '=', 'cinemas.id')
                ->where('movie_id', $request->movie)
                ->whereBetween('started_at', [$start, $end])
                ->where('cinemas.city_id', $selectedCityId)
                ->select('sans.*')
                ->get()
                ->toArray();
        
            if (collect($sans)->isEmpty()) {
                $sans = $allSans;
            }
        } else {
            $sans = $allSans;
        }

        $cinemas = [];
        foreach ($sans as $key => $value) {
            $cinema = $value['cinema'][0];
            $cinema['score'] = convertDigitsToFarsi('5 / ' . $cinema['score']);
            if (array_key_exists($cinema['id'], $cinemas)) {
                $cinemas[$cinema['id']]['sans'][] = [
                    'id' => $value['id'],
                    'slug' => $value['slug'],
                    'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                    'name' => $value['hall'][0]['title'],
                    'price' => convertDigitsToFarsi(number_format($value['price'])),
                ];
            } else {
                $cinema['sans'][] = [
                    'id' => $value['id'],
                    'slug' => $value['slug'],
                    'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                    'name' => $value['hall'][0]['title'],
                    'price' => convertDigitsToFarsi(number_format($value['price'])),
                ];
        
                $cinemas[$cinema['id']] = $cinema;
            }
        }

        return response(['data' => $cinemas , 'total' => count($cinemas)]);
    }
}