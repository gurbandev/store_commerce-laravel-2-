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
            ->with(['user', 'category', 'brand'])
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

        $category = Category::findOrFail($product->category_id);
        $products = Product::where('category_id', $category->id)
            ->with(['user'])
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('product.show')
            ->with([
                'product' => $product,
                'category' => $category,
                'products' => $products,
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
            'image' => 'nullable|image|mimes:jpg,jpeg|max:128|dimensions:width=1000,height=1000',
        ]);

        $category = Category::findOrFail($request->category);
        $brand = Brand::findOrFail($request->brand);

        $obj = Product::create([
            'user_id' => auth()->id(),
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'full_name_tm' => $brand->name . ' ' . $category->product_tm . ' ' . $request->name_tm,
            'full_name_en' => $brand->name . ' ' . ($category->product_en ?: $category->product_tm) . ' ' . ($request->name_en ?: $request->name_tm),
            'barcode' => $request->barcode ?: null,
            'description' => $request->description ?: null,
            'price' => round($request->price, 1),
            'stock' => $request->stock,
        ]);
        $obj->save();

        if ($request->has('image')) {
            // generate name
            $name = str()->random(15) . '.jpg';
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
                'success' => 'Product (' . $obj->getFullName() . ') created!'
            ]);
    }


    public function edit($id)
    {
        $obj = Product::findOrFail($id);
        if (!$obj->isOwner()) {
            return abort(403);
        }

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
        if (!$obj->isOwner()) {
            return abort(403);
        }

        $request->validate([
            'category' => 'required|integer|min:1',
            'brand' => 'required|integer|min:1',
            'name_tm' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg|max:128',
        ]);

        $category = Category::findOrFail($request->category);
        $brand = Brand::findOrFail($request->brand);

        $obj->category_id = $category->id;
        $obj->brand_id = $brand->id;
        $obj->name_tm = $request->name_tm;
        $obj->name_en = $request->name_en ?: null;
        $obj->full_name_tm = $brand->name . ' ' . $category->product_tm . ' ' . $request->name_tm;
        $obj->full_name_en = $brand->name . ' ' . ($category->product_en ?: $category->product_tm) . ' ' . ($request->name_en ?: $request->name_tm);
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
            $name = str()->random(15) . '.jpg';
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
                'success' => 'Product (' . $obj->getFullName() . ') updated!'
            ]);
    }


    public function delete($id)
    {
        $obj = Product::findOrFail($id);
        if (!$obj->isOwner()) {
            return abort(403);
        }

        if ($obj->image) {
            Storage::delete('public/products/' . $obj->image);
            Storage::delete('public/products/sm/' . $obj->image);
        }
        $objName = $obj->getFullName();
        $obj->delete();

        return redirect()->route('home')
            ->with([
                'success' => 'Product (' . $objName . ') deleted!'
            ]);
    }
}
