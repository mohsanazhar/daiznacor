<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\MunicipalityService;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    public function index(Request $request)
    {
        $provinces = MunicipalityService::getInstance()->get();

        return response()->json($provinces);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        MunicipalityService::getInstance()->create($request->input("name"),);

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
