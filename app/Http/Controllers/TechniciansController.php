<?php

namespace App\Http\Controllers;

use App\Models\technicians;
use Illuminate\Http\Request;
use App\Http\Requests\Products\AddNewRequest;
use Illuminate\Support\Facades\Validator;

class TechniciansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $data=technicians::all();
     return view('technicians.index',
      compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('technicians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        products::create($input);
        return redirect()->route('technicians.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(technicians $technicians)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $technicians=Technicians::find($id);
          return view('technicians.edit', compact('technicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $technicians=Technicians::find($id);
        $technicians->update($request->all());
        return redirect()->route('technicians.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $technicians=Technicians::find($id);
        $technicians->delete();
        return redirect()->back();
        
    }
}
