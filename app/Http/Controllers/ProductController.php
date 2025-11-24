<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Product $products)
    {
        $products = $products->paginate(10);
        return view('product.ProductList', compact('products'));
    }

    public function show(Product $product)
    {
        return view('product.ProductDetails', compact('product'));
    }
}
