<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index', compact('products'));
    }

    public function create()
    {
    	return view('admin.products.create');
    }

    //registrar un nuevo producto en la bd
    public function store()
    {
    	
    }
}
