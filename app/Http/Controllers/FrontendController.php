<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Area;
use App\Models\AreaDistance;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class FrontendController extends Controller
{
    /**
     * Display a list of all service providers.
     */
    public function welcome()
    {
        $services = Service::all();
        $areas = Area::all();
        return view('welcome', compact('services', 'areas'));
    }

    public function get_service_price(Request $request){
        $service = Service::find($request->service_id);
        $service_package = ServicePackage::where('service_id',$request->service_id)->first();
//return response()->json(['service' => $service, 'service_package' => $service_package]);
        if($service){
            if($service->billing_type=='distance' || $service->billing_type=='area'){
                $distance = AreaDistance::where('from_area_id', $request->area_from)
                        ->where('to_area_id', $request->area_to)
                        ->first();
                if($distance){
                    $service_price = $service_package->base_price + ($distance->distance_km * $service_package->unit_price);
                    return response()->json(['service_price' => $service_price, 'distance' => $distance->distance_km,'base_price'=>$service_package->base_price,'unit_price'=>$service_package->unit_price,'bill_type'=>$service->billing_type]);
                }else{
                    return response()->json(['service_price' => 0, 'distance' => 0,'base_price'=>0,'unit_price'=>0,'bill_type'=>$service->billing_type]);
                }

            }else if($service->billing_type=='hour'){
                $service_price = $service_package->base_price + ($request->hours * $service_package->unit_price);
                return response()->json(['service_price' => $service_price, 'hours' => $request->hours,'base_price'=>$service_package->base_price,'unit_price'=>$service_package->unit_price,'bill_type'=>$service->billing_type]);
            }else if($service->billing_type=='sqft'){
                $service_price = $service_package->base_price + ($request->area_sqft * $service_package->unit_price);
                return response()->json(['service_price' => $service_price, 'area_sqft' => $request->area_sqft,'base_price'=>$service_package->base_price,'unit_price'=>$service_package->unit_price,'bill_type'=>$service->billing_type]);
            }
            return response()->json(['service_price' => 0, 'distance' => 0,'base_price'=>0,'unit_price'=>0,'bill_type'=>$service->billing_type]);
        } else {
            return response()->json(['service_price' => 0, 'distance' => 0,'base_price'=>0,'unit_price'=>0,'bill_type'=>'']);
        }
    }
    
    public function service_booking(Request $request)
    {
        return $request->all();
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

    
 
}
