<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $districts = DistrictService::getInstance()->get();

        return response()->json($districts);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        DistrictService::getInstance()->create($request->input("name"),);

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
