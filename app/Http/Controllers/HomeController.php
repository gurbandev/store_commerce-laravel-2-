<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $categoryProducts = [];
        $categories = Category::orderBy('slug')
            ->get();

        foreach ($categories as $category) {
            $categoryProducts[] = [
                'category' => $category,
                'products' => Product::orderBy('random')
                    ->take(5)
                    ->get(),
            ];
        }

        return view('home.index')
            ->with([
                'sliders' => $sliders,
                'categoryProducts' => collect($categoryProducts),
            ]);
    }


    public function language($locale)
    {
        switch ($locale) {
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
