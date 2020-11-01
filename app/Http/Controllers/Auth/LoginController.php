<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    public function index()
    {
        return view('auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected function authenticated()
    {
        if ( Auth::user()->role == config('app.role.admin') )
        {
            return redirect()->route('admin');
        }
        if ( Auth::user()->role == config('app.role.student') )
        {
            return redirect()->route('student');
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

    /**
     * Custom logout function to use as button
     *
     * @return view(''auth.login);
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
