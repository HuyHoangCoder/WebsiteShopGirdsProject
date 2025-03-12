<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $dsSP = Product::with('category')->limit(8)->get();

        return view('Page.Home', compact('dsSP'));
    }
}
