<?php
namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Support\Facades\Log;

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
    
        if ($user) {
            Auth::login($user);
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


        $randomCode=rand(1000, 9999);
        $user = User::create([
            'mobile' => $validatedData['mobile'],
            'verified_code' => $randomCode,  
                      ]);

                      Log::info($randomCode);

        // You can perform any additional logic or redirect as needed
        return redirect('/register_verification')->with('success', 'Registration successful');
    }

    public function registerVerification(Request $request)
    {
        return view('user.register_verification');
    }
}
