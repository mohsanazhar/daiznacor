<?php

namespace App\Http\Controllers;

use App\Imports\ImportPolicy;
use App\Models\Company;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PolicyService;
use App\Services\InsuranceService;
use App\Services\CompanyService;
use App\Exports\ExportPolicy;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function createPolicy(){
        $user = Auth::user();
        $list = $this->getFormatList();

        $companies = CompanyService::getInstance()->get(100, 0, [
            "userLoggedId" => $user->id
        ]);

        return view('pages.policy.create_policy', [
            'user' => $user,
            'policies' => $list,
            'companies' => $companies,
        ]);
    }
    function get_policy_details(Request $request){
        $list = Policy::with('insuranceCompany')->find($request->input('id'));
        $data = [];

        $company = Company::find($list['identification_card']);
        $list['identification_card'] = (!is_null($company))?$company['identification_card']:"N/A";
        $list['insurance_company'] = $list['insurance_company'] ? $list['insurance_company']['name'] : "";
        $list['vehicleCount'] = $list['vehicles'] ? count($list['vehicles']) : 0;
        $company = $list['vehicleCount']>0 ? $list['vehicles'][0]['company'] : null;
        $list['companyId'] = $company ? $company['id'] : null;

        $companies = CompanyService::getInstance()->get(100, 0, [
            "userLoggedId" => \auth()->id(),
            'id'=>$request->input('id')
        ]);
        return  view('pages.policy.view_detail_modal',['item'=>$list]);

    }
    private function getFormatList() {

        $list = PolicyService::getInstance()->get(300, 0);

        $data = [];
        
        foreach ($list as $item) {
            $company = Company::find($item['identification_card']);
            $item['identification_card'] = (!is_null($company))?$company['identification_card']:"N/A";
            $item['insurance_company'] = $item['insurance_company'] ? $item['insurance_company']['name'] : "";
            $item['vehicleCount'] = $item['vehicles'] ? count($item['vehicles']) : 0;
            $company = $item['vehicles'] ? $item['vehicles'][0]['company'] : null;
            $item['companyId'] = $company ? $company['id'] : null;
            array_push($data, $item);
        }
        
        return $data;
    }

    private function clearSession() {
        session()->reflash();
        session()->remove("error");
        session()->remove("status");
    }

    public function viewList()
    {
        $this->clearSession();

        $user = Auth::user();
        $list = $this->getFormatList();

        $companies = CompanyService::getInstance()->get(100, 0, [
            "userLoggedId" => $user->id
        ]);

        return view('pages.policy.list', [
            'user' => $user,
            'policies' => $list,
            'companies' => $companies,
        ]);
    }

    public function create(Request $request){
        $this->clearSession();
        $request->validate([
            'policy-number' => ["required"],
            'insurance-company' => ["required"],
            'insured_name' => ["required"],
            'identification_card' => ["required"],
            'policy_expiration' => ["required"],
            'policy_issuance' => ["required"],
        ]);

        try {
            $insureFound = InsuranceService::getInstance()->findOneById($request->input("insurance-company"));

            if(!$insureFound) {
                session()->flash("error", "Compaña aseguradora no existe");
                return redirect()->route('listPolicy');
            }


            PolicyService::getInstance()->create([
                'number' => $request->input('number'),
                'insured_name' => $request->input('insured_name'),
                'identification_card' => $request->input('identification_card'),
                'policy_expiration' => $request->input('policy_expiration'),
                'policy_issuance' => $request->input("policy_issuance"),
                'insurance_company_id' => $insureFound->id
            ]);
    
            session()->flash("status", "La pólica ha sido creada");
    
            return redirect()->route('listPolicy');

        } catch (Exception $e) {
				
            session()->flash("error", "Error con guardar la póliza");

            return redirect()->route('listPolicy');
        }
    }

    public function update(Request $request) {

        $user = Auth::user();
        $id = $request->route("id");

        $this->clearSession();

        try {
            if(!is_string($id) || $id == ":id") {

                session()->flash("error", "No puede ser actualizado la póliza");

                return redirect()->route('listPolicy');
            }

            $insureFound = InsuranceService::getInstance()->findOneById($request->input("insurance_company_id"));

            $update = PolicyService::getInstance()->update($id, [
                'number' => $request->input('number'),
                'insured_name' => $request->input('insured_name'),
                'identification_card' => $request->input('identification_card'),
                'policy_expiration' => $request->input('policy_expiration'),
                'policy_issuance' => $request->input("policy_issuance"),
                'insurance_company_id' => $insureFound ? $insureFound->id : null
            ]);

            session()->flash("status", "$update->insured_name a sido actualizada");

            return redirect()->route('listPolicy');

        } catch (Exception $e) {
            
            return redirect()->route('listPolicy');
        }
    }

    public function delete(Request $request) {

        $this->clearSession();

        $user = Auth::user();
        $id = $request->route("id");

        if(!is_string($id)) {
            session()->flash("error", "No puede ser eliminado la póliza");
            return redirect()->route('listPolicy');
        }
        if($id == ":id") {
            session()->flash("error", "No puede ser eliminado la póliza");
            return redirect()->route('listPolicy');
        }

        $list = $this->getFormatList();
        $found = PolicyService::getInstance()->findOneById($id);
        if(!$found) {
            session()->flash("error", "No puede ser eliminado la póliza");
            return redirect()->route('listPolicy');
        }

        $isDeleted = PolicyService::getInstance()->deleteOneById($id);
        if(!$isDeleted) {
            session()->flash("error", "No puede ser eliminado la póliza");
            return redirect()->route('listPolicy');
        }

        session()->flash("status", "$isDeleted->insured_name a sido eliminado");

        $list = $this->getFormatList();
        return redirect()->route('listPolicy');
    }

    public function export()
    {
        return Excel::download(new ExportPolicy, 'policy.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function import(Request $request)
    {
        Excel::import(new ImportPolicy(), $request->file('file'));
        return redirect(route('listPolicy'))->with('success', 'All good!');
    }

}
