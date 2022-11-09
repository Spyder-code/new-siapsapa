<?php

namespace App\Http\Controllers;

use App\Repositories\MidtransService;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function check()
    {
        return view('midtrans_check');
    }

    public function test(Request $request)
    {
        if($request->username=='testmidtrans@gmail.com'&&$request->password=='12345678'){
            $midtrans = new MidtransService();
            $url = $midtrans->test();
            return redirect($url);
        }else{
            return back()->with('error','Email / Password tidak sesuai!');
        }
    }
}
