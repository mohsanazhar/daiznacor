<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CorregimientoService;
use Illuminate\Http\Request;

class CorregimientoController extends Controller
{
    public function index(Request $request)
    {
        $corregimientos = CorregimientoService::getInstance()->get();

        return response()->json($corregimientos);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ["required", 'string'],
        ]);

        CorregimientoService::getInstance()->create($request->input("name"),);

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
