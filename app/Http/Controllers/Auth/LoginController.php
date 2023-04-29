<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        if ($user->status === 0) {
            return back()->withErrors([
                'email' => 'Your account is not approved yet.',
            ]);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
   public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
