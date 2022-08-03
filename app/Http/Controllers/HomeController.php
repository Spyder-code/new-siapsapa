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
    {
        $user = Auth::user();
        if($user->role == 'admin'){
            return redirect()->route('statistik.index')->with('success', 'Login Berhasil');
        }elseif($user->role == 'percetakan'){
            return redirect()->route('percetakan.batch')->with('success', 'Login Berhasil');
        }else{
            return redirect()->route('page.profile')->with('success', 'Login Berhasil');
        }
    }
}
