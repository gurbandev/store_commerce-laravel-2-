<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function create()
    {
        return view('slider.create');
    }
}
