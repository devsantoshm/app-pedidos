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

    public function create() //muestra la vista de registro de un producto
    {
    	return view('admin.products.create');
    }

    //registrar un nuevo producto en la bd
    public function store(Request $request)
    {
    	//dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); // INSERT en la bd

        return redirect('admin/products');
    }

    public function edit($id) //muestra el formulario edición de un producto
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    //registrar un nuevo producto en la bd
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); // INSERT OR UPDATE en la bd

        return redirect('admin/products');
    }
}
