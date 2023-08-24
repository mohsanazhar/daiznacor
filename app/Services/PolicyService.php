<?php

namespace App\Services;
use App\Models\Policy;
use Exception;

class PolicyService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): PolicyService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get($take = 10, $offset = 0, $filter = null){
        $data = Policy::with([
            "insuranceCompany",
            "vehicles",
            "vehicles.company",
        ])->whereNull('deleted_at')
        ->orderByDesc("created_at")
        ->skip($offset * $take)
        ->take($take)
        ->get();

        return $data->toArray();
    }

    public function findOneById($id): Policy | null {
        $data = Policy::with([])->where("id", $id)
        ->whereNull('deleted_at')
        ->first();
        if(!$data) return null;
        return $data;
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
            return null;
        }
    }

    public function create($payload){
        try {

            $data = Policy::create([
                'number' => $payload["number"],
                'insured_name' => $payload["insured_name"],
                'identification_card' => $payload["identification_card"],
                'policy_issuance' => $payload["policy_issuance"],
                'policy_expiration' => $payload["policy_expiration"],
                "insurance_company_id" => $payload['insurance_company_id']
            ]);

            return $data;

        } catch (Exception $e) {
            $message = $e->getMessage();
            throw new Exception($message, 500);
        }
    }

    public function update($id, $payload) {

        try {

            $data = $this->findOneById($id);
            if(!$data) return null;

            if(!is_null($payload["number"])) $data->number = $payload["number"];
            if(!is_null($payload["insured_name"])) $data->insured_name = $payload["insured_name"];
            if(!is_null($payload["identification_card"])) $data->identification_card = $payload["identification_card"];
            if(!is_null($payload["policy_issuance"])) $data->policy_issuance = $payload["policy_issuance"];
            if(!is_null($payload["policy_expiration"])) $data->policy_expiration = $payload["policy_expiration"];
            if(!is_null($payload["insurance_company_id"])) $data->insurance_company_id = $payload["insurance_company_id"];
            
            $data->updated_at = now();

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
