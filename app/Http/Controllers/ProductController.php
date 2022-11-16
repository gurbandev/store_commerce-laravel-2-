<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $brands = Brand::orderBy('slug')
            ->get();

        return view('product.create')
            ->with([
                'categories' => $categories,
                'brands' => $brands,
            ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'brand' => 'required|integer|min:1',
            'name_tm' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg|max:1024|dimensions:width=1000,height=1000',
        ]);

        $obj = Product::create([
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'slug' => str()->slug($request->name_tm),
            'barcode' => $request->barcode ?: null,
            'description' => $request->description ?: null,
            'price' => round($request->price, 1),
            'stock' => $request->stock,
        ]);

        if ($request->has('image')) {
            // name
            $name = str()->random(10) . '.jpg';
            // save normal size
            Storage::putFileAs('public/products', $request->image, $name);
            // save sm size
            $img = Image::make($request->image);
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/products/sm/' . $name);
            // save to modal
            $obj->image = $name;
            $obj->update();
        }

        return redirect()->back()
            ->with([
                'success' => 'Product created!'
            ]);
    }
}
