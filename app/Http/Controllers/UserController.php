<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(Request $request, User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($request['division_id'== 0] || $request['division_id'] == '0'){
            $request['division_id'] = null;
        }
        if($request->password){
            $data = $request->validate ([
                'password' => 'required|min:6|confirmed',
                'old_password' => 'required|min:6',
            ]);

            if(!password_verify($data['old_password'], Auth::user()->password)){
                return back()->with('error', 'Password lama tidak sesuai');
            }else{
                $user->update([
                    'password' => bcrypt($data['password']),
                ]);
            }

        }else{
            $user->update($request->all());
        }
        return back()->with('success', 'Data berhasil diubah');
    }
}
