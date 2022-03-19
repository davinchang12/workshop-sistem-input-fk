<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\SpecificDomainsOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index() {
        return view('welcome', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request) {
        return $request->validate([
            'email' => ['required', 'email', new SpecificDomainsOnly],
        ]);
        
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if(Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }
        
        // return back()->with('loginError', 'Login failed!');
        
        // return redirect()->intended('/dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
