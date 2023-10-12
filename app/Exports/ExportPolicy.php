<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\InsuranceCompany;
use App\Models\Policy;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPolicy implements FromQuery, WithHeadings
{
    use Exportable;
    function prepareRows($rows){
        return $rows->transform(function ($map_row) {
            $phones = InsuranceCompany::find($map_row->insurance_company_id);
            $phones = (!is_null($phones))?$phones->first()->toArray():[];
            $phone = (array_key_exists('name',$phones))?$phones['name']:"";
            // emails
            $identification_card = Company::find($map_row->identification_card);
            $identification_card = (!is_null($identification_card))?$identification_card->first()->toArray():[];
            $identification_card = (array_key_exists('identification_card',$identification_card))?$identification_card['identification_card']:"";
            $d = [
                $map_row->id,
                $map_row->number,
                $phone,
                $map_row->insured_name,
                $identification_card,
                $map_row->policy_issuance,
                $map_row->policy_expiration
            ];
            return $d;
        });
    }
    public function query()
    {
        return Policy::query();
    }

    public function headings(): array
    {
        return [
            'id',
            'no. poliza',
            'compania aseguradora',
            'nombre del asegurado',
            'cedula',
            'emision de la poliza',
            'vencimiento de la poliza',
        ];
    }
}
