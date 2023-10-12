<?php
/**
 * Created by PhpStorm.
 * User: dawla
 * Date: 10/12/2023
 * Time: 10:20 AM
 */

namespace App\Exports;


use App\Models\Company;
use App\Models\CompanyEmail;
use App\Models\CompanyPhoneNumber;
use App\Models\Corregimiento;
use App\Models\District;
use App\Models\Province;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements WithHeadings, FromQuery
{
    use Exportable;
    function prepareRows($rows){
        return $rows->transform(function ($map_row) {
            $phones = CompanyPhoneNumber::where(['company_id'=>$map_row->id])->get();
            $phones = (!is_null($phones))?$phones->first()->toArray():[];
            $phone = (array_key_exists('phone_number',$phones))?$phones['phone_number']:"";
            // emails
            $emails = CompanyEmail::where('company_id',$map_row->id)->get();
            $emails = (!is_null($emails))?$emails->first()->toArray():[];
            $email = (array_key_exists('email',$emails))?$emails['email']:"";
            $provinces = Province::find($map_row->province_id);
            $district = District::find($map_row->district_id);
            $corregimiento = Corregimiento::find($map_row->corregimiento_id);
            $d = [
                $map_row->id,
                $map_row->name,
                $map_row->identification_card,
                $map_row->dv,
                $phone,
                $email,
                $provinces->name,
                $district->name,
                $corregimiento->name,
                $map_row->house_number,
                $map_row->street,
                $map_row->created_at
            ];

            return $d;
        });
    }
    function headings(): array
    {
        return [
            "id",
            "Nombre o Empresa",
            "Cedula",
            "DV",
            "Telefono",
            "correo electronico",
            "provincia",
            "distrito",
            "corregimiento",
            "calle",
            "local",
            "created_at",

        ];
    }
    function query()
    {
        return Company::query()->where('created_by_user_id',auth()->id());
    }

}