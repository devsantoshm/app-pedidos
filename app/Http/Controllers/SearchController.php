<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
    	$query = $request->input('query');
    	//dd($query);
    	$products = Product::where('name', 'like', "%$query%")->paginate(5);
    	if ($products->count() == 1) {
    		$id = $products->first()->id;
    		return redirect("products/$id"); // 'products/'.$id comillas dobles si interpretan las variables que estan dentro
    	}
    	return view('search.show', compact('products', 'query'));
    }

    public function data()
    {
    	// Recupera todos los valores en un array ['desk', 'prodc1']
    	$products = Product::pluck('name');
    	return $products;
    }
}
