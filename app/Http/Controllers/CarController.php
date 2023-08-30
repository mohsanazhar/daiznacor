<?php

namespace App\Http\Controllers;

use App\Helper\RequestHelper;
use App\Services\CompanyService;
use App\Services\PolicyService;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use App\Services\MunicipalityService;
use App\Services\FuelTypeService;
use App\Services\TypeVehicleService;
use App\Services\VehiclePaperService;
use Illuminate\Support\Facades\Auth;
use Exception;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function clearSession(): void {
        session()->reflash();
        session()->remove("vehicle-error");
        session()->remove("vehicle-created");
    }

    public function viewListCars(Request $req)
    {
        $this->clearSession();
        $user = Auth::user();

        try {
            $take = $req->query("take", 100);
            $offset = $req->query("offset", 0);
            $company = $req->query("company");

            $vehicles = VehicleService::getInstance()->get($take, $offset, [
                'userLoggedId' => $user->id,
                'company' => $company
            ]);

            $data = [];

            foreach ($vehicles as $vehicle) {
                $vehicle['fuelType'] = $vehicle['fuel_type'] ? $vehicle['fuel_type']['name'] : "";
                $vehicle['vehicleType'] =  $vehicle['type'] ? $vehicle['type']['name'] : "";
                $vehicle['municipaly'] = $vehicle['municipaly'] ? $vehicle['municipaly']['name'] : "";
                array_push($data, $vehicle);
            }

            $companies = CompanyService::getInstance()->get($take, $offset, [
                'userLoggedId' => $user->id
            ]);
            
            $policies = PolicyService::getInstance()->get($take, $offset);

            return view("pages.cars.list-car", [ 
                "cars" => $data,
                'user' => $user,
                "companies" => $companies,
                'policies' => $policies
            ]);

        } catch (Exception $e) {
            return redirect()->route("listCar");
        }
    }

    public function createCar(Request $req)
    {
        $this->clearSession();
        $user = Auth::user();
        
        $validatedData = $req->validate([
            'name' => 'required',
            'identification_card' => 'required',
            'car_plate' => 'required',
            'model' => 'required',
            'month_renewal' => 'required',
            'brand' => 'required',
            'year' => 'nullable',
            'engine' => 'required',
            'chassis' => 'required',
            'color' => 'nullable',
            'no-polize' => 'nullable',
            'insurance_companies' => 'nullable',
            'due_date' => 'nullable',
            'weights' => 'nullable',
            'dimensions' => 'nullable',
            'municipality' => 'required',
            'type-vehicle' => 'nullable',
            'fuel-type' => 'nullable',
            'revised_no' => 'nullable',
            'mortgagee' => 'nullable'
        ]);

        $municipalityId = null;
        $municipality = MunicipalityService::getInstance()->findOneByName($validatedData['municipality']);
        if($municipality){
            $municipalityId = $municipality->id;
        }else{

            $municipality = MunicipalityService::getInstance()->create($validatedData['municipality']);
            if(!$municipality){
                
                session()->flash("error", "Error al crear el vehiculo");
                
                return redirect()->route("listCar");
            }
            $municipalityId = $municipality->id;
        }

        $fuelTypeId = null;
        $fuelType = FuelTypeService::getInstance()->findOneByName($validatedData['type-vehicle']);
        if($fuelType){
            $fuelTypeId = $fuelType->id;
        }else{
            $fuelType = FuelTypeService::getInstance()->create($validatedData['type-vehicle']);
            if(!$fuelType){

                session()->flash("error", "Error al crear el vehiculo");

                return redirect()->route("listCar");
            }
            $fuelTypeId = $fuelType->id;
        }

        $typeVehicleId = null;
        $typeVehicle = TypeVehicleService::getInstance()->findOneByName($validatedData['type-vehicle']);
        if($typeVehicle){
            $typeVehicleId = $typeVehicle->id;
        }else{
            $typeVehicle = TypeVehicleService::getInstance()->create($validatedData['type-vehicle']);
            if(!$typeVehicle){

                session()->flash("error", "Error al crear el vehiculo");

                return redirect()->route("listCar");
            }
            $typeVehicleId = $typeVehicle->id;
        }
        try {
            VehicleService::getInstance()->create([
                'name' => $validatedData['name'],
                'identification_card' => $validatedData['identification_card'],
                'car_plate' => $validatedData['car_plate'],
                'model' => $validatedData['model'],
                'owner_id' => $req->input('owner_id'),
                'company_id' => $req->input('company_id'),
                "policy_id" => $req->input("policy_id"),
                'month_renewal' => $validatedData['month_renewal'],
                'brand' => $validatedData['brand'],
                'year' => isset($validatedData['year']) ? $validatedData['year'] : '',
                'engine' => $validatedData['engine'],
                'chassis' => $validatedData['chassis'],
                'color' => isset($validatedData['color']) ? $validatedData['color'] : '',
                'due_date' => $validatedData['due_date'],
                'weights' => isset($validatedData['weights']) ? $validatedData['weights'] : "",
                'dimensions' =>  isset($validatedData['dimensions']) ? $validatedData['dimensions'] : '',
                'revised_no' => isset($validatedData['revised_no']) ? $validatedData['revised_no'] : '',
                'mortgagee' => isset($validatedData['mortgagee']) ? $validatedData['mortgagee'] : "",
                'municipality_id' => $municipalityId,
                'fuel_type_id' => $fuelTypeId,
                'vehicle_type_id' => $typeVehicleId
            ], $user->id);

            session()->flash("status", "El vehículo ya ha sido creado");

            return redirect()->route("listCar");

        } catch (Exception $e) {
            session()->flash("error", "El vehículo no pudo ser creado");
            return redirect()->route("listCar");
        }
    }

    public function update(Request $request){

        $this->clearSession();
        $id = $request->route("id");
        if(!is_string($id) || $id == ":id") return redirect()->route("listCar");

        try {
            VehicleService::getInstance()->update($id, [
                "name" => $request->input("name"),
                "identification_card" => $request->input("identification_card"),
                "car_plate" => $request->input("car_plate"),
                "month_renewal" => $request->input("month_renewal"),
                "brand" => $request->input("brand"),
                "model" => $request->input("model"),
                "engine" => $request->input("engine"),
                "chassis" => $request->input("chassis"),
                "color" => $request->input("color"),
                "mortgagee" => $request->input("mortgagee"),
                "revised_no" => $request->input("revised_no"),
                "weights" => $request->input("weights"),
                "dimensions" => $request->input("dimensions"),
                "due_date" => $request->input("due_date"),
                "fuel_type_id" => $request->input("fuel_type_id"),
                "municipality_id" => $request->input("municipality_id"),
                "vehicle_type_id" => $request->input("vehicle_type_id"),
                "policy_id" => $request->input("policy_id"),
                "year" => $request->input("year"),
            ]);

            session()->flash("status", "El Vehículo ha sido actualizado");

            return redirect()->route("listCar");
        } catch (Exception $e) {
            return redirect()->route("listCar");
        }
    }

    public function delete(Request $request){

        $this->clearSession();
        $id = $request->route("id");
        if(!is_string($id) || $id == ":id") return redirect()->route("listCar");

        try {
            $delete = VehicleService::getInstance()->deleteOneById($id);

            if(!$delete) {
                session()->flash("status", "No puede ser eliminado el vehículo");
                return redirect()->route("listCar");
            }
            
            session()->flash("status", "El Vehículo ha sido eliminado");
            
            return redirect()->route("listCar");

        } catch (Exception $e) {
            session()->flash("status", "No puede ser eliminado el vehículo");
            return redirect()->route("listCar");
        }

    }

    public function gloveBoxView(Request $request){

        $this->clearSession();
        $user = Auth::user();
        $id = $request->route("id");
        if(!is_string($id) || $id == ":id") return redirect()->route("listCar");

        $data = VehicleService::getInstance()->findOneById($id, [
            "owner"
        ]);

        $vehiclePaper = VehiclePaperService::getInstance()->findOneByVehicleId($id);
        if(is_null($vehiclePaper)){
            $vehiclePaper = ['record'=>'','reviewed'=>'','policy'=>'','weight-dimension'=>'',
                'payment-receipt'=>'','scanned-sticker'=>'','photos-01'=>'','photos-02'=>'','photos-03'=>'',
                'photos-04'=>'','others'=>''];
        }
    
        return view("pages.cars.guantera", [
            "user" => $user,
            "vehicleId" => $id,
            "vehiclePaper" => $vehiclePaper,
            "owner" => $data['owner']
        ]);

    }

    public function gloveBoxCreate(Request $request){

        $this->clearSession();
        $id = $request->route("id");
        if(!is_string($id) || $id == ":id") return redirect()->route("listCar");

        try {
            $host = $request->getSchemeAndHttpHost();
            $record = $reviewed = $policy = $weightDimension = $paymentReceipt = $scannedSticker = $photos01 = $photos02 = $photos03 = $photos04 = "";
            if($request->hasFile('record')){
              $record = RequestHelper::uploadImage($request, 'record', "vehicles")->getPathname();
            }
            if($request->hasFile('reviewed')){
              $reviewed = RequestHelper::uploadImage($request, 'reviewed', "vehicles")->getPathname();
            }
            if($request->hasFile('policy')){
             $policy = RequestHelper::uploadImage($request, 'policy', "vehicles")->getPathname();
            }
            if($request->hasFile('weight-dimension')){
                $weightDimension = RequestHelper::uploadImage($request, 'weight-dimension', "vehicles")->getPathname();
            }
            if($request->hasFile('payment-receipt')){
                $paymentReceipt = RequestHelper::uploadImage($request, 'payment-receipt', "vehicles")->getPathname();
            }
            if($request->hasFile('scanned-sticker')){
              $scannedSticker = RequestHelper::uploadImage($request, 'scanned-sticker', "vehicles")->getPathname();
            }
            if($request->hasFile('photos-01')){
                $photos01 = RequestHelper::uploadImage($request, 'photos-01', "vehicles")->getPathname();
            }
            if($request->hasFile('photos-02')){
                $photos02 = RequestHelper::uploadImage($request, 'photos-02', "vehicles")->getPathname();
            }
            if($request->hasFile('photos-03')){
                $photos03 = RequestHelper::uploadImage($request, 'photos-03', "vehicles")->getPathname();
            }
            if($request->hasFile('photos-04')){
                $photos04 = RequestHelper::uploadImage($request, 'photos-04', "vehicles")->getPathname();
            }
            /*VehiclePaperService::getInstance()->create([
                "record" => "$host/$record",
                "reviewed" => "$host/$reviewed",
                "policy" => "$host/$policy",
                "weight-dimension" => $weightDimension ? "$host/$weightDimension" : null,
                "payment-receipt" => "$host/$paymentReceipt",
                "scanned-sticker" => "$host/$scannedSticker",
                "photos-01" => "$host/$photos01",
                "photos-02" => "$host/$photos02",
                "photos-03" => "$host/$photos03",
                "photos-04" => "$host/$photos04",
                "others" => $request->input("others"),
                "vehicle_id" => $id,
                "owner_id" => $request->input("owner_id")

            ]);*/
            VehiclePaperService::getInstance()->create([
                "record" => ($request->has('record'))?str_replace(url('/').'/',"",$request->input('record')):$record,
                "reviewed" => ($request->has('reviewed'))?str_replace(url('/').'/',"",$request->input('reviewed')):$reviewed,
                "policy" => ($request->has('policy'))?str_replace(url('/').'/',"",$request->input('policy')):$policy,
                "weight-dimension" => ($request->has('weight-dimension'))?str_replace(url('/').'/',"",$request->input('weight-dimension')):$weightDimension,
                "payment-receipt" => ($request->has('payment-receipt'))?str_replace(url('/').'/','',$request->input('payment-receipt')):$paymentReceipt,
                "scanned-sticker" => ($request->has('scanned-sticker'))?str_replace(url('/').'/','',$request->input('scanned-sticker')):$scannedSticker,
                "photos-01" => ($request->has('photos-01'))?str_replace(url('/').'/','',$request->input('photos-01')):$photos01,
                "photos-02" => ($request->has('photos-02'))?str_replace(url('/').'/','',$request->input('photos-02')):$photos02,
                "photos-03" => ($request->has('photos-03'))?str_replace(url('/').'/','',$request->input('photos-03')):$photos03,
                "photos-04" => ($request->has('photos-04'))?str_replace(url('/').'/','',$request->input('photos-04')):$photos04,
                "others" => $request->input("others"),
                "vehicle_id" => $id,
                "owner_id" => $request->input("owner_id")

            ]);
           
            session()->flash("status", "Datos guardados");

            return redirect()->route("listCar");

        } catch (Exception $e) {
            session()->flash("error", "No puede ser eliminado el vehículo");
            return redirect()->route("listCar");
        }

    }
}