<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $data){
        
        $data->validate([
            'user_credential' => 'required',
            'user_password' => 'required',
        ]);

        if(Auth::attempt(['email'=>$data->user_credential,'password'=>$data->user_password,'status'=>'Active','delete'=>0]) || Auth::attempt(['phone'=>$data->user_credential,'password'=>$data->user_password,'status'=>'Active','delete'=>0]) || Auth::attempt(['username'=>$data->user_credential,'password'=>$data->user_password,'status'=>'Active','delete'=>0])){
            return to_route('home');
        }else{
            return back()->with('invalid_login',1);
        }
    }

    public function logout(){
        Auth::logout();
        return to_route('login');
    }
}
