<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Mail\Admin\CreateUserMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('delete','0')->get();
        $roles = Role::all();
        return view('admin.user.user_lists',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.user.create_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $data)
    {
        // $create = User::create([
        //     'name' => $data->user_name,
        //     'email' => $data->user_email,
        //     'phone' => $data->user_phone,
        //     'username' => $data->username,
        //     'password' => Hash::make($data->user_password),
        //     'role' => $data->user_role,
        // ]);
        $user = new User();
        $user->name = $data->user_name;
        $user->email = $data->user_email;
        $user->phone = $data->user_phone;
        $user->username = $data->username;
        $user->password = Hash::make($data->user_password);
        $user->save();
        $user->assignRole($data->user_role);

        Mail::to($data->user_email)->send(new CreateUserMail($data->user_email,$data->user_password));

        if($user){
            $user = User::where('id',$user->id)->first();
            return response([
                'user'=>$user,
                'role' => $user->getRoleNames()->first(),
            ]);
        }else{
            return response()->json([
                'message'=>'Something went wrong.',
            ],422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id',$id)->first();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id)
    {
        $data->validate([
            'user_name'=>'required|max:50',
            'username'=>'required|max:50|unique:users,username,'.$id,
            'user_role'=>'required',
            'user_email'=>'required|email|max:40|unique:users,email,'.$id,
            'user_phone'=>'required|min:11|max:15|unique:users,phone,'.$id,
        ]);
        if($data->user_password){
            $data->validate([
                'user_password'=>'max:30|min:4'
            ]);
            $update = User::where('id',$id)->update([
                'name' => $data->user_name,
                'email' => $data->user_email,
                'phone' => $data->user_phone,
                'username' => $data->username,
                'password' => Hash::make($data->user_password),
                'role' => $data->user_role,
            ]);
        }else{
            $update = User::where('id',$id)->update([
                'name' => $data->user_name,
                'email' => $data->user_email,
                'phone' => $data->user_phone,
                'username' => $data->username,
                'role' => $data->user_role,
            ]);
        }

        if($update){
            return  User::where('id',$id)->first();
        }else{
            return response()->json([
                'message'=>'Something went wrong.',
            ],422);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->update(['delete'=>1,'updated_at'=>Carbon::now()]);
        return 'deleted';
    }

    public function updateStatus(Request $data){
        User::where('id',$data->id)->update(['status'=>$data->status,'updated_at'=>Carbon::now()]);
        $user = User::where('id',$data->id)->first();
        return $user;
    }

    
}
