<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use App\Models\Language\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function adminLanguage() : View {
        $languages = Language::where('delete',0)->get();
        return view('admin.language.admin_language',compact('languages'));
    }
}
