<?php

namespace App\Http\Controllers;

use App\Helper\RequestHelper;
use App\Models\MediaModel;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $media  = MediaModel::with('user')->where(['user_id'=>$user['id']])->get();

        return view('pages.media.list',compact('media','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $new_name  = $request->input('rename');
        if(trim($new_name)!=''){
            $media_id = $request->input('media_id');
            $vehiclePaper = $request->input('vehiclePaper');
            $media = MediaModel::find($media_id);
            if(!is_null($media)){
                $name = $media['name'];
                $new_name = RequestHelper::slug_maker($new_name);
                $linked_vehicles = RequestHelper::getLinkedVehicle($name,false);
            
                if(count($linked_vehicles)>0 && !is_null($linked_vehicles)){
                    foreach ($linked_vehicles as $lk=>$lv){
                        $columns = ['record','reviewed','policy','weight-dimension',
                            'payment-receipt','scanned-sticker','photos-01','photos-02','photos-03',
                            'photos-04','others'];
                        foreach ($columns as $k=>$v){
                            $column_value = $lv[$v];
                            if(str_contains($column_value,$name)){
                                $new_column_value = str_replace($name,$new_name,$column_value);
                                $lv[$v] = $new_column_value;
                            }else{
                                continue;
                            }
                        }
                        $lv->save();
                    }
                    $ext = explode('.',$media['media']);
                    rename($media['media'],'storage/'.$media['folder'].'/'.$new_name.".".end($ext));
                    $media['media'] = str_replace($name,$new_name,$media['media']);
                    $media['name'] = $new_name;
                    $media->save();
                }
            }
        }
        session()->flash("status", __('translation.file_renamed'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
