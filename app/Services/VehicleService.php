<?php

namespace App\Services;
use App\Helper\StringHelper;
use App\Models\Vehicle;
use Exception;

class VehicleService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): VehicleService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get($take = 10, $offset = 0, $filter = null){
        $vehicles = null;

        if(isset($filter['company'])) {

            $vehicles = Vehicle::with([
                "type",
                "municipaly",
                "policy",
                "policy.insuranceCompany",
                "fuelType",
                "owner"
            ])->whereNull('deleted_at')
            ->where("created_by_user_id", '=', $filter['userLoggedId'])
            ->where("company_id",  '=', $filter['company'])
            ->orderByDesc("created_at")
            ->skip($offset * $take)
            ->take($take)
            ->get()->toArray();
            
        } else {
            $vehicles = Vehicle::with([
                "type",
                "municipaly",
                "policy",
                "policy.insuranceCompany",
                "fuelType",
                "owner"
            ])->whereNull('deleted_at')
            ->where("created_by_user_id", '=', $filter['userLoggedId'])
            ->orderByDesc("created_at")
            ->skip($offset * $take)
            ->take($take)
            ->get()->toArray();
        }

        return $vehicles;
    }

    public function findOneById($id, $filter = []): Vehicle | null {
        $vehicleFound = Vehicle::with($filter)->where("id", $id)
        ->whereNull('deleted_at')
        ->first();
        if(!$vehicleFound) return null;
        return $vehicleFound;
    }
    
    public function deleteOneByIdentification($id) {
        try {
            $vehicle = $this->findOneById($id);
            if(!$vehicle) throw new Exception('Vehicle not found', 404);

            $vehicle->deleted_at = now();
            $vehicle->save();

            return "Vehicle is deleted";

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();
            
            throw new Exception($message, $code);
        }       
    }

    public function create($payload, $userLoggedId){
        try {
            $vehicle = Vehicle::create([
                'name' => $payload["name"],
                'identification_card' => $payload["identification_card"],
                'car_plate' => $payload["car_plate"],
                'month_renewal' => $payload["month_renewal"],
                'brand' => $payload["brand"],
                'model' => $payload["model"],
                "year" => $payload["year"],
                "engine" => $payload["engine"],
                "chassis" => $payload["chassis"],
                "color" => $payload["color"],
                "owner_id" => $payload['owner_id'],
                "company_id" => $payload['company_id'],
                "created_by_user_id" => $userLoggedId,
                "mortgagee" => $payload["mortgagee"],
                "revised_no" => $payload["revised_no"],
                "weights" => $payload["weights"],
                "dimensions" => $payload["dimensions"],
                "due_date" => $payload["due_date"],
                'municipality_id' => $payload['municipality_id'],
                'vehicle_type_id' => $payload['vehicle_type_id'],
                'fuel_type_id' => $payload['fuel_type_id'],
                'policy_id' => $payload['policy_id'],
            ]);

            return $vehicle;

        } catch (Exception $e) {
            $message = $e->getMessage();
            throw new Exception($message, 500);
        }
    }

    public function update($id, $payload) {

        try {

            $vehicle = $this->findOneById($id);
            if(!$vehicle) throw new Exception('Vehicle not found', 404);
            
            if(!is_null($payload["name"])) $vehicle->name = $payload["name"];
            if(!is_null($payload["identification_card"])) $vehicle->identification_card = $payload["identification_card"];
            if(!is_null($payload["car_plate"])) $vehicle->car_plate = $payload["car_plate"];
            if(!is_null($payload["month_renewal"])) $vehicle->month_renewal = $payload["month_renewal"];
            if(!is_null($payload["brand"])) $vehicle->brand = $payload["brand"];
            if(!is_null($payload["model"])) $vehicle->model = $payload["model"];
            if(!is_null($payload["engine"])) $vehicle->engine = $payload["engine"];
            if(!is_null($payload["chassis"])) $vehicle->chassis = $payload["chassis"];
            if(!is_null($payload["color"])) $vehicle->color = $payload["color"];
            if(!is_null($payload["mortgagee"])) $vehicle->mortgagee = $payload["mortgagee"];
            if(!is_null($payload["revised_no"])) $vehicle->revised_no = $payload["revised_no"];
            if(!is_null($payload["weights"])) $vehicle->weights = $payload["weights"];
            if(!is_null($payload["dimensions"])) $vehicle->dimensions = $payload["dimensions"];
            if(!is_null($payload["due_date"])) $vehicle->due_date = $payload["due_date"];
            if(!is_null($payload["fuel_type_id"])) $vehicle->fuel_type_id = $payload["fuel_type_id"];
            if(!is_null($payload["municipality_id"])) $vehicle->municipality_id = $payload["municipality_id"];
            if(!is_null($payload["vehicle_type_id"])) $vehicle->vehicle_type_id = $payload["vehicle_type_id"];
            if(!is_null($payload["policy_id"])) $vehicle->policy_id = $payload["policy_id"];
            if(!is_null($payload["year"])) $vehicle->year = $payload["year"];

            $vehicle->updated_at = now();

            $vehicle->save();
            $vehicle->refresh();

            return $vehicle;

        } catch (Exception $e) {
         
            $message = $e->getMessage();
            $code = $e->getCode();
            
            throw new Exception($message, $code);
        }
    }

     
    public function deleteOneById($id) {
        try {
            $data = $this->findOneById($id);
            if(!$data) return null;

            $data->deleted_at = now();
            $data->save();
            $data->refresh();

            return $data;

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();
            
            throw new Exception($message, $code);
        }       
    }
}
