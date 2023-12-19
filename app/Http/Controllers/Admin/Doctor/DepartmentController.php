<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::where('department_delete',0)->get();
        return view('admin.doctor.department_list',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $data)
    {
        $data->validate([
            'department_name'=>'required|unique:departments,department_name|max:300',
            'department_status'=>'required'
        ]);

        $create = department::create([
            'department_name'=>$data->department_name,
            'department_status'=>$data->department_status,
        ]);

        return Department::where('id',DB::getPdo()->lastInsertId())->first();
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
        $department = Department::where('id',$id)->first();
        return $department;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id)
    {
        $data->validate([
            'department_name'=>'required|max:300|unique:departments,department_name,'.$id,
        ]);

        $update = Department::where('id',$id)->update([
            'department_name'=>$data->department_name,
            'updated_at'=>Carbon::now(),
        ]);

        return Department::where('id',$id)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::where('id',$id)->update(['department_status'=>'Inactive','department_delete'=>1,'updated_at'=>Carbon::now()]);
        return 'deleted';
    }

    public function updateStatus(Request $data){
        Department::where('id',$data->id)->update(['department_status'=>$data->status,'updated_at'=>Carbon::now()]);
        $department = Department::where('id',$data->id)->first();
        return $department;
    }
}
