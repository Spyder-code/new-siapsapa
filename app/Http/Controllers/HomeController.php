<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->role == 'percetakan'){
                return redirect()->route('percetakan.batch')->with('success', 'Login Berhasil');
            }else{
                return redirect()->route('social.home')->with('success', 'Login Berhasil');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
