<?php

namespace App\Exports;


use App\Models\Company;
use App\Models\FuelType;
use App\Models\Municipaly;
use App\Models\Policy;
use App\Models\TypeVehicle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleExport implements ToCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(Collection $rows)
    {
        if(count($rows)>0){
            $rows = $rows->toArray();
            foreach ($rows as $k=>$v){
                $company = [];
                $d = [];
                if(!is_null($v['nombre_del_propietario'])){
                    $company  = Company::where(['name'=>$v['nombre_del_propietario']])->get();
                    if(!is_null($company)){
                        $company = $company->first();
                        $d['identification_card'] = $company['identification_card'];
                        $d['name'] = $v['nombre_del_propietario'];
                        $d['owner_id'] = $company['user_id'];
                        $d['company_id'] = $company['id'];
                    }
                }
                $d['car_plate'] = $v['placa'];
                $d['month_renewal'] = $v['mes_de_renovacion'];
                $d['brand'] = $v['marca'];
                $d['model'] = $v['modelo'];
                $d['year'] = $v['ano_del_vehiculo'];
                $d['engine'] = $v['motor'];
                $d['chassis'] = $v['chasis'];
                $d['color'] = $v['color'];
                $d['mortgagee'] = $v['mortgagee'];
                $d['revised_no'] = $v['numero_de_revisado'];
                $d['weights'] = $v['numero_de_pesas_y_dimensiones'];
                $d['dimensions'] = $v['numero_de_pesas_y_dimensiones'];
                $d['due_date'] = $v['fecha_de_vencimiento'];
                $d['status'] = $v['estado'];
                $vehicle_type = null;
                if (!is_null($v['tipo_de_vehiculo'])){
                    $vehicle_type = TypeVehicle::where(['name'=>$v['tipo_de_vehiculo']])->get();
                    if(!is_null($vehicle_type)){
                        $vehicle_type = $vehicle_type->first();
                        $vehicle_type = $vehicle_type['id'];
                    }
                }
                $d['vehicle_type_id'] = $vehicle_type;
                $municipality = null;
                if (!is_null($v['tipo_de_vehiculo'])){
                    $municipality = Municipaly::where(['name'=>$v['municiplo']])->get();
                    if(!is_null($municipality)){
                        $municipality = $municipality->first();
                        $municipality = $municipality['id'];
                    }
                }
                $d['municipality_id'] = $municipality;
                $policy = null;
                if (!is_null($v['numero_de_poliza'])){
                    $policy = Policy::where(['number'=>$v['numero_de_poliza']])->get();
                    if(!is_null($policy)){
                        $policy = $policy->first();
                        $policy = $policy['id'];
                    }
                }
                $d['policy_id'] = $policy;
                $fuel_type = null;
                if (!is_null($v['tipe_de_combustible'])){
                    $fuel_type = FuelType::where(['name'=>$v['tipe_de_combustible']])->get();
                    if(!is_null($fuel_type)){
                        $fuel_type = $fuel_type->first();
                        $fuel_type = $fuel_type['id'];
                    }
                }
                $d['fuel_type_id'] = $fuel_type;
                $d['created_by_user_id'] = auth()->id();
                $chk = Vehicle::where([
                    'car_plate'=>$d['car_plate'],
                    'owner_id'=>$d['owner_id'],
                ])->count();
                if($chk<=0){
                    $model = new Vehicle();
                    $model->fill($d);
                    $model->save();
                }
            }
        }
        session()->flash('status','File is imported successfully');
        return redirect()->to(route('listCar'));

    }

    public function headings(): array
    {
        return [
            "id",
            "name",
            "identification_card",
            "car_plate",
            "month_renewal",
            "brand",
            "model",
            "year",
            "engine",
            "chassis",
            "color",
            "mortgagee",
            "revised_no",
            "weights",
            "dimensions",
            "due_date",
            "created_at",
            "updated_at",
            "deleted_at",
            "vehicle_type_id",
            "municipality_id",
            "owner_id",
            "policy_id",
            "fuel_type_id",
            "created_by_user_id",
            "company_id"

        ];
    }
}
