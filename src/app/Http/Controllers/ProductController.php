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

    public function productSearch(Request $request)
    {
        $searchName = $request->input('name');
        $selectedPriceOrder = $request->input('price');

        if (empty($searchName) && empty($selectedPriceOrder)) {
            $products = Product::select('image', 'name', 'price')->paginate(6);
            return view('product', compact('products'));
        }

        $query = Product::select('id','image','name','price');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('price')) {
            if ($request->input('price') === '高い順に表示') {
                $query->orderBy('price', 'desc');
            } 
            elseif ($request->input('price') === '低い順に表示') {
                $query->orderBy('price', 'asc');
            }
        }

        $products = $query->paginate(6);
        
        return view('search', compact('products','searchName','selectedPriceOrder'));
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
                $originalName = $request->file('image')->getClientOriginalName();
                $existingProduct = Product::where('image', 'public/products/' . $originalName)->first();
               
                if ($existingProduct) {
                    $imagePath = $existingProduct->image;
                } 
                else {
                    $imagePath = $request->file('image')->storeAs('public/products', $originalName);
                }
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

            dd($request->all());  // リクエストデータをダンプ
dd($request->errors()); // バリデーションエラーがあればダンプ

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

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products');
    }


}
