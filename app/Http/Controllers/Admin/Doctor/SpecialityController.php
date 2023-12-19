<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Speciality;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialities = Speciality::where('speciality_delete',0)->get();
        return view('admin.doctor.speciality_list',compact('specialities'));
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
            'speciality'=>'required|unique:specialities,speciality|max:300',
            'speciality_status'=>'required'
        ]);

        $create = Speciality::create([
            'speciality'=>$data->speciality,
            'speciality_status'=>$data->speciality_status,
        ]);

        return Speciality::where('id',DB::getPdo()->lastInsertId())->first();
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
        $speciality = Speciality::where('id',$id)->first();
        return $speciality;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id)
    {
        $data->validate([
            'speciality'=>'required|max:300|unique:specialities,speciality,'.$id,
        ]);

        $update = Speciality::where('id',$id)->update([
            'speciality'=>$data->speciality,
            'updated_at'=>Carbon::now(),
        ]);

        return Speciality::where('id',$id)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Speciality::where('id',$id)->update(['speciality_status'=>'Inactive','speciality_delete'=>1,'updated_at'=>Carbon::now()]);
        return 'deleted';
    }

    public function updateStatus(Request $data){
        Speciality::where('id',$data->id)->update(['speciality_status'=>$data->status,'updated_at'=>Carbon::now()]);
        $speciality = Speciality::where('id',$data->id)->first();
        return $speciality;
    }
}
