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

    use AuthenticatesUsers{
        logout as preforLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loggin(){
        return view('admin.auth.login');
    }
    public function login(){
        Validator(request()->all(),
        [
        'email'=>'required|exists:admins|string|email|max:255',
        'password'=>'required|min:8|'
        ])->validate();

        if (auth()->attempt(request()->only(['email','password']))) {
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['email'=>'invalid credentiales']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        session()->flush();
        session()->regenerate();
        return redirect('home');
    }
}
