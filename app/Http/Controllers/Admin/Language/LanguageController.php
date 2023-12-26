<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
use App\Models\Language\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('delete',0)->get();
        return view('admin.language.language_list',compact('languages'));
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
    public function store(LanguageRequest $data)
    {
        if($data->default){
            Language::where('default',1)->update([
                'default'=>0,
            ]);
        }
        $language = new Language();
        $language->name = $data->name;
        $language->slug = $data->slug;
        $language->lang = $data->language;
        $language->default = $data->default?1:0;
        $language->status = $data->status?1:0;
        $language->delete = 0;
        $language->save();


        return $language;
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
        $language = Language::findOrFail($id);
        return $language;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $data, string $id)
    {
        if($data->default){
            Language::where('default',1)->update([
                'default'=>0,
            ]);
        }
        $language = Language::findOrFail($id);
        $language->name = $data->name;
        $language->slug = $data->slug;
        $language->lang = $data->language;
        $language->default = $data->default?1:0;
        $language->status = $data->status?1:0;
        $language->save();


        return $language;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);
        $language->default = 0;
        $language->status = 0;
        $language->delete = 1;
        $language->save();
        return 'deleted';
    }

    public function updateStatus(Request $data){
        Language::where('id',$data->id)->update(['status'=>$data->status,'updated_at'=>Carbon::now()]);
        $language = Language::where('id',$data->id)->first();
        return $language;
    }
}
