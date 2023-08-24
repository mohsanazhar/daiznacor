<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService 
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): UserService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }   

    public function create($payload){

        $user = User::create([
            'name' => $payload['name'],
            'email' => $payload["email"],
            'password' => Hash::make($payload["password"]),
            'created_at' => now(),
        ]);

        return $user;
    }
}
