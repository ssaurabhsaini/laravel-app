<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    protected function redirectTo( Request $request )
    {
        if( Auth()->user()->role == 2 ) {
            return route('startup.dashboard');
        } else if( Auth()->user()->role == 3 ) {
            return route('investor.dashboard');
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

    public function login( Request $request ) {
        $input = $request->all();
        $this->validate( $request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if( Auth()->attempt(['email' => $input['email'], 'password' => $input['password']]) ) {
            if(Auth()->user()->role == 2) {
                return redirect()->route('startup.dashboard');
            } else {
                return redirect()->route('investor.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email or password are wrong.');
        }
    }
}
