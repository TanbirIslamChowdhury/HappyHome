<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

use App\Http\Requests\Products\AddNewRequest;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
                  $data=products::all();
        return view('products.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              products::create($request->all());
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products=Products::find($id);
          return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $products=Products::find($id);
        $products->update($request->all());
        return redirect()->route('products.index');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $products=Products::find($id);
        $products->delete();
        return redirect()->back();
    }
}
