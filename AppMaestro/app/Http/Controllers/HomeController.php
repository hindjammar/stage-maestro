<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    {if (Auth::user()->hasRole('admin')) {
        return view('admin.dashboard');
    } elseif (Auth::user()->hasRole('creator')) {
        return view('creator.dashboard');
    } elseif (Auth::user()->hasRole('client')) {
        return view('client.references');
    } else {
        // Redirection par défaut si l'utilisateur n'a aucun rôle défini
        return view('welcome');
    }
    }
    

    
    
    
}
