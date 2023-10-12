<?php

namespace App\Exports;

use App\Models\Policy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPolicy implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Policy::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'number',
            'insured_name',
            'identification_card',
            'policy_issuance',
            'policy_expiration',
            'created_at',
            'updated_at',
            'insurance_company_id ',
            'deleted_at'
        ];
    }
}
