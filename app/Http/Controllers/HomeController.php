<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }


    public function language($lang)
    {
        switch ($lang) {
            case 'tm':
                session()->put('locale', 'tm');
                return redirect()->back();
                break;
            case 'en':
                session()->put('locale', 'en');
                return redirect()->back();
                break;
            default:
                return redirect()->back();
        }
    }
}
