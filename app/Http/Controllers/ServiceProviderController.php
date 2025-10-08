<?php
namespace App\Http\Controllers;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class ServiceProviderController extends Controller
{
    /**
     * Display a list of all service providers.
     */
    public function index()
    {
        $providers = ServiceProvider::all();
        return view('service_provider.index', compact('providers'));
    }
    public function create()
    {
        return view('service_provider.create');
    }
    /**
     * Register a new service provider.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:service_providers,email',
            'password' => 'required|string|min:6',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        $providers = ServiceProvider::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return redirect()->route('service_provider.index')->with('success', 'Service provider registered successfully');
    }

    /**
     * Display a specific service provider.
     */
    public function show($id)
    {
        $provider = ServiceProvider::findOrFail($id);
        return response()->json($provider);
    }
    public function edit($id)
    {
        $providers = ServiceProvider::findOrFail($id);
        return view('service_provider.edit', compact('providers'));
    }
    /**
     * Update service provider details.
     */
    public function update(Request $request, $id)
    {
        $providers = ServiceProvider::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|unique:service_providers,email,' . $providers->id,
            'password' => 'nullable|string|min:6',
            'phone'    => 'sometimes|string|max:20',
            'address'  => 'sometimes|string|max:255',
        ]);

       $providers->update($request->all());

        return redirect()->route('service_provider.index')->with('success', 'Service provider updated successfully');
      

    }

    /**
     * Delete a service provider.
     */
    public function destroy($id)
    {
        $providers = ServiceProvider::findOrFail($id);
        $providers->delete();

        return redirect()->route('service_provider.index')->with('success', 'Service provider deleted successfully');
    }

  
 
}
