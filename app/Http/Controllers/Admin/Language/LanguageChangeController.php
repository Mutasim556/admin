<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageChangeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $data)
    {
        try {
            session()->put('language',$data->code);
        } catch (\Throwable $th) {
            session(['language'=>'en']);
        }
    }
}
