<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\InsuranceCompany;
use App\Models\Policy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPolicy implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Policy([
            'id'     => $row['id'],
            'number'    => $row['number'],
            'insured_name' => $row['insured_name'],
            'identification_card' => $row['identification_card'],
            'policy_issuance' => $row['policy_issuance'],
            'policy_expiration' => $row['policy_expiration'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'insurance_company_id' => $row['insurance_company_id'],
            'deleted_at' => $row['deleted_at'],
        ]);
    }
    function collection(Collection $collection)
    {
        // TODO: Implement collection() method.
        if(count($collection)>0){
            $rows = $collection->toArray();
            foreach ($rows as $k=>$v){
                $d['number'] = $v['policy_number'];
                $d['insured_name'] = "";
                $d['identification_card'] = 0;
                if(!is_null($v['identification_card'])){
                    $company = Company::where(['identification_card'=>$v['identification_card']])->get();
                    if(!is_null($company)){
                        $company = $company->first();
                        $d['insured_name'] = $company['name'];
                        $d['identification_card'] = $company['id'];
                    }
                }
                $d['policy_issuance'] = date('Y-m-d H:i',strtotime($v['policy_issuance']));
                $d['policy_expiration'] = date('Y-m-d H:i',strtotime($v['policy_expiration']));

                $d['insurance_company_id'] = 0;
                if(!is_null($v['insurance_company'])){
                    $company = InsuranceCompany::where(['name'=>$v['insurance_company']])->get();
                    if(!is_null($company)){
                        $company = $company->first();
                        $d['insurance_company_id'] = $company['id'];
                    }
                }
                Policy::create($d);
            }
        }
    }

    /**
     * @param Collection $rows
     */
    public function collections(Collection $rows)

    {
        foreach ($rows as $row) {
            dd($row);
            Policy::create([
                'id'     => $row['id'],
                'number'    => $row['number'],
                'insured_name' => $row['insured_name'],
                'identification_card' => $row['identification_card'],
                'policy_issuance' => $row['policy_issuance'],
                'policy_expiration' => $row['policy_expiration'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'insurance_company_id' => $row['insurance_company_id'],
                'deleted_at' => $row['deleted_at'],

            ]);

        }

    }
}
