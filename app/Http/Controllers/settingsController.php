<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ProvinceService;
use App\Services\DistrictService;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createProvince(Request $request){

        $this->clearSession();
        $request->validate([
            'province' => ["required"],
        ]);

        try {
            $name = $request->input('province');
            // is ma name k sath user id b pass , auth()->id(), jo current login ho, baad ma agar company login karay to us ko setting display nahi ho
            ProvinceService::getInstance()->create([
                'name' => $name,
            ]);

            session()->flash("status", "La provincia ha sido creada.");

            return redirect()->route('list-province');

        } catch (Exception $e) {

            session()->flash("error", "Error con guardar la póliza");

            return redirect()->route('list-province');
        }
    }

    private function clearSession() {
        session()->reflash();
        session()->remove("error");
        session()->remove("status");
    }

    public function provinceViewList(Request $req){
        $this->clearSession();
        $user = Auth::user();

        try {
            $take = $req->query("take", 100);
            $offset = $req->query("offset", 0);
            //$company = $req->query("company");

            $provinces = ProvinceService::getInstance()->get($take, $offset, [
                'userLoggedId' => $user->id
            ]);


            $data = [];
            foreach ($provinces as $province) {
                $province['name'] = $province['name'] ? $province['name'] : "";

                array_push($data, $province);
            }
            return view("pages.settings.province-list", [
                "provinces" => $data,
                'user' => $user,
            ]);

        } catch (Exception $e) {
            return redirect()->route("list-province");
        }
    }

    function getProvinceDetail($id){
        $province = Province::find($id);

        return response()->json($province);
    }

    public function deleteProvince(Request $req){
        $province_input_id = $req->input('province_input_id');
        try {
            $delete = ProvinceService::getInstance()->deleteOneById($province_input_id);

            if(!$delete) {
                session()->flash("status", "No puede ser eliminado el vehículo");
                return redirect()->route("list-province");
            }

            session()->flash("status", "El Vehículo ha sido eliminado");

            return redirect()->route("list-province");

        } catch (Exception $e) {
            session()->flash("status", "No puede ser eliminado el vehículo");
            return redirect()->route("list-province");
        }
    }

    public function updateProvince(Request $request, $id){
        $this->clearSession();
        $request->validate([
            'province' => ["required"],
        ]);

        try {
            $formated_data = [
                "name" => $request->input("province"),
            ];
            $name = $request->input('province');
            ProvinceService::getInstance()->update($id, $formated_data);

            session()->flash("status", "La provincia ha sido creada.");

            return redirect()->route('list-province');

        } catch (Exception $e) {

            session()->flash("error", "Error con guardar la póliza");

            return redirect()->route('list-province');
        }
    }

    function districtViewList(Request $req){
        $this->clearSession();
        $user = Auth::user();

        try {
            $take = $req->query("take", 100);
            $offset = $req->query("offset", 0);
            $disctricts = DistrictService::getDistricts();
            $provinces = ProvinceService::getInstance()->get();

            $data = [];
            $prodata = [];
            foreach ($disctricts as $disctrict) {
                $dis['id'] = $disctrict['id'] ? $disctrict['id'] : "";
                $dis['name'] = $disctrict['name'] ? $disctrict['name'] : "";
                $dis['provinceName'] = $disctrict['provinceName'] ? $disctrict['provinceName'] : "";

                array_push($data, $dis);
            }
            foreach ($provinces as $province) {
                $pro['id'] = $province['id'] ? $province['id'] : "";
                $pro['name'] = $province['name'] ? $province['name'] : "";
                array_push($prodata, $pro);
            }
            //dd($data);
            return view("pages.settings.district-list", [
                "disctricts" => $data,
                "provinces" => $prodata,
                'user' => $user,
            ]);

        } catch (Exception $e) {
            return redirect()->route("list-province");
        }
    }

    public function createDistrict(Request $request){
        $this->clearSession();
        $request->validate([
            'district' => ["required"],
        ]);

        try {
            DistrictService::create([
                'name' => $request->input('district'),
                'province_id' => $request->input('selectedProvince'),
            ]);
            session()->flash("status", "La provincia ha sido creada.");

            return redirect()->route('list-district');

        } catch (Exception $e) {

            session()->flash("error", "Error con guardar la póliza");

            return redirect()->route('list-district');
        }
    }

    public function deleteDistrict(Request $req){
        $district_input_id = $req->input('district_input_id');
        try {
            $delete = DistrictService::getInstance()->deleteOneById($district_input_id);

            if(!$delete) {
                session()->flash("status", "No puede ser eliminado el vehículo");
                return redirect()->route("list-province");
            }

            session()->flash("status", "El Vehículo ha sido eliminado");

            return redirect()->route("list-district");

        } catch (Exception $e) {
            session()->flash("status", "No puede ser eliminado el vehículo");
            return redirect()->route("list-district");
        }
    }

    public function getDistrictDetail($id){
        $district = District::find($id);

        return response()->json($district);
    }

    public function updateDistrict(Request $request, $id){
        $this->clearSession();
        $request->validate([
            'district' => ["required"],
        ]);

        try {
            $formated_data = [
                "name" => $request->input("district"),
                "province_id" => $request->input("district-select-edit"),
            ];

            DistrictService::getInstance()->update($id, $formated_data);

            session()->flash("status", "La provincia ha sido creada.");

            return redirect()->route('list-district');

        } catch (Exception $e) {

            session()->flash("error", "Error con guardar la póliza");

            return redirect()->route('list-district');
        }
    }
}
