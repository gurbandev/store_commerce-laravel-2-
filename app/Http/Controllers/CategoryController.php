<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->orderBy('random')
            ->simplePaginate();

        return view('category.show')
            ->with([
                'category' => $category,
                'products' => $products,
            ]);
    }


    public function create()
    {
        return view('category.create');
    }
}
