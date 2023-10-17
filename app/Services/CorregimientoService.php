<?php

namespace App\Services;
use App\Models\Corregimiento;

class CorregimientoService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): CorregimientoService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return Corregimiento::orderByDesc("created_at")->get()->toArray();
    }

    public function create($data){
        return Corregimiento::create([
            "name" => $data['name'],
            "district_id" => $data['district_id'],
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return Corregimiento::where("name", $name)->first();
    }

    public static function getCorregimientosByDistric($id){
        if(!isset($id)) return null;
        return Corregimiento::where("district_id", $id)->get();
    }

    public function findOneById($id){
        if(!isset($id)) return null;
        return Corregimiento::where("id", $id)->first();
    }

    public function update($id, $payload) {
        try {

            $corregimiento = $this->findOneById($id);
            if(!$corregimiento) throw new Exception('Vehicle not found', 404);

            if(!is_null($payload["name"])) $corregimiento->name = $payload["name"];
            if(!is_null($payload["district_id"])) $corregimiento->district_id = $payload["district_id"];


            $corregimiento->updated_at = now();

            $corregimiento->save();
            $corregimiento->refresh();

            return $corregimiento;

        } catch (Exception $e) {

            $message = $e->getMessage();
            $code = $e->getCode();

            throw new Exception($message, $code);
        }
    }

    public function deleteOneById($id){
        try {
            $data =  Corregimiento::where('id', $id)->delete();

            if(!$data) return null;

            return $data;

        } catch (Exception $e) {
            return null;
        }
    }
}
