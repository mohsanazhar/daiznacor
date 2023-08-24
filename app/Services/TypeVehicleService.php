<?php

namespace App\Services;
use App\Models\TypeVehicle;

class TypeVehicleService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): TypeVehicleService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return TypeVehicle::orderByDesc("created_at")->get()->toArray();
    }

    public function create($name){
        return TypeVehicle::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return TypeVehicle::where("name", $name)->first();
    }
}
