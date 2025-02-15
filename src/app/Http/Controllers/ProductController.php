<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function detail()
    {
        return view('detail');
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
}
