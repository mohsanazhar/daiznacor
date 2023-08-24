<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $provinces = ProvinceService::getInstance()->get();

        return response()->json($provinces);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        ProvinceService::getInstance()->create($request->input("name"),);

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
