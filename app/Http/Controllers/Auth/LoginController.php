<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo(){
         if(Auth()->user()->role == 1){
            return route('admin.dashboard');
         }
         elseif(Auth()->user()->role == 2){
            return route('user.dashboard');
         }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
{
    $input = $request->all();
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
 
    if (auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))) {
        // $user = Auth::getProvider()->retrieveByCredentials($input);
        if(auth()->user()->role == 1){
            // Auth::login($user, $request->get('remember'));
            return redirect()->route('admin.dashboard');
        }elseif(auth()->user()->role == 2){
            // Auth::login($user, $request->get('remember'));
            return redirect()->route('user.dashboard');
        }
        
    }else{
        return redirect()->route('login')->with("error","Email ou mot de passe Incorrect");
    }
}


public function logout(){
    Auth::logout();
    return redirect()->route('login');
}
}
