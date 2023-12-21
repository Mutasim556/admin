<?php

use App\Models\Language\Language;
use Illuminate\Support\Facades\App;

function getLanguageSession() : string {
    if(session()->has('language')){
        // App::setLocale(session()->get('language'));
        return session()->get('language');
    }else{
        try {
            $language = Language::where('default',1)->first();
            setLanguage($language->lang);
            return $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');
            return session()->get('language');
        }
    }
}

function setLanguage(string $code) : void{
    session(['language'=>$code]);
    // App::setLocale(session()->get('language'));
}