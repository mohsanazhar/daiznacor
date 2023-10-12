<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ProvinceService;
use App\Services\DistrictService;
use Lang;

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

    public function createProvinceAjax($id=0){
        if($id) {
            $title = 'Editar Provincia';
            $province = Province::find($id)->toArray();



        echo view('pages.settings.province.edit-form', compact(['title', 'province']))->render();
        exit;
        }else{
            $title = 'Nueva Provincia';
            echo view('pages.settings.province.form', compact(['title']))->render();
            exit;
        }
    }


    public function storeProvinceAjax(Request $request){
        $user = Auth::user();
        $validator = \Validator::make($request->all(), [
            'province' => 'required',
        ]);
        $title = 'Nueva Provincia';
        if ($validator->fails())
        {
            echo view('pages.settings.province.form', compact(['user', 'title']))->withErrors($validator)->render();
            exit;
        }else{
            $name = $request->input('province');
            ProvinceService::getInstance()->create([
                'name' => $name,
            ]);
            $success = 'Exitosamente Agregada';
            echo view('pages.settings.province.form', compact(['title', 'success']))->render();
            exit;
        }
    }

    public function updateProvinceAjax(Request $request){
        $user = Auth::user();
        $validator = \Validator::make($request->all(), [
            'province' => 'required',
        ]);

        $title = 'Editar Provincia';
        if ($validator->fails())
        {
            $province = Province::find($request->input('proviceId'))->toArray();
            echo view('pages.settings.province.edit-form', compact(['user', 'title', 'province']))->withErrors($validator)->render();
            exit;
        }else{
            $id = $request->input('proviceId');
            $formated_data = [
                "name" => $request->input("province"),
            ];
            ProvinceService::getInstance()->update($id, $formated_data);
            $province = Province::find($id)->toArray();
            $success = 'Exitosamente Editada';
            echo view('pages.settings.province.edit-form', compact(['user', 'title', 'success', 'province']))->render();
            exit;
        }

    }
    private function clearSession() {
        session()->reflash();
        session()->remove("error");
        session()->remove("status");
    }

    public function provinceViewList(Request $request){

        $user = Auth::user();
        if ($request->ajax()) {
            $draw 				= 		$request->get('draw'); // Internal use
            $start 				= 		$request->get("start"); // where to start next records for pagination
            $rowPerPage 		= 		10; // How many recods needed per page for pagination
            $orderArray 	   = 		$request->get('order');
            $columnNameArray 	= 		$request->get('columns'); // It will give us columns array

            $searchArray 		= 		$request->get('search');
            $columnIndex 		= 		$orderArray[0]['column'];  // This will let us know,
            // which column index should be sorted
            // 0 = id, 1 = name, 2 = email , 3 = created_at
            $columnName 		= 		$columnNameArray[$columnIndex]['data']; // Here we will get column name,
            // Base on the index we get
            $columnSortOrder 	= 		$orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
            $searchValue 		= 		$searchArray['value']; // This is search value

            //$provinces = ProvinceService::getAll();
            $provinces = Province::orderByDesc("created_at");
            $total = $provinces->count();

            $totalFilter = $provinces;
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('name','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $provinces = $provinces->skip($start)->take($rowPerPage);
            $provinces = $provinces->orderBy($columnName,$columnSortOrder);
            $arrData = $provinces->get();
            $chkResult = 0;
            $records = [];
            $mainArray = [];
            $subArray = [];
            foreach ($arrData as $row) {
                $allow_values = [];
                $subArray = [];
                $chkResult++;
                $id = isset($row->id) ? $row->id : '';
                $name = isset($row->name) ? $row->name : '';

                $string = '';
                $string .= '<div class="dropdown d-inline-block">';
                $string .='<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                $string .='<i class="ri-more-fill align-middle"></i>';
                $string .='</button>';
                $string .='<ul class="dropdown-menu dropdown-menu-end action-company">';
                $string .='<li>';
                $string .='<a data-province="'.$id.'" href="#" class="dropdown-item edit-item-btn" onclick="editProvince('.$id.')">';
                $string .='<i class="ri-pencil-fill align-bottom me-2 text-muted"></i>';
                $string .='Edit';
                $string .='</a>';
                $string .='</li>';
                $string .='<li>';
                $string .='<a data-province="'.$id.'"  class="dropdown-item"  style="cursor: pointer;color:#ff6c6c" onclick="deleteProvince('.$id.')">';
                $string .= '<i class="bi bi-trash"></i> Delete';
                $string .='</a>';
                $string .='</li>';
                $string .='</ul>';
                $string .='</div>';

                $subArray['name'] = $name;
                $subArray['Acciones'] = $string;
                array_push($mainArray, $subArray);
            }

            $records["data"] = $mainArray;
            $records["draw"] = intval($draw);
            $records["recordsTotal"] = intval($total);
            $records["recordsFiltered"] = $totalFilter;

           return json_encode($records);

        }
        return view("pages.settings.province.province-list", [
            "provinces" => array(),
            'user' => $user,
        ]);
    }

    function getProvinceDetail($id){
        $province = Province::find($id);

        return response()->json($province);
    }

    public function deleteProvince($id=0){
        $province_input_id = $id;
        try {
            $delete = ProvinceService::getInstance()->deleteOneById($province_input_id);

            if(!$delete) {
                $message = ['message'=>'No puede ser eliminado el vehículo'];
                return $message = ['message'=>'No puede ser eliminado el vehículo'];
                exit;
            }
            return $message = ['message'=>'No puede ser eliminado el vehículo'];
            exit;

        } catch (Exception $e) {
            session()->flash("status", "No puede ser eliminado el vehículo");
            exit;
            //return redirect()->route("list-province");
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
