<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FronProductController extends Controller
{
    // 

    function products() {
        $products=\App\Models\products::get();
        return view ('products', compact('products'));
    }

}
