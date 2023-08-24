<?php

namespace App\Services;
use App\Models\InsuranceCompany;

class InsuranceService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): InsuranceService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function get(){
        return InsuranceCompany::orderByDesc("created_at")->get()->toArray();
    }

    public function create($name){
        return InsuranceCompany::create([
            "name" => $name
        ]);
    }

    public function findOneByName($name){
        if(!isset($name)) return null;
        return InsuranceCompany::where("name", $name)->first();
    }

    public function findOneById($id){
        if(!isset($id)) return null;
        return InsuranceCompany::where("id", $id)->first();
    }
}
