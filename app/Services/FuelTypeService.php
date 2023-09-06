<?php

namespace App\Services;
use App\Models\FuelType;

class FuelTypeService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): FuelTypeService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return FuelType::orderByDesc("id")->get()->toArray();
    }

    public function create($name){
        return FuelType::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return FuelType::where("name", $name)->first();
    }
}
