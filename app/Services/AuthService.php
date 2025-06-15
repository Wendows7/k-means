<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function authenticate($request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

//            return response json
            return true;

        }

        return false;
    }

    public function resetPassword($request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = $this->user->where('email', auth()->user()->email)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->save();
            return true;
        }

        return false;
    }
}
