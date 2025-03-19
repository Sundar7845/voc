<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function showLoginForm()
    {
        return view('frontend.login');
    }

    function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'   => 'required',
            'employeePassword' => 'required|min:6',
        ]);
        // Find user by employee number
        $user = User::where('name', $request->email)->first();

        // Check if user exists and password matches
        if (!$user || !Hash::check($request->employeePassword, $user->password)) {
            Session::flash('message', 'Invalid credentials!');
            Session::flash('alert-type', 'error');
            return back();
        }

        // Login user
        Auth::login($user);

        Session::flash('message', 'Logged in successfully!');
        Session::flash('alert-type', 'success');

        // Store success message in session
        return redirect('voc');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('message', 'Logged out successfully!');
        Session::flash('alert-type', 'success');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
