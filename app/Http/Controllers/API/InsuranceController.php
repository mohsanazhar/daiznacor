<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\InsuranceService;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        $insurances = InsuranceService::getInstance()->get();

        return response()->json($insurances);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        InsuranceService::getInstance()->create($request->input("name"),);

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
