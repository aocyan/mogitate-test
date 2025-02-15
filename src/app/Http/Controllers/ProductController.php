<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function product()
    {
        $products = Product::select('id','image','name','price')->paginate(6);

        return view('product', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('seasons');
        return view('detail', compact('product'));
    }

    public function store(Request $request)
    {
        if($request->input('action') === 'register'){

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/products');
            }

	        $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $imagePath,
                'description' => $request->input('description'), 
            ]);

            $seasonIds = [];
            foreach ($request->input('season') as $seasonName) {
                $season = Season::firstOrCreate(['name' => $seasonName]);
                $seasonIds[] = $season->id;
            }

            $product->seasons()->attach($seasonIds, ['created_at' => now(), 'updated_at' => now()]);

            $products = Product::select('image','name','price')->paginate(6);

            return view('product', compact('products'));
        }
    }

    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $imagePath = $request->file('image')->store('public/products');
            $product->image = $imagePath;
        }
    
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $seasonIds = [];
        foreach ($request->input('season') as $seasonName) {
            $season = Season::firstOrCreate(['name' => $seasonName]);
            $seasonIds[] = $season->id;
        }

        $product->seasons()->sync($seasonIds);

        $product->save();

        return redirect()->route('products');
    }

}
