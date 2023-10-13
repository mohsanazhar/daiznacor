<?php

namespace App\Exports;


use App\Models\Company;
use App\Models\FuelType;
use App\Models\Municipaly;
use App\Models\Policy;
use App\Models\TypeVehicle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VehicleExport implements WithHeadings, FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct(int $user)
    {
        $this->user = $user;
    }
    function prepareRows($rows){
        return $rows->transform(function ($map_row) {
            $municipo = Municipaly::find($map_row->municipality_id);
            $vehicleType = TypeVehicle::find($map_row->vehicle_type_id);
            $fuel_type = FuelType::find($map_row->fuel_type_id);
            $policy = Policy::find($map_row->policy_id);
            $d = [
                $map_row->id,
                $map_row->name,
                $map_row->identification_card,
                $map_row->car_plate,
                $map_row->month_renewal,
                $map_row->brand,
                $map_row->model,
                $map_row->year,
                $map_row->engine,
                $map_row->chassis,
                $map_row->color,
                $municipo->name,
                $vehicleType->name,
                $fuel_type->name,
                $policy->number,
                $policy->insured_name,
                $map_row->weights,
                $map_row->due_date,
                $map_row->status,
                $map_row->revised_no,
                $map_row->mortgagee,
                $map_row->created_at
            ];

            return $d;
        });
    }
    public function query()
    {
        // TODO: Implement query() method.
        return Vehicle::query()->where('created_by_user_id',$this->user);
    }

    public function headings(): array
    {
        return [
            "id",
            "Nombre del propietario",
            "Cédula",
            "Place",
            "mes de renovacion",
            "marca",
            "modelo",
            "Año del vehiculo",
            "chassis",
            "motor",
            "color",
            "municipio",
            "tipe de vehiculo",
            "tipe de combustible",
            "numero de poliza",
            "compania aseguradora",
            "numero de pesas y dimensiones",
            "fecha de vencimiento",
            "estado",
            "numero de revisado",
            "mortgagee",
            "created_at",
            ];
    }
}
