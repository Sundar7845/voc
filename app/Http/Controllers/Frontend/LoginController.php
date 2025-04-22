<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Roles;
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

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required',
            'employeePassword' => 'required|min:6',
        ]);

        // Attempt to find user
        $user = User::where('name', $request->email)->first();

        // Check for user existence and password validity
        if (!$user || !Hash::check($request->employeePassword, $user->password)) {
            return $this->sendError('Invalid credentials!');
        }

        // Check if user is active
        if ($user->is_active != 1) {
            return $this->sendError('Your account is inactive. Please contact the administrator.');
        }

        // Login user
        Auth::login($user);

        Session::flash('message', 'Logged in successfully!');
        Session::flash('alert-type', 'success');
        
        // Redirect based on role
        if ($user->role_id == Roles::SUPERADMNIN) {
            return redirect('dashboard');
        } elseif ($user->role_id == Roles::ADMIN) {
            return redirect('dashboard');
        } elseif ($user->role_id == Roles::SHOWROOM) {
            return redirect('voc');
        }

        // Unknown role fallback
        return $this->sendError('Invalid credentials!');
    }

    protected function sendError($message)
    {
        Session::flash('message', $message);
        Session::flash('alert-type', 'error');
        return back();
    }


    public function logout()
    {
        Auth::logout();
        Session::flash('message', 'Logged out successfully!');
        Session::flash('alert-type', 'success');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
