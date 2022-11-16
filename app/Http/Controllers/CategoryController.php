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


    public function store(Request $request)
    {
        $request->validate([
            'name_tm' => 'required|string|max:255|unique:categories',
            'name_en' => 'nullable|string|max:255',
            'product_tm' => 'required|string|max:255',
            'product_en' => 'nullable|string|max:255',
            'home' => 'required|boolean',
            'sort_order' => 'required|integer|min:1',
        ]);

        Category::create([
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'product_tm' => $request->product_tm,
            'product_en' => $request->product_en ?: null,
            'slug' => str()->slug($request->name_tm),
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->back()
            ->with([
                'success' => 'Category created!'
            ]);
    }
}
