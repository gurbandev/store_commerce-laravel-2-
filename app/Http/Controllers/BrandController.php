<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function create()
    {
        return view('brand.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'image' => 'nullable|image|mimes:png|max:16|dimensions:width=120,height=120',
        ]);

        $obj = Brand::create([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
        ]);

        if ($request->has('image')) {
            $name = str()->random(10) . '.png';
            Storage::putFileAs('public/brands', $request->image, $name);
            $obj->image = $name;
            $obj->update();
        }

        return redirect()->back()
            ->with([
                'success' => 'Brand created!'
            ]);
    }
}
