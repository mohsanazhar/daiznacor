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
        return Province::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return Province::where("name", $name)->first();
    }
}
