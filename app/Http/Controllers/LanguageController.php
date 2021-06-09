<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function hindi(){

        session()->get('language');
        session()->forget('language');

        Session::put('language', 'hindi');
        return redirect()->back();
    }


    public function english(){
        session()->get('language');
        session()->forget('language');

        Session::put('language', 'english');
        return redirect()->back();
    }
}
