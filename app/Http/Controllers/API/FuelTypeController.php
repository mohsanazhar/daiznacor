<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FuelTypeService;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index(Request $request)
    {
        $provinces = FuelTypeService::getInstance()->get();

        return response()->json($provinces);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        FuelTypeService::getInstance()->create($request->input("name"));

        return response()->json([
            "info" => [ "Successfully" ]
        ], 201);
    }

    public function show(){
        
    }
    public function update(){

    }
    public function destroy(){

    }
}
