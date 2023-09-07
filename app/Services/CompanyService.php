<?php

namespace App\Services;
use App\Helper\RequestHelper;
use App\Helper\StringHelper;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanyEmail;
use App\Models\CompanyPhoneNumber;
use Illuminate\Support\Facades\Hash;
use Exception;

class CompanyService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): CompanyService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get($take = 10, $offset = 0, $filter = null){
        $companies = Company::with([
            "emails",
            "phoneNumbers",
            "province",
            "user",
            "vehicles"
        ])
        ->where('created_by_user_id', '=', $filter["userLoggedId"])
        ->whereNull('deleted_at')
        ->orderByDesc("id")
        ->skip($offset * $take)
        ->take($take)
        ->get()->toArray();

        $data = [];

        foreach ($companies as $item) {
            $item['vehicleCount'] = $item['vehicles'] ? count($item['vehicles']) : 0;
            array_push($data, $item);
        }

        return $data;
    }

    public function findOneById($id): Company | null {
        $companyFound = Company::with([
            "emails",
            "phoneNumbers",
            "province"
        ])->where("id", $id)
        ->whereNull('deleted_at')
    ->orderByDesc('id')
        ->first();
        if(!$companyFound) return null;
        return $companyFound;
    }
    
    public function deleteOneById($id) {
        try {
            $companyFound = $this->findOneById($id);
            if(!$companyFound) return null;

            $companyFound->deleted_at = now();
            $companyFound->save();
            $companyFound->refresh();

            return $companyFound;

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();
            
            throw new Exception($message, $code);
        }       
    }

    public function createRelationship($payload){
        $province = ProvinceService::getInstance()->findOneByName($payload["province"]);
        if(!$province){
            $province = ProvinceService::getInstance()->create($payload["province"]);
            if(!$province){
                return throw new Exception("No se pudo asignar la provincia", 400); 
            }
        }

        $district = DistrictService::getInstance()->findOneByName($payload["district"]);
        if(!$district){
            $district = DistrictService::getInstance()->create($payload["district"]);
            if(!$district){
                return throw new Exception("No se pudo asignar la distrito", 400); 
            }
        }

        $corregimiento = CorregimientoService::getInstance()->findOneByName($payload["corregimiento"]);
        if(!$corregimiento){
            $corregimiento = CorregimientoService::getInstance()->create($payload["corregimiento"]);
            if(!$corregimiento){
                return throw new Exception("No se pudo asignar el corregimiento", 400); 
            }
        }

        return [
            'province' => $province,
            'district' => $district,
            'corregimiento' => $corregimiento
        ];
    }

    public function create($payload, $userLoggedId){

        try {

            $companyFound = $this->findOneById($payload["identification_card"]);
            if($companyFound) {
                return throw new Exception("La empresa existe.", 400);
            }

            $user = User::where("email", $payload["email"])->first();

            if(!$user){
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload["email"],
                    'password' => Hash::make(123456789),
                    'created_at' => now(),
                ]);
            }
            $response = $this->createRelationship($payload);

            $company = Company::create([ 
                'name' => $payload["name"],
                'dv'=> $payload['dv'],
                'identification_card' => $payload["identification_card"],
                'street' => $payload["street"],
                'avatar' => $payload["image"],
                'corregimiento' => $payload["corregimiento"],
                'district' => $payload["district"],
                "house_number" => $payload["house_number"],
                "user_id" => $user->id,
                "created_by_user_id"=> $userLoggedId,
                'province_id' => $response['province']->id,
                'district_id' =>$response['district']->id,
                'corregimiento_id' => $response['corregimiento']->id,
            ]);
            CompanyEmail::create([
                'email' => $payload["email"],
                "company_id" => $company->id
            ]);

            CompanyPhoneNumber::create([
                'phone_number' => $payload["phone"],
                "company_id" => $company->id
            ]);
            $view = view('emails.company_register_mail')->render();
            RequestHelper::send_mail($payload['name'],$payload['email'],'Admin',env('MAIL_FROM_ADDRESS'),'BIENVENIDO A PANTRÁMITES',$view);
            return true;
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            throw new Exception($message, 500);
        }
    }

    public function update($id, $payload) {

        try {

            $companyFound = $this->findOneById($id);
            if(!$companyFound) throw new Exception('Empresa no encontrada.', 404);

            if(!is_null($payload["name"])) $companyFound->name = $payload["name"];
            if(!is_null($payload["identification_card"])) $companyFound->identification_card = $payload["identification_card"]; 
            if(!is_null($payload["dv"])) $companyFound->dv = $payload["dv"];
            if(!is_null($payload["street"])) $companyFound->street = $payload["street"];
            if(!is_null($payload["image"])) $companyFound->avatar = $payload["image"];
            if(!is_null($payload["corregimiento"])) $companyFound->corregimiento = $payload["corregimiento"];
            if(!is_null($payload["district"])) $companyFound->district = $payload["district"];
            if(!is_null($payload["house_number"])) $companyFound->house_number = $payload["house_number"];

            $resp = $this->createRelationship($payload);

            if($resp['province']){
                $companyFound->province_id = $resp['province']->id;
            }

            if($resp['corregimiento']){
                $companyFound->corregimiento_id = $resp['corregimiento']->id;
            }

            if($resp['district']){
                $companyFound->district_id = $resp['district']->id;
            }

            $companyFound->updated_at = now();

            $companyFound->save();
            $companyFound->refresh();

            return $companyFound;

        } catch (Exception $e) {
         
            $message = $e->getMessage();
            $code = $e->getCode();
            
            throw new Exception($message, $code);
        }
    }
}
