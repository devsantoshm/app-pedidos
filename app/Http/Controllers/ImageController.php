<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index($id)
    {
    	$product = Product::find($id);
    	$images = $product->images;
    	return view('admin.products.images.index', compact('product', 'images'));
    }

    public function store()
    {
    	
    }

    public function destroy()
    {
    	
    }
}
