@props([
    "item",
    "provinces",
    "vehicleType",
    "fuelType",
    "policies"
])

<div class="modal fade" id="updateCarModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Actualizando vehículo</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form
                    action="{{ route('editCar', $item['id']) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    autocomplete="off"
                    id="card-form-update-{{ $item['id'] }}"
                    class="needs-validation edit-car-form"
                    novalidate
                >
                @csrf
                @method("PATCH")
                <div class="g-3 row">
                    <h3>Vehiculo</h3>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="user-name" class="form-label">Nombre del propietario</label>
                                <div>
                                    <input value="{{ $item['name'] }}" type="text" id="user-name" class="form-control user-name" name="name" placeholder="Nombre del propietario" autocomplete="off">
                                    @error('name')
                                        <div class="d-block invalid-feedback text-danger">El nombre del propietario es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-update-identification-card-{{ $item['id'] }}" class="form-label">RUC/ Cédula</label>
                                <div>
                                    <select id="company-update-identification-card-{{ $item['id'] }}" name="identification_card">
                                        <option selected>Seleccionar</option>
                                    </select>
                                    @error('identification_card')
                                        <div class="d-block invalid-feedback text-danger">Identification es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="car_plate" class="form-label">Placa</label>
                                <div>
                                    <input value="{{ $item['car_plate'] }}" type="tel" id="car_plate" class="form-control" name="car_plate" placeholder="Placa" autocomplete="off">
                                    @error('car_plate')
                                        <div  class="d-block invalid-feedback text-danger">La placa es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="month_renewal" class="form-label">Mes de renovacion</label>
                                <div>
                                    <select type="email" id="month_renewal" class="form-control" name="month_renewal">
                                        @php
                                        $months = \App\Helper\RequestHelper::months();
                                        @endphp
                                        @foreach($months as $k=>$v)
                                            <option value="{{$k}}" {{($item['month_renewal']==$k)?'selected':''}}>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    @error('month_renewal')
                                        <div class="invalid-feedback text-danger">El mes es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="brand" class="form-label">Marca</label>
                                <div>
                                    <input value="{{ $item['brand'] }}" id='brand' type="text" class="form-control" name="brand" placeholder="Marca" autocomplete="off">
                                    @error('brand')
                                    <div class="invalid-feedback text-danger">La marca es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">

                            <div>
                                <label for="model" class="form-label">Modelo</label>
                                <div>
                                    <input value="{{ $item['model'] }}" type="text" id="model" class="form-control" name="model" placeholder="Modelo" autocomplete="off">
                                    @error('brand')
                                    <div class="d-block invalid-feedback text-danger">El modelo es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="year-car" class="form-label">Año del vehiculo</label>
                                <div>
                                    <input value="{{ $item['year'] }}" type="text" id="year-car-{{ $item['id'] }}" placeholder="Seleccionar año" name="year" class="year-car form-control flatpickr flatpickr-input" data-flatpickr='{"dateFormat": "Y"}' autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="chassis" class="form-label">Chasis</label>
                                <div>
                                    <input value="{{ $item['chassis'] }}" type="text" id="chassis" class="form-control" name="chassis" placeholder="Chasis" autocomplete="off">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="engine" class="form-label">Motor</label>
                                <div>
                                    <input value="{{ $item['engine'] }}" type="text" id="engine" class="form-control" name="engine" placeholder="Motor" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="color" class="form-label">Color</label>
                                <div>
                                    <input value="{{ $item['color'] }}" type="text" id="color" class="form-control" name="color" placeholder="Color" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-4 mb-3">
                        <div>
                            <label for="municipality" class="form-label">Municipio</label>
                            <div>
                                <select name="municipality_id" class="form-control" id="municipality-update-{{ $item['id'] }}" aria-label="Selecciona el municipio">
                                    @if(count($provinces)>0)
                                        @foreach($provinces as $k=>$v)
                                            <option value="{{$v['id']}}" {{($item['municipaly']==$v['name'])?'selected':''}}>{{$v['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div>
                            <label for="type-vehicle" class="form-label">Tipo de vehiculo</label>
                            <div>
                                <select name="vehicle_type_id" class="form-control"  id="type-vehicle-update-{{ $item['id'] }}" aria-label="Tipo de vehiculo">

                                    @if(count($vehicleType)>0)
                                        @foreach($vehicleType as $k=>$v)
                                            <option value="{{$v['id']}}" {{($item['vehicleType']==$v['name'])?'selected':''}}>{{$v['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div>
                            <label for="fuel-type" class="form-label">Tipo de combustible</label>
                            <div>
                                <select name="fuel_type_id" class="form-control"  id="fuel-type-update-{{ $item['id'] }}" aria-label="Tipo de combustible">
                                    @if(count($fuelType)>0)
                                        @foreach($fuelType as $k=>$v)
                                            <option value="{{$v['id']}}" {{($item['fuelType']==$v['name'])?'selected':''}}>{{$v['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="no-polize-update-{{ $item['id'] }}" class="form-label">Numero de poliza</label>
                                <div>
                                    <select  class="form-control policy_id_select" name="policy_id" placeholder="Numero de poliza" >
                                        <option value=""></option>
                                        @if(count($policies)>0)
                                            @foreach($policies as $k=>$v)
                                                <option value="{{$v['id']}}" {{(!is_null($item['policy']) && $item['policy']['id']==$v['id'])?'selected':''}} data-name="{{$v['insurance_company']['name']}}">{{$v['number']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="insurance_companies" class="form-label">Compañia Aseguradora</label>
                                <div>
                                    @if(isset($item['policy']))
                                        <input value="{{ $item['policy']['insurance_company']['name'] }}" type="text" id="insurance_companies" class="form-control" name="insurance_companies" placeholder="Compañia Aseguradora" autocomplete="off">
                                    @else
                                        <input type="text" id="insurance_companies" class="form-control" name="insurance_companies" placeholder="Compañia Aseguradora" autocomplete="off">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="weights" class="form-label">Numero de pesas y dimensiones</label>
                                <div>
                                    <input value="{{ $item['weights'] }}" type="text" id="weights" class="form-control" name="weights" placeholder="Numero de pesas" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">

                            <div>
                                <label for="due_date" class="form-label">Fecha de vencimiento</label>
                                <div>
                                    @if(isset($item['policy']))
                                        <input value="{{ $item['policy']['policy_expiration'] }}" type="text" id="due_date" placeholder="Select date" name="due_date" class="form-control flatpickr flatpickr-input" autocomplete="off">
                                    @else
                                        <input type="text" id="due_date" placeholder="Select date" name="due_date" class="due_date form-control flatpickr flatpickr-input" autocomplete="off">
                                    @endif
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-4 mb-3">
                        @php
                            $status = \App\Helper\RequestHelper::vehicle_status();
                        @endphp
                        <div>
                            <label for="due_date" class="form-label">@lang('translation.status')</label>
                            <div>
                                <select class="form-control"  name="status">
                                    <option value="">Please select option</option>
                                    @foreach($status as $k=>$v)
                                        <option value="{{$k}}" style="background-color:{{$v}}">{{ucwords($k)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-12 mb-3">
                            <div>
                                <label for="revised_no" class="form-label">Numero de revisado</label>
                                <div>
                                    <textarea type="text" id="revised_no" class="form-control" name="revised_no" placeholder="Numero de revisado">{{$item['revised_no']}}</textarea>
                                </div>
                            </div>
                            {{--<div>
                                <label for="dimensions" class="form-label">Numero Dimensiones</label>
                                <div>
                                    <input value="{{ $item['dimensions'] }}" type="text" id="dimensions" class="form-control" name="dimensions" placeholder="Numero de dimensiones" autocomplete="off">
                                </div>
                            </div>--}}
                        </div>

                        <div class="col-lg-12 mb-3">

                        </div>

                    <div class="col-lg-12 mb-3">
                        <div style="display: flex; align-items: center;">
                            <input type="checkbox" id="editmortgagee" style="position: relative; top: -3px;margin-right: 6px;" {{($item['mortgagee']!='')?'checked':''}}>
                            <label for="editmortgagee" class="form-label">Acreedor hipotecario</label>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <div>
                            @php
                            $display = "none";
                            if($item['mortgagee']!=''){
                                $display = 'block';
                            }
                            @endphp
                            <textarea type="text" id="editmortgageeInfo" class="form-control"  name="mortgagee" style="display: {{$display}};">{{$item['mortgagee']}}</textarea>
                        </div>
                    </div>
                        

                        <div class="hstack gap-2 justify-content-end">
                            <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>