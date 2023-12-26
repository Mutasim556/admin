<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $data)
    {

        $data->validate([
            'user_credential' => 'required',
            'user_password' => 'required',
        ]);

        if (Auth::attempt(['email' => $data->user_credential, 'password' => $data->user_password, 'status' => 'Active', 'delete' => 0]) || Auth::attempt(['phone' => $data->user_credential, 'password' => $data->user_password, 'status' => 'Active', 'delete' => 0]) || Auth::attempt(['username' => $data->user_credential, 'password' => $data->user_password, 'status' => 'Active', 'delete' => 0])) {
            return to_route('home');
        } else {
            return back()->with('invalid_login', 1);
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function profile()
    {
        $profile_info = Auth::user();
        return view('admin.auth.admin_profile', compact('profile_info'));
    }

    public function updateBasicInfo(Request $data)
    {
        $data->validate([
            'user_name' => 'required|max:50',
            'user_email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'user_phone' => 'required|max:14|unique:users,phone,' . Auth::user()->id,
            'username' => 'required|max:50|unique:users,username,' . Auth::user()->id,
        ]);
        $update = User::where('id', Auth::user()->id)->update([
            'name' => $data->user_name,
            'email' => $data->user_email,
            'phone' => $data->user_phone,
            'username' => $data->username,
            'updated_at' => Carbon::now(),
        ]);

        if ($update) {
            return User::where('id', Auth::user()->id)->first();
        } else {
            return User::where('id', Auth::user()->id)->first();
        }
    }

    public function updatePassword(Request $data){
        $data->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'retype_password' => 'required|same:new_password',
        ]);
        $user = User::find(Auth::user()->id);
        // return $data->new_password;
        if(Hash::check($data->old_password,$user->password)){
            $update = User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($data->new_password),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['message'=>1]);
        }else{
            return response()->json(['message'=>'Invalid user password'],422);
        }
    }
}
