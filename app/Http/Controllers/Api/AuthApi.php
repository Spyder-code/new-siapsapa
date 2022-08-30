<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function response($user)
    {
        $token = $user->createToken( Str::random(40) )->plainTextToken;

        return response()->json([
            'user'=>$user,
            'anggota_id'=>$user->anggota->id,
            'token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'email'=>'required|email|unique:users|string|max:255',
            'password'=>'required|min:8|string|confirmed'
        ]);

        $user = User::create([
            'name'=>ucwords($request->name),
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'role' =>'anggota'
        ]);

        return $this->response($user);
    }

    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if(!Auth::attempt($cred)) {
            return response()->json([
                'message'=>'unauthorized.',
            ], 401);
        }

        return $this->response(Auth::user());
    }

    public function logout()
    {
        // Auth::user()->tokens()->delete();

        return response()->json([
            'message'=>'You have successfully logged out and token was successfull deleted.'
        ]);
    }

    // public function createToken (Request $request) {
    //     $token = $request->user()->createToken($request->token_name);
    //     return ['token' => $token->plainTextToken];
    // }

    public function user (Request $request){
        return $request->user();
    }

    public function resetPassword()
    {
        $email = request('email');
        $user = User::where('email',$email)->first();
        if($user){
            $user->update([
                'password' => Hash::make('pramuka')
            ]);
            return response('Password success updated');
        }else{
            return response('Email tidak ditemukan');
        }
    }
}
