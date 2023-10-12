<?php

namespace App\Services;
use App\Models\District;

class DistrictService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): DistrictService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return District::orderByDesc("created_at")->get()->toArray();
    }

    public static function create($data){
        return District::create([
            "name" => $data['name'],
            "province_id" => $data['province_id'],
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return District::where("name", $name)->first();
    }

    public function findOneById($id){
        if(!isset($id)) return null;
        return District::where("id", $id)->first();
    }
    public static function getDistrictByProvice($id){
        if(!isset($id)) return null;
        return District::where("province_id", $id)->get();
    }

    public static function getDistricts(){
        return $data = District::join('provinces', 'provinces.id', '=', 'districts.province_id')
           // ->where('districts.deleted_at', null)
            //->where('provinces.deleted_at', null)
            ->get(['districts.id', 'districts.name', 'provinces.name as provinceName', 'districts.province_id as provinceId']);
    }

    public function deleteOneById($id){
        try {
            $data =  District::where('id', $id)->delete();

            if(!$data) return null;

            return $data;

        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $payload) {
        try {

            $district = $this->findOneById($id);
            if(!$district) throw new Exception('Vehicle not found', 404);

            if(!is_null($payload["name"])) $district->name = $payload["name"];
            if(!is_null($payload["province_id"])) $district->province_id = $payload["province_id"];


            $district->updated_at = now();

            $district->save();
            $district->refresh();

            return $district;

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();

            throw new Exception($message, $code);
        }
    }
}
