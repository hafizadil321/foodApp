<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminLoginForm()
    {
        if (Auth::check()){
            if(auth()->user()->hasRole('superadministrator'))
            {
                return redirect('/dashboard');
            }
        }
        $title = 'Admin Login';
        return view('auth.login', compact('title'));
    }
}
