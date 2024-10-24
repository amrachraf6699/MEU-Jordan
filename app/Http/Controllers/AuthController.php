<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }


    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $this->MakeActivity('قام بتسجيل الدخول' , $request);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'البيانات المدخلة غير صحيحة.'
        ])->withInput();
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'recover_key' => 'required|string'
        ]);

        $user = User::where('username', $request->username)
        ->whereHas('key', function($query) use ($request) {
            $query->where('key', $request->recover_key);
        })->first();

        if($user) {
            session()->put('user_reset_id', $user->id);
            return redirect()->route('resetForm');
        }

        return back()->withErrors([
            'recover_key' => 'البيانات المدخلة غير صحيحة.'
        ])->withInput();
    }

    public function resetForm()
    {
        return view('auth.reset');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user_id = session()->get('user_reset_id');

        if(!$user_id) {
            return redirect()->route('login');
        }

        $user = User::find($user_id);

        $user->update([
            'password' => $request->password
        ]);

        session()->forget('user_reset_id');

        return redirect()->route('login');
    }

}
