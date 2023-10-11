<?php

namespace App\Services;
use App\Models\Province;

class ProvinceService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ProvinceService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return Province::orderByDesc("created_at")->get()->toArray();
    }

    public function create($name){
       if(is_array($name)){
           $name = $name['name'];
       }
        return Province::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return Province::where("name", $name)->first();
    }
    public function findOneById($id){
        if(!isset($id)) return null;
        return Province::where("id", $id)->first();
    }

    public function deleteOneById($id) {
        try {
            $data =  Province::where('id', $id)->delete();

            if(!$data) return null;

            return $data;

        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $payload) {
        try {

            $province = $this->findOneById($id);
            if(!$province) throw new Exception('Vehicle not found', 404);

            if(!is_null($payload["name"])) $province->name = $payload["name"];


            $province->updated_at = now();

            $province->save();
            $province->refresh();

            return $province;

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();

            throw new Exception($message, $code);
        }
    }
}
