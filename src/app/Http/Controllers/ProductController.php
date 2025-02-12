<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Models\Product_Season;
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
}
