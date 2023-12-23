<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use App\Models\Language\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LocalizationController extends Controller
{
    public function adminLanguage() : View {
        $languages = Language::where('delete',0)->get();
        return view('admin.language.admin_language',compact('languages'));
    }

    public function generateAdminLocalizationString(Request $data) /**: RedirectResponse */ {
        // dd($data->all());

        $directory = $data->directory;
        $language_code = $data->lang;
        $fileName = $data->file_name;

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        $localizationStrings = [];

        //iterate over each file of the directory
        foreach($files as $file){
            if($file->isDir()){
                continue;
            }
            // $localizationStrings[]=$file->getPathname();
            $contents = file_get_contents($file->getPathname());

            preg_match_all('/__\([\'"](.+?)[\'"]\)/',$contents,$matches);

            if(!empty($matches[1])){
                foreach($matches[1] as $match){
                    if(!in_array($match,$localizationStrings)){
                        $localizationStrings[$match]=$match;
                    }

                }
            }
        }

        $phpArray = "<?php\n\nreturn ".var_export($localizationStrings,true). ";\n";

        //create language folder if it is not exist
        if(!File::isDirectory(lang_path($language_code))){
            File::makeDirectory(lang_path($language_code),0755,true);
        }

        file_put_contents(lang_path($language_code.'/'.$fileName.'.php'),$phpArray);


        return back();
        //dd(lang_path());

    }

    public function updateAdminLocalizationString(Request $data){
        // dd($data->all());
        $languageStrings = trans($data->file_name,[],$data->lang_code);
        $languageStrings[$data->string] = $data->translation;

        $phpArray = "<?php\n\nreturn ".var_export($languageStrings,true). ";\n";
        file_put_contents(lang_path($data->lang_code.'/'.$data->file_name.'.php'),$phpArray);


        // $translatedvalue = trans($data->file_name, [], $data->lang_code);
        return ['value'=> $languageStrings[$data->string]];
    }

}
