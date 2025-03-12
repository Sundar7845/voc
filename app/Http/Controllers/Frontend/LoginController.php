<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLoginForm()
    {
        return view('frontend.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Login Successful');
        }

        return back()->withErrors(['mobile' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
