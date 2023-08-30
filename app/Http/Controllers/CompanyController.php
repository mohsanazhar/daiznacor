<?php

namespace App\Http\Controllers;

use App\Helper\RequestHelper;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOne(Request $request){

        try {
            $user = Auth::user();
            $id = $request->route("id");

            if(!is_string($id)) throw new Exception('Property "id" is br string', 400);
            if($id == ":id") throw new Exception('Property "id" is mandatory', 400);

            $take = $request->query("take", 10);
            $offset = $request->query("offset", 0);

            $companies = CompanyService::getInstance()->get($take, $offset, [
                'userLoggedId' => $user->id
            ]);

            $company = CompanyService::getInstance()->findOneById($id);
            // if(!$company) 

            return view("pages.company.list", [
                "companies" => compact($companies),
                'user' => $user
            ]);
        } catch (Exception $e) {
            return redirect()->route('lisCompany');
        }

    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ["required"],
            'email' => ["required"],
            'identification_card' => ["required"],
            'phone' => ["required"],
        ]);

        $imagePath = null;
        $host = $request->getSchemeAndHttpHost();
        $image = RequestHelper::uploadImage($request, 'image');

        if($image) $imagePath = $image->getPathname();
    
        try {
            CompanyService::getInstance()->create([ 
                'name' => $request->input("name"),
                'phone' => $request->input("phone"),
                'dv'=> $request->input('dv'),
                'email' => strtolower($request->input("email")),
                'identification_card' => $request->input("identification_card"),
                'street' => $request->input("street"),
                'corregimiento' => $request->input("corregimiento"),
                'house_number' => $request->input("house_number"),
                'province' => $request->input("province"),
                'district' => $request->input("district"),
                'image' => $imagePath ? "$host/$imagePath" : null
            ], $user->id);

            session()->flash("status", "La empresa se ha insertado satisfactoriamente.");

            return redirect()->route('lisCompany');
        } catch (Exception $e) {
            session()->flash("error", $e->getMessage() ? $e->getMessage() : "No se pudo crear la empresa");
            return redirect()->route('lisCompany');
        }
        
    }

    public function update(Request $request) {        
        try {
            $id = $request->route("id");
          
            if(!is_string($id) || $id == ":id") return redirect()->route('lisCompany');

            $imagePath = null;
            $host = $request->getSchemeAndHttpHost();
            $image = RequestHelper::uploadImage($request, 'image');
            if($image) $imagePath = $image->getPathname();

            CompanyService::getInstance()->update($id, [
                'name' => $request->input("name"),
                'dv'=> $request->input('dv'),
                'identification_card' => $request->input('identification_card'),
                'street' => $request->input("street"),
                'corregimiento' => $request->input("corregimiento"), 
                'house_number' => $request->input("house_number"),
                'province' => $request->input("province"),
                'district' => $request->input("district"),
                'image' => $imagePath ? "$host/$imagePath" : null
            ]);

            session()->flash("status", "La empresa ha sido editada correctamente.");
            return redirect()->route('lisCompany');
        } catch (Exception $e) {

            session()->flash("error", $e->getMessage() ? $e->getMessage() : "No se pudo editar la empresa");
            return redirect()->route('lisCompany');
        }
    }

    public function destroy(Request $request) {

        try {
            $id = $request->route("id");

            if(!is_string($id) || $id == ":id") return redirect()->route('lisCompany');

            CompanyService::getInstance()->deleteOneById($id);

            session()->flash("status", "La Empresa a sudo eliminada");

            return redirect()->route('lisCompany');
            
        } catch (Exception $e) {
            session()->flash("error", "La Empresa no puede ser elimininada en estos momentos");
            return redirect()->route('lisCompany');
        }
    }

    public function viewList(Request $req)
    {
        $user = Auth::user();
        $take = $req->query("take", 10);
        $offset = $req->query("offset", 0);

        $companies = CompanyService::getInstance()->get($take, $offset, [
            'userLoggedId' => $user->id
        ]);

        // dd($companies);

        return view('pages.company.list', 
        [ 
            "companies" => $companies,
            'user' => $user 
        ]);
    }

    public function viewEdit(Request $req, $id)
    {
        $user = Auth::user();
       
        $company = CompanyService::getInstance()->findOneById($id);

        if(!$company || $company->created_by_user_id != $user->id){
            return  view('pages.errors.404');
        }

        return view('pages.company.edit', [ 
            "company" => $company,
            'user' => $user 
        ]);
    }
}