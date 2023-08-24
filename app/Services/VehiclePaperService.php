<?php

namespace App\Services;
use App\Models\VehiclePaper;
use Exception;

class VehiclePaperService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): VehiclePaperService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function findOneByVehicleId($id, $filter = []): VehiclePaper | null {
        $vehicleFound = VehiclePaper::with($filter)->where("vehicle_id", $id)
        ->whereNull('deleted_at')->orderBy('id','DESC')
        ->first();
        if(!$vehicleFound) return null;
        return $vehicleFound;
    }

    public function create($payload){

        try {
            VehiclePaper::create([
                "record" => $payload['record'],
                "reviewed" => $payload['reviewed'],
                "policy" => $payload['policy'],
                "weight-dimension" => $payload['weight-dimension'],
                "payment-receipt" => $payload['payment-receipt'],
                "scanned-sticker" => $payload['scanned-sticker'],
                "photos-01" => $payload['photos-01'],
                "photos-02" => $payload['photos-02'],
                "photos-03" => $payload['photos-03'],
                "photos-04" => $payload['photos-04'],
                "others" => $payload['others'],
                "vehicle_id" => $payload['vehicle_id'],
                "owner_id" => $payload['owner_id'],
            ]);

            return true;

        } catch (Exception $e) {
            throw new Exception("Las imagenes no puedo ser procesadas", 400);
        }

    }
}
