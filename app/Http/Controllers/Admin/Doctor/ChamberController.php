<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Chamber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChamberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chambers = Chamber::where('chamber_delete',0)->get();
        return view('admin.doctor.chamber_list',compact('chambers'));
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
            'chamber_name' => 'required|max:255',
            'chamber_phone' => 'required|max:255|unique:chambers,chamber_phone',
            'chamber_address' => 'required|max:255',
        ]);

        $create = Chamber::create([
            'chamber_name' => $data->chamber_name,
            'chamber_phone' => $data->chamber_phone,
            'chamber_address' => $data->chamber_address,
            'chamber_created_by' => Auth::user()->id,
            'chamber_updated_by' => Auth::user()->id,
        ]);

        return Chamber::where('id',DB::getPdo()->lastInsertId())->first();
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
        $chamber = Chamber::where('id',$id)->first();
        return $chamber;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id)
    {
        $data->validate([
            'chamber_name'=>'required|max:255',
            'chamber_phone'=>'required|max:20',
            'chamber_address'=>'required|max:255',
        ]);
        $update = Chamber::where('id',$id)->update([
            'chamber_name' => $data->chamber_name,
            'chamber_phone' => $data->chamber_phone,
            'chamber_address' => $data->chamber_address,
            'chamber_updated_by' => Auth::user()->id,
        ]);
        $chamber = Chamber::where('id',$id)->first();
        return $chamber;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Chamber::where('id',$id)->update(['chamber_status'=>'Inactive','chamber_delete'=>1,'updated_at'=>Carbon::now()]);
        return 'deleted';
    }

    public function updateStatus(Request $data){
        Chamber::where('id',$data->id)->update(['chamber_status'=>$data->status,'updated_at'=>Carbon::now()]);
        $user = Chamber::where('id',$data->id)->first();
        return $user;
    }
}
