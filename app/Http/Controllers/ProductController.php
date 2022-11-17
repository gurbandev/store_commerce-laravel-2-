<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand', 'values.attribute'])
            ->firstOrFail();

        if (Cookie::has('p_v')) {
            $productIds = explode(',', Cookie::get('p_v'));
            if (!in_array($product->id, $productIds)) {
                $product->increment('viewed');
                $productIds[] = $product->id;
                Cookie::queue('p_v', implode(',', $productIds), 60 * 8);
            }
        } else {
            $product->increment('viewed');
            Cookie::queue('p_v', $product->id, 60 * 8);
        }

        return view('product.show')
            ->with([
                'product' => $product,
            ]);
    }


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
            'image' => 'required|image|mimes:jpg,jpeg|max:128|dimensions:width=1000,height=1000',
        ]);

        $obj = Product::create([
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'barcode' => $request->barcode ?: null,
            'description' => $request->description ?: null,
            'price' => round($request->price, 1),
            'stock' => $request->stock,
        ]);

        if ($request->has('image')) {
            // generate name
            $name = str()->random(10) . '.jpg';
            // save normal
            Storage::putFileAs('public/products', $request->image, $name);
            // save small
            $imageSm = Image::make($request->image);
            $imageSm->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imageSm = (string)$imageSm->encode('jpg', 90);
            Storage::put('public/products/sm/' . $name, $imageSm);
            // update obj
            $obj->image = $name;
            $obj->update();
        }

        return redirect()->back()
            ->with([
                'success' => 'Product created!'
            ]);
    }


    public function edit($id)
    {
        $obj = Product::findOrFail($id);
        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $brands = Brand::orderBy('slug')
            ->get();

        return view('product.edit')
            ->with([
                'obj' => $obj,
                'categories' => $categories,
                'brands' => $brands,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Product::findOrFail($id);
        $request->validate([
            'category' => 'required|integer|min:1',
            'brand' => 'required|integer|min:1',
            'name_tm' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg|max:128|dimensions:width=1000,height=1000',
        ]);

        $obj->category_id = $request->category;
        $obj->brand_id = $request->brand;
        $obj->name_tm = $request->name_tm;
        $obj->name_en = $request->name_en ?: null;
        $obj->barcode = $request->barcode ?: null;
        $obj->description = $request->description ?: null;
        $obj->price = round($request->price, 1);
        $obj->stock = $request->stock;
        $obj->update();

        if ($request->has('image')) {
            if ($obj->image) {
                Storage::delete('public/products/' . $obj->image);
                Storage::delete('public/products/sm/' . $obj->image);
            }
            // generate name
            $name = str()->random(10) . '.jpg';
            // save normal
            Storage::putFileAs('public/products', $request->image, $name);
            // save small
            $imageSm = Image::make($request->image);
            $imageSm->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imageSm = (string)$imageSm->encode('jpg', 90);
            Storage::put('public/products/sm/' . $name, $imageSm);
            // update obj
            $obj->image = $name;
            $obj->update();
        }

        return redirect()->back()
            ->with([
                'success' => 'Product updated!'
            ]);
    }
}
