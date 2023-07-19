<?php
namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
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
    return view('user.template_profile');

}




}
