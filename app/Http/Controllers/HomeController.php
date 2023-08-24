<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function root()
    {
        $user = Auth::user();
        $vehicles = VehicleService::getInstance()->get(5, 0, [
            'userLoggedId' => $user->id
        ]);

        $data = [];

        foreach ($vehicles as $vehicle) {

            $vehicle['fuelType'] = $vehicle['fuel_type'] ? $vehicle['fuel_type']['name'] : "";
            $vehicle['vehicleType'] =  $vehicle['type'] ? $vehicle['type']['name'] : "";
            $vehicle['municipaly'] = $vehicle['municipaly'] ? $vehicle['municipaly']['name'] : "";
            array_push($data, $vehicle);
        }

        return view('index', [
            'cars' => $data,
            'user' => $user
        ]);
    }


    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
}
