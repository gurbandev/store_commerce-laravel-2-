<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->with(['user'])
            ->orderBy('random')
            ->simplePaginate(20);

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
            'name_tm' => ['required', 'string', 'max:255', Rule::unique('categories')],
            'name_en' => ['nullable', 'string', 'max:255', Rule::unique('categories')],
            'product_tm' => ['required', 'string', 'max:255', Rule::unique('categories')],
            'product_en' => ['nullable', 'string', 'max:255', Rule::unique('categories')],
            'home' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        Category::create([
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'product_tm' => $request->product_tm,
            'product_en' => $request->product_en ?: null,
            'home' => $request->home ? 1 : 0,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->back()
            ->with([
                'success' => 'Category created!'
            ]);
    }


    public function edit($id)
    {
        $obj = Category::findOrFail($id);

        return view('category.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Category::findOrFail($id);
        $request->validate([
            'name_tm' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($obj->id)],
            'name_en' => ['nullable', 'string', 'max:255', Rule::unique('categories')->ignore($obj->id)],
            'product_tm' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($obj->id)],
            'product_en' => ['nullable', 'string', 'max:255', Rule::unique('categories')->ignore($obj->id)],
            'home' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $obj->name_tm = $request->name_tm;
        $obj->name_en = $request->name_en ?: null;
        $obj->product_tm = $request->product_tm;
        $obj->product_en = $request->product_en ?: null;
        $obj->home = $request->home ? 1 : 0;
        $obj->sort_order = $request->sort_order;
        $obj->update();

        return redirect()->back()
            ->with([
                'success' => 'Category updated!'
            ]);
    }
}
