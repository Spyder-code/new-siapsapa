<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function profile($id)
    {
        $user = User::find($id);
        $anggota = $user->anggota;
        return view('social.user-timeline', compact('user','anggota'));
    }
}
