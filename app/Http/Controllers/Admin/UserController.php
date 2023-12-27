<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Mail\Admin\CreateUserMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Contruct method will load first
     */
    public function __construct()
    {
        $this->middleware(['permission:user-index','web'])->only('index');
        $this->middleware(['permission:user-create','web'])->only('store');
        $this->middleware(['permission:user-update','web'])->only(['edit','update','updateStatus']);
        $this->middleware(['permission:user-delete','web'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
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
    public function store(CreateUserRequest $data) : Response
    {
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
                'title'=>__('admin_local.Congratulations !'),
                'text'=>__('admin_local.User created successfully'),
                'confirmButtonText'=>__('admin_local.Ok'),
                'hasAnyPermission' => hasPermission(['user-update','user-delete']),
                'hasEditPermission' => hasPermission(['user-update']),
                'hasDeletePermission' => hasPermission(['user-delete']),
            ]);
        }else{
            return response()->json([
                'message'=>__('admin_local.Something went wrong.'),
                'title'=>__('admin_local.Warning !'),
                'confirmButtonText'=>__('admin_local.Ok'),
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
    public function edit(string $id) : Response
    {
        $user = User::findOrFail($id);
        $role = $user->getRoleNames()->first();

        return response([
            'user'=>$user,
            'role'=>$role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id) : Response
    {
        $data->validate([
            'user_name'=>'required|max:50',
            'username'=>'required|max:50|unique:users,username,'.$id,
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
            ]);
            $user = User::findOrFail($id);
            $user->syncRoles($data->user_role);
        }else{
            $update = User::where('id',$id)->update([
                'name' => $data->user_name,
                'email' => $data->user_email,
                'phone' => $data->user_phone,
                'username' => $data->username,
            ]);
            $user = User::findOrFail($id);
            $user->syncRoles($data->user_role);
        }

        if($update){
            $role = $user->getRoleNames()->first();
            return response([
                'user'=>$user,
                'role'=>$role,
                'role' => $user->getRoleNames()->first(),
                'title'=>__('admin_local.Congratulations !'),
                'text'=>__('admin_local.User updated successfully'),
                'confirmButtonText'=>__('admin_local.Ok'),
            ]);
        }else{
            return response()->json([
                'message'=>__('admin_local.Something went wrong.'),
            ],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        User::where('id',$id)->update(['delete'=>1,'updated_at'=>Carbon::now()]);
        return response([
            'message'=>'Deleted',
            'title'=>__('admin_local.Congratulations !'),
            'text'=>__('admin_local.User removed successfully'),
            'confirmButtonText'=>__('admin_local.Ok'),
        ]);
    }

    public function updateStatus(Request $data){
        User::where('id',$data->id)->update(['status'=>$data->status,'updated_at'=>Carbon::now()]);
        $user = User::where('id',$data->id)->first();
        return $user;
    }


}
