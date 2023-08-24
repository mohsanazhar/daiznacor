<?php

namespace App\Services;
use App\Models\Municipaly;

class MunicipalityService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): MunicipalityService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return Municipaly::orderByDesc("created_at")->get()->toArray();
    }

    public function create($name){
        return Municipaly::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return Municipaly::where("name", $name)->first();
    }
}
