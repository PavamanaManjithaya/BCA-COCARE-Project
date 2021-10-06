<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request, $language)
    {

        /*$lang = array("English","Kannada");
        if (!in_array($language,  array("English","Kannada"))) {
            if ($request->fullUrl() === redirect()->back()->getTargetUrl()) {
               
                return redirect()->route('beneficiary.home');
            }
        }
*/
        app()->setLocale($language);
        session()->put('language', $language);
        if ($request->fullUrl() === redirect()->back()->getTargetUrl()) {
            return redirect()->route('beneficiary.home');
        }
        return redirect()->back();
    }
}
