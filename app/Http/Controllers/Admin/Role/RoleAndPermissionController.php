<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RoleAndPermissionController extends Controller
{
    public function index()  : View {
        return view('admin.role.index');
    }

    public function create()/**  : Returntype */ {

    }
}
