<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\LoginLink;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists(User::class, 'email')]
        ]);

        Mail::to($request->email)->send(new LoginLink($request->email));
        return redirect()->back()->with([
            'success' => 'Your login link sent check your email box.'
        ]);
    }

    public function session($email)
    {
        $user = User::whereEmail($email)->first();
        auth()->login($user);
        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        Mail::to($request->email)->send(new LoginLink($user->email));

        return redirect()->back()->with([
            'success' => 'Your login link sent check your email box.'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
