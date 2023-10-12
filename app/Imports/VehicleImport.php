<?php

namespace App\Imports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vehicle([
            //
        ]);
    }

    public function collection(Collection $rows)

    {
        foreach ($rows as $row) {

            Vehicle::create([
                'id'     => $row['id'],
                'name'    => $row['name'],
                'identification_card' => $row['identification_card'],
                'car_plate' => $row['car_plate'],
                'month_renewal' => $row['month_renewal'],
                'brand' => $row['brand'],
                'model' => $row['model'],
                'year' => $row['year'],
                'engine' => $row['engine'],
                'chassis' => $row['chassis'],
                'color'     => $row['color'],
                'mortgagee'    => $row['mortgagee'],
                'revised_no' => $row['revised_no'],
                'weights' => $row['weights'],
                'dimensions' => $row['dimensions'],
                'due_date' => $row['due_date'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'deleted_at' => $row['deleted_at'],
                'vehicle_type_id' => $row['vehicle_type_id'],
                'municipality_id' => $row['municipality_id'],
                'owner_id' => $row['owner_id'],
                'policy_id' => $row['policy_id'],
                'fuel_type_id' => $row['fuel_type_id'],
                'municipality_id' => $row['municipality_id'],
                'created_by_user_id' => $row['created_by_user_id'],
                'company_id' => $row['company_id'],

            ]);

        }

    }
}
