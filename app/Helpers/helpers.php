<?php

use App\Models\Language\Language;
use Illuminate\Support\Facades\App;

function getLanguageSession() : string {
    if(session()->has('language')){
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
}

function userRoleName(){
    return auth()->guard('web')->user()->getRoleNames()->first();
}


function hasPermission(array $permission){
    if(userRoleName()==='Super Admin'){
        return true;
    }else{
        return auth()->guard('web')->user()->hasAnyPermission($permission);
    }
}


