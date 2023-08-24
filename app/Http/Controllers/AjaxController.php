<?php

namespace App\Http\Controllers;

use App\Models\MediaPanel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function __construct()
    {
    }
    function index(Request $request){

        if($request->ajax()){
            if($request->input('action')=='_medialPanel'){
                $method = ($request->has('method'))?$request->input('method'):'';
                if(trim($method)!=''){
                    if(method_exists(MediaPanel::class,$method)){
                        return MediaPanel::{$method}();
                    }
                }
            }
        }
    }
}
