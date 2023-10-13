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
                $string .='<a data-province="'.$id.'" href="javascript:;" class="dropdown-item edit-item-btn" onclick="editProvince('.$id.')">';
                $string .='<i class="ri-pencil-fill align-bottom me-2 text-muted"></i>';
                $string .='Editar';
                $string .='</a>';
                $string .='</li>';
                $string .='<li>';
                $string .='<a data-province="'.$id.'"  href="javascript:;" class="dropdown-item"  style="cursor: pointer;color:#ff6c6c" onclick="deleteProvince('.$id.')">';
                $string .= '<i class="bi bi-trash"></i> Eliminar';
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

    function districtViewList(Request $request){
        $user = Auth::user();
        if ($request->ajax()) {
            $draw 	= 	$request->get('draw'); // Internal use
            $start 	= 	$request->get("start"); // where to start next records for pagination
            $rowPerPage = 	10; // How many recods needed per page for pagination
            $orderArray  = 	$request->get('order');
            $columnNameArray = 	$request->get('columns'); // It will give us columns array

            $searchArray = 	$request->get('search');
            $columnIndex 		= 		$orderArray[0]['column'];  // This will let us know,
            // which column index should be sorted
            // 0 = id, 1 = name, 2 = email , 3 = created_at
            $columnName 		= 		$columnNameArray[$columnIndex]['data']; // Here we will get column name,
            // Base on the index we get
            $columnSortOrder 	= 		$orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
            $searchValue 		= 		$searchArray['value']; // This is search value

            $district = District::join('provinces', 'provinces.id', '=', 'districts.province_id')->orderByDesc("districts.created_at");

            $total = $district->count();

            $totalFilter = $district;
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('districts.name','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $district = $district->skip($start)->take($rowPerPage);
            $district = $district->orderBy($columnName,$columnSortOrder);
            $arrData = $district->get(['districts.id', 'districts.name', 'provinces.name as provinceName', 'districts.province_id as provinceId']);
            $records = [];
            $mainArray = [];
            foreach ($arrData as $row) {
                $subArray = [];
                $id = isset($row->id) ? $row->id : '';
                $name = isset($row->name) ? $row->name : '';
                $provinceName = isset($row->provinceName) ? $row->provinceName : '';
                $string = '';
                $string .= '<div class="dropdown d-inline-block">';
                $string .='<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                $string .='<i class="ri-more-fill align-middle"></i>';
                $string .='</button>';
                $string .='<ul class="dropdown-menu dropdown-menu-end action-company">';
                $string .='<li>';
                $string .='<a data-province="'.$id.'" href="javascript:;" class="dropdown-item edit-item-btn" onclick="editDistrict('.$id.')">';
                $string .='<i class="ri-pencil-fill align-bottom me-2 text-muted"></i>';
                $string .='Editar';
                $string .='</a>';
                $string .='</li>';
                $string .='<li>';
                $string .='<a data-province="'.$id.'" href="javascript:;" class="dropdown-item"  style="cursor: pointer;color:#ff6c6c" onclick="deleteDistrict('.$id.')">';
                $string .= '<i class="bi bi-trash"></i> Eliminar';
                $string .='</a>';
                $string .='</li>';
                $string .='</ul>';
                $string .='</div>';

                $subArray['name'] = $name;
                $subArray['provinceName'] = $provinceName;
                $subArray['Acciones'] = $string;
                array_push($mainArray, $subArray);
            }

            $records["data"] = $mainArray;
            $records["draw"] = intval($draw);
            $records["recordsTotal"] = intval($total);
            $records["recordsFiltered"] = $totalFilter;

            return json_encode($records);

        }
        return view("pages.settings.district.district-list", [
            "provinces" => array(),
            'user' => $user,
        ]);
    }

    public function createDistrictAjax($id=''){
        if($id) {
            $title = 'Editar Distrito';
            $provinces = ProvinceService::getInstance()->get();
            $district = District::find($id)->toArray();
            echo view('pages.settings.district.edit-form', compact(['title','district', 'provinces']))->render();
            exit;
        }else{
            $title = 'Nueva Distrito';
            $provinces = ProvinceService::getInstance()->get();
            echo view('pages.settings.district.new-form', compact(['title', 'provinces']))->render();
            exit;
        }
    }

    public function storeDistrictAjax(Request $request){
        $user = Auth::user();
        $validator = \Validator::make($request->all(), [
            'district' => 'required',
            'selectedProvince' => 'required',
        ]);
        $title = 'Nueva Distrito';
        $provinces = ProvinceService::getInstance()->get();
        if ($validator->fails())
        {
            //$validator= $validator->messages();
            echo view('pages.settings.district.new-form', compact(['user', 'title', 'provinces']))->withErrors($validator)->render();
            exit;
        }else{
            $name = $request->input('district');
            $province_id = $request->input('selectedProvince');
            DistrictService::getInstance()->create([
                'name' => $name,
                'province_id' =>  $province_id
            ]);
            $success = 'Exitosamente Agregada';
            echo view('pages.settings.district.new-form', compact(['user', 'title', 'provinces', 'success']))->render();
            exit;
        }
    }

    public function updateDistrictAjax(Request $request){
        $user = Auth::user();
        $validator = \Validator::make($request->all(), [
            'district' => 'required',
            'selectedProvince' => 'required',
        ]);
        $provinces = ProvinceService::getInstance()->get();
        $title = 'Editar Distrito';
        if ($validator->fails())
        {
            $district = District::find($request->input('districtId'))->toArray();
            echo view('pages.settings.district.edit-form', compact(['user', 'title', 'district', 'provinces']))->withErrors($validator)->render();
            exit;
        }else{
            $id = $request->input('districtId');
            $formated_data = [
                "name" => $request->input("district"),
                "province_id" => $request->input("selectedProvince"),
            ];
            DistrictService::getInstance()->update($id, $formated_data);
            $district = District::find($id)->toArray();
            $success = 'Exitosamente Editada';
            echo view('pages.settings.district.edit-form', compact(['user', 'title', 'district', 'success', 'provinces']))->render();
            exit;
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

    public function deleteDistrict($id = ''){
        $district_input_id = $id;
        try {
            $delete = DistrictService::getInstance()->deleteOneById($district_input_id);

            if(!$delete) {
                return $message = ['message'=>'No puede ser eliminado el vehículo'];
                exit;
            }

            return $message = ['message'=>'El Vehículo ha sido eliminado'];
            exit;


            return redirect()->route("list-district");

        } catch (Exception $e) {
            return $message = ['message'=>'No puede ser eliminado el vehículo'];
            exit;
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
