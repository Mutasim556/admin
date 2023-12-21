<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageChangeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $data)
    {
        try {
            // dd($data->code);
            session()->put('language',$data->code);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
