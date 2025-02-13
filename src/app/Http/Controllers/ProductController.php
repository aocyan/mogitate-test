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
        return view('product');
    }

    public function store(Request $request)
    {
        if($request->input('action') === 'register'){

	        $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
                'description' => $request->input('description'), 
            ]);

            $seasonIds = [];
            foreach ($request->input('season') as $seasonName) {
                $season = Season::firstOrCreate(['name' => $seasonName]);
                $seasonIds[] = $season->id;  // 季節IDを配列に追加
            }

            $product->seasons()->attach($seasonIds, ['created_at' => now(), 'updated_at' => now()]);

            return view('product');
        }
    }
}
