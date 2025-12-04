<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request){
        $validData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

    //         dd([
    //     'email' => $validData['email'],
    //     'password' => $validData['password'],
    //     'user_in_db' => \App\Models\User::where('email', $validData['email'])->first(),
    // ]);
        $email = $validData['email'];
        $password = $validData['password'];
        if(Auth::attempt(['email'=>$email, 'password'=>$password])){
            $user = Auth::user();
            if($user->role == 'Attendee'){
                return redirect()->route('purchaseIndex');
            }
            return redirect()->route('event.index');
        }
        return back()->with('alert', 'Invalid email or Password');
    }
    public function logout(){
        $user = Auth::user();
        $user->logout;
        return redirect('/');
    }
}
