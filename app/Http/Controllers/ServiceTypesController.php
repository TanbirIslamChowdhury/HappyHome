<?php

namespace App\Http\Controllers;

use App\Models\service_types;
use Illuminate\Http\Request;
use App\Http\Requests\Technicians\AddNewRequest;
use Illuminate\Support\Facades\Validator;

class ServiceTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $data=service_types::all();
     return view('service_types.index',
      compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $input=$request->all();
        service_types::create($input);
        return redirect()->route('service_types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(service_types $service_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $service_types=service_types::find($id);
          return view('service_types.edit', compact('service_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
          $service_types=service_types::find($id);
        $service_types->update($request->all());
        return redirect()->route('service_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $service_types=service_types::find($id);
        $service_types->delete();
        return redirect()->back();
    }
}
