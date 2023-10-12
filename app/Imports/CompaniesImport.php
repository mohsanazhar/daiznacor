<?php
/**
 * Created by PhpStorm.
 * User: dawla
 * Date: 10/11/2023
 * Time: 12:04 PM
 */

namespace App\Imports;


use App\Models\Company;
use App\Models\CompanyEmail;
use App\Models\CompanyPhoneNumber;
use App\Models\Corregimiento;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToCollection,WithHeadingRow
{
    function collection(Collection $rows)
    {
        // TODO: Implement collection() method.
        if(count($rows)>0){
            $rows = $rows->toArray();
            foreach ($rows as $k=>$v){
                $d['name'] = $v['nombre_o_empresa'];
                $d['dv'] = $v['dv'];
                $d['identification_card'] = $v['identification_card'];
                $d['district'] = 0;
                if(!is_null($v['distrito'])){
                    $district = District::where(['name'=>$v['distrito']])->get();
                    if(!is_null($district)){
                        $district = $district->first();
                        $d['district'] = $d['district_id']  = $district['id'];
                    }
                }
                $d['corregimiento'] = 0;
                if(!is_null($v['corregimiento'])){
                    $corregimiento = Corregimiento::where(['name'=>$v['corregimiento']])->get();
                    if(!is_null($corregimiento)){
                        $corregimiento = $corregimiento->first();
                        $d['corregimiento'] = $d['corregimiento_id'] = $corregimiento['id'];
                    }
                }
                $d['province_id'] = 0;
                if(!is_null($v['provincia'])){
                    $province = Province::where(['name'=>$v['provincia']])->get();
                    if(!is_null($province)){
                        $province = $province->first();
                        $d['province_id'] = $province['id'];
                    }
                }
                $d['street'] = $v['calle'];
                $d['house_number']= $v['local'];
                $d['user_id'] = auth()->id();
                $d['created_by_user_id'] = auth()->id();
                $company = Company::create($d);
                // saving company emails
                $c_emails = [
                    'email'=>$v['correo_electronico'],
                    'company_id'=>$company['id']
                ];
                $emails = CompanyEmail::create($c_emails);
                // saving company phone
                $c_phone = [
                    'phone_number'=>$v['telefono'],
                    'company_id'=>$company['id']
                ];
                $phones = CompanyPhoneNumber::create($c_phone);
            }
        }
    }

}