<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function hRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|max:50|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        //send email 
        Mail::to($request->email)->send(new RegisterMail($request->name));

        return redirect(route('books.index'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function hLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:8'
        ]);

        $is_login = Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ]);

        if (!$is_login) {
            return back();
        }

        return redirect(route('books.index'));
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $dbuser =  User::where('email', '=', $user->email)->first();
        if ($dbuser == null) {
            $reg_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('111222'),
                'oauth_token' => $user->token,
            ]);

            Auth::login($reg_user);
        } else {
            Auth::login($dbuser);
        }

        return redirect(route('books.index'));
    }
}
