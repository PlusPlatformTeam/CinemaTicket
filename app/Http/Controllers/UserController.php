<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\jDateTime;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request)
    {
        return view('user.login');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('mobile');
    
        $mobile = $credentials['mobile'];
        $user = User::where('mobile', $mobile)->first();
    
        if ($user && $user->verified_at != null) {
            $randomCode=rand(1000, 9999);
            $user->verified_code = $randomCode;
            $user->save();
    
            Log::info($randomCode);
            $request->session()->put('mobile', $mobile);
            return redirect('/verification_code')->with('success', 'code sent')->with('parent_send', 'user.login.verify.code');
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    public function loginVerifyCode(Request $request){
        $credentials = $request->only('verified_code');
        
        $code = $credentials['verified_code'];
        $mobile = $request->session()->get('mobile');
        if (!$mobile) {
            return redirect()->back()->withErrors(['Mobile number not found']);
        }
    
        $user = User::where('mobile', $mobile)->where('verified_code', $code)->first();
    
    
        if ($user) {
            Auth::login($user);
    
            $user->verified_code = null;
            $user->save();
    
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }

    }
    

    public function register(Request $request)
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mobile' => 'required',
        ]);

        $request->session()->put('mobile', $validatedData['mobile']);
        $randomCode=rand(1000, 9999);
        $user = User::create([
            'mobile' => $validatedData['mobile'],
            'verified_code' => $randomCode,  
                      ]);

              Log::info($randomCode);

              return redirect('/verification_code')->with('success', 'code sent')->with('parent_send', 'user.register.verify.code');
            }

    public function registerVerification(Request $request)
    {
        return view('user.verification_code');
    }


    public function verifyCode(Request $request)
    {
        $credentials = $request->only('verified_code');
    
        $code = $credentials['verified_code'];
        $mobile = $request->session()->get('mobile');
        if (!$mobile) {
            return redirect()->back()->withErrors(['Mobile number not found']);
        }
    
        $user = User::where('mobile', $mobile)->where('verified_code', $code)->first();
        
        if ($user) {
            Auth::login($user);
    
            $user->verified_code = null;
            $user->verified_at = Carbon::now();
            $user->save();
    
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    public function resendCode(Request $request)
{
    $mobile = $request->session()->get('mobile');

    if ($mobile) {
        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            $randomCode = rand(1000, 9999);
            $user->verified_code = $randomCode;
            $user->save();

            Log::info($randomCode);

            return response()->json(['message' => 'Code resent'], 200);
        }
    }

    return response()->json(['message' => 'Failed to resend the code'], 400);
}


public function profile(Request $request)
{
    $user = Auth::user();

    return view('user.profile', [
        'user' => $user ,
    ]);
}

public function profileUpdate(Request $request)
{
    $user = $request->user();

    $name = $request->input('user-name');
    $email = $request->input('email');
    $mobile = $request->input('mobile');
    $birthday = $request->input('birthday');


    if ($name != $user->name || $email != $user->email || $mobile != $user->mobile || $birthday != $user->birthday) {
        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->birthday = $birthday;

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    } else {
        return redirect()->back()->with('info', 'No changes were made.');
    }
}





public function profileUpdateAvatar(Request $request)
{
    $user = $request->user();

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $path = $avatar->hashName('avatars'); // Generate a unique filename and save it in the "avatars" directory
        Storage::disk('public')->put($path, file_get_contents($avatar)); // Save the image to the public disk

        $user->avatar = $path;
        $user->save();

        return response()->json(['avatar_url' => asset('storage/' . $path)]);
    }

    return response()->json(['message' => 'No avatar image provided.']);
}



public function transaction(Request $request)
{
    $user = $request->user();
    $tickets = Ticket::where('user_id', $user->id)
        ->with('sans') 
        ->get()
        ->toArray();

    foreach ($tickets as &$ticket) {
        $movieId = $ticket['sans']['movie_id'];
        $movie = DB::table('movies')->where('id', $movieId)->first();
        $jalaliDate = \jDateTime::date('Y/m/d', strtotime($ticket['created_at']), false, true, 'Asia/Tehran');
        $ticket['created_at_jalali'] = $jalaliDate;
        $ticket['sans']['movie'] = $movie;
        if ($movie) {
            $ticket['sans']['movie'] = [
                'title' => $movie->title,
                'slug' => $movie->slug,
            ];
        } else {
            $ticket['sans']['movie'] = null;
        }
    }
    return view('user.transaction', [
        'tickets' => $tickets
    ]);
}


public function tickets(Request $request)
{
    $user = $request->user();
    $tickets = Ticket::where('user_id', $user->id)
        ->with('sans') 
        ->get()
        ->toArray();

    foreach ($tickets as &$ticket) {
        $timestamp = strtotime($ticket["sans"]["started_at"]);
        $date = new \jDateTime(true, true, 'Asia/Tehran');
        $sansDay = $date->date("l j F", $timestamp);
        $sansTime = $date->date("H", $timestamp);
        $movieId = $ticket['sans']['movie_id'];
        $cinemaId= $ticket['sans']['cinema_id'];
        $movie = DB::table('movies')->where('id', $movieId)->first();
        $cinema = DB::table('cinemas')->where('id', $cinemaId)->first();
        $cinemaTitle = $cinema->title;
        $ticket["sansDay"]=$sansDay; 
        $ticket["sansTime"]=$sansTime;        
       
        if ($movie) {
            $ticket['movie'] = [
                'title' => $movie->title,
                'slug' => $movie->slug,
                'main_banner' => $movie->main_banner,
            ];
        } else {
            $ticket['sans']['movie'] = null;
        }
        if ($cinema) {
            $ticket['cinema_title'] = $cinemaTitle;
        } else {
            $ticket['sans']['movie'] = null;
        }
    }
    return view('user.tickets', [
        'tickets' => $tickets,
    ]);

}


public function logout()
{
    Auth::logout();
    return redirect('/');
}








}
