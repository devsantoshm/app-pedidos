<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function welcome()
	{
		$categories = Category::has('products')->get(); //categorias que tienen al menos un producto asignado
		return view('welcome')->with(compact('categories'));
	}
}
