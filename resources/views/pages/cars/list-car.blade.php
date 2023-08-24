@extends('layouts.master')
@section('title') Vehiculos @endsection

@section('css')
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Inicio @endslot
@slot('title') Vehiculos @endslot
@endcomponent

<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Registro de nuevo vehículo</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form
                    action="{{ route('createCar') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    autocomplete="off"
                    id="form-new-car"
                    class="needs-validation" 
                    novalidate
                >
                @csrf
                <div class="g-3 row">
                    <h3>Vehiculo</h3>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="user-name" class="form-label">
                                    Nombre del propietario
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input required type="text" id="user-name" class="user-name form-control" name="name" placeholder="Nombre del propietario" autocomplete="off">
                                    @error('name')
                                        <div class="d-block invalid-feedback text-danger">El nombre del propietario es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-identification_card" class="form-label">
                                    RUC/ Cédula
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select type="text" id="company-identification_card" placeholder="RUC" autocomplete="off"></select>
                                    @error('identification_card')
                                        <div class="d-block invalid-feedback text-danger">Identification es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="car_plate" class="form-label">
                                    Placa
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input required type="text" id="car_plate" class="form-control" name="car_plate" placeholder="Placa" autocomplete="off">
                                    @error('car_plate')
                                        <div  class="d-block invalid-feedback text-danger">La placa es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="month_renewal" class="form-label">
                                    Mes de renovacion
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select required type="email" id="month_renewal" class="form-control" name="month_renewal">
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                    @error('month_renewal')
                                    <div class="invalid-feedback text-danger">El mes es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="brand" class="form-label">
                                    Marca
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input id='brand' type="text" class="form-control" name="brand" placeholder="Marca" required autocomplete="off">
                                    @error('brand')
                                    <div class="invalid-feedback text-danger">La marca es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="model" class="form-label">
                                    Modelo
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="model" class="form-control" name="model" placeholder="Modelo" required autocomplete="off">
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
                                    <input type="text" id="year-car" placeholder="Seleccionar año" name="year" class="form-control flatpickr flatpickr-input" data-flatpickr='{"dateFormat": "Y"}' autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="chassis" class="form-label">
                                    Chasis
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="chassis" class="form-control" name="chassis" placeholder="Chasis" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">

                            <div>
                                <label for="engine" class="form-label">
                                    Motor
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="engine" class="form-control" name="engine" placeholder="Motor" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="color" class="form-label">Color</label>
                                <div>
                                    <input type="text" id="color" class="form-control" name="color" placeholder="Color" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="municipality" class="form-label">
                                    Municipio
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select name="municipality" id="municipality" aria-label="Selecciona el municipio">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="type-vehicle" class="form-label">
                                    Tipo de vehículo
                                </label>
                                <div>
                                    <select name="type-vehicle" id="type-vehicle" aria-label="Tipo de vehiculo">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="fuel-type" class="form-label">Tipo de combustible</label>
                                <div>
                                    <select name="fuel-type" id="fuel-type" aria-label="Tipo de combustible">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="no-polize" class="form-label">Numero de poliza</label>
                                <div>
                                    <select type="text" id="no-polize" name="no-polize" placeholder="Numero de poliza">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="insurance_companies" class="form-label">Compañia Aseguradora</label>
                                <div>
                                    <input disabled type="text" id="insurance_companies" class="form-control" name="insurance_companies" placeholder="Compañia Aseguradora" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                             <div>
                                <label for="weights" class="form-label">Numero de pesas y dimensiones</label>
                                <div>
                                    <input type="text" id="weights" class="form-control" name="weights" placeholder="Numero de pesas" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                          
                            <div>
                                <label for="due_date" class="form-label">Fecha de vencimiento</label>
                                <div>
                                    <input type="text" id="due_date" placeholder="Select date" name="due_date" class="form-control flatpickr flatpickr-input" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            {{--<div>
                                <label for="dimensions" class="form-label">Numero Dimensiones</label>
                                <div>
                                    <input type="text" id="dimensions" class="form-control" name="dimensions" placeholder="Numero de dimensiones" autocomplete="off">
                                </div>
                            </div>--}}
                            <div>
                                <label for="revised_no" class="form-label">Numero de revisado</label>
                                <div>
                                    <textarea type="text" id="revised_no" class="form-control" name="revised_no" placeholder="Numero de revisado" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mb-3">

                        </div>

                        <div class="col-lg-12 mb-3">
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" id="mortgagee" style="position: relative; top: -3px;margin-right: 6px;">
                                <label for="mortgagee" class="form-label">Acreedor hipotecario</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div>
                                <textarea type="text" id="mortgageeInfo" class="form-control"  name="mortgagee" style="display: none;"></textarea>
                            </div>
                        </div>
                        

                        <div class="hstack gap-2 justify-content-end">
                            <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- @show --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0">Lista de carros</h5>
                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                    @if(session("status"))
                        <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
                            <i class="bi bi-check-circle-fill mx-1"></i>
                                {{ session("status") }}
                            </div>
                        </div>
                    @endif
                    @if(session("error"))
                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                            <i class="bi bi-x-circle-fill mx-1"></i>
                                {{ session("error") }}
                            </div>
                        </div>
                    @endif
                    <div class='p-1'>
                        <a style="cursor: pointer;">
                            <a data-key="t-newCompany" data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;" class="btn btn-success">@lang('translation.new')</a>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="card-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del propietario</th>
                            <th>Identificatión</th>
                            <th>Placa</th>
                            <th>Mes</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Motor</th>
                            <th>Chasis</th>
                            <th>Color</th>
                            <th>Municipio</th>
                            <th>Tipo de vehículo</th>
                            <th>Tipo de Combustible</th>
                            <th>Acreedor Hipotecario</th>
                            <th>No. Póliza</th>
                            <th>Compañia de Aseguradora</th>
                            <th>No. de Revisado</th>
                            <th>No. Pesas / Dimensiones</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <x-cars.edit-modal :item="$car"/>
                            <tr>
                                <th class="opacity-75">
                                    {{ $car['id'] }}
                                </th>
                                <th>
                                    {{ $car['name'] }}
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['identification_card']))
                                        {{ $car['identification_card'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['car_plate']))
                                        {{ $car['car_plate'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['month_renewal']))
                                    {{ $car['month_renewal'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['brand']))
                                        {{ $car['brand'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['model']))
                                        {{ $car['model'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['year']))
                                        {{ $car['year'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['engine']))
                                        {{ $car['engine'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['chassis']))
                                        {{ $car['chassis'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['color']))
                                        {{ $car['color'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['municipaly']))
                                        {{ $car['municipaly'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['vehicleType']))
                                        {{ $car['vehicleType'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['fuelType']))
                                        {{ $car['fuelType'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['mortgagee']))
                                        {{ $car['mortgagee'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['policy']))
                                        {{ $car['policy']['number'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['policy']))
                                        {{ $car['policy']['insurance_company']['name'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['revised_no']))
                                        {{ $car['revised_no'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['weights']))
                                        {{ $car['weights'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['due_date']))
                                        {{ $car['due_date'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="{{ route('listGloveBox', $car['id']) }}" class="dropdown-item edit-item-btn cursor-pointer">
                                                    <i class="bi-folder-fill align-bottom me-2 text-muted"></i>
                                                    Guantera
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" data-bs-target="#updateCarModal{{ $car['id'] }}" class="dropdown-item edit-item-btn cursor-pointer">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    @lang('translation.edit')
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('deleteCar', $car['id']) }}" id="delete-car-item-{{ $car['id'] }}" method="POST" class="dropdown-item remove-item-btn cursor-pointer">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    <input type="submit" hidden class="ri-delete-bin-fill align-bottom me-2 text-muted"/>
                                                    @lang('translation.delete')
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(() => {
        $("#card-list").DataTable({
            buttons: [
                "reload", "excel"
            ],
            order: [[0, 'desc']],
            language: {
                emptyTable: "No hay datos disponibles en la tabla",
            }
        });

        $('#card-list tbody').on('click', 'form[id^="delete-car-item"]', function(event) {
            event.preventDefault();
            $(this).submit();
        });
    });
</script>

<script>
    $("#year-car").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    flatpickr(document.getElementById("due_date"), {
        dateFormat: "Y-m-d",
        minDate: `${new Date().getFullYear()}`,
        enableTime: false
    });
</script>

<script>
    const mortgagee = document.getElementById("mortgagee")

    mortgagee.addEventListener("click", () => {
        let checked = mortgagee.checked
        let info = document.getElementById("mortgageeInfo")

        info.style.display = checked ? "block" : "none"

        if(!checked){
            info.value = ""
        }
    });
</script>

<script>
    const compnaiesData = @json($companies);
    const policiesData = @json($policies);
    const form = document.getElementById("form-new-car")
</script>

<script>
    const handleInsertPolicies = (id) => {
        const data = policiesData.find(item => item.id == id);
        if(!data) return;

        const inputCompanyExist = document.getElementById("policy_id");
        if(inputCompanyExist) inputCompanyExist.value = data.id
        else {
            const inputCompany = document.createElement('input');
            
            inputCompany.name = "policy_id";
            inputCompany.id = "policy_id";
            inputCompany.hidden = true;
            inputCompany.value = data.id;
            form.appendChild(inputCompany);
        }

        document.getElementById("insurance_companies").value = data.insurance_company.name
    }

    const selectizeConfigPolicies = (id, data) => {
        const select = $(id).selectize({
            showAddOptionOnCreate: true,
            create: false,
            onChange: (item) => {
                handleInsertPolicies(item);
            }
        })[0];

        if(!select) return;

        const control = select.selectize;

        if(!data || !data.length){
            const data = { value: 0, text: "No hay polizas disponible" };
            return control.addOption(data);
        }
        data.forEach((item) => {
            const data = { value: item.id, text: item.identification_card };
            control.addOption(data);
        });
    }

    selectizeConfigPolicies("#no-polize", policiesData);
    $('select[id^="no-polize-update-"]').each(function () {
        selectizeConfigPolicies(`#${this.id}`, policiesData);
    });
</script>

<script>
    const handleInsertCompnay = (id) => {
        const company = compnaiesData.find(item => item.id == id);
        if(!company) return;

        const inputCompanyExist = document.getElementById("company_id");
        if(inputCompanyExist) inputCompanyExist.value = company.id;
        else {
            const inputCompany = document.createElement('input');
            inputCompany.name = "company_id";
            inputCompany.id = "company_id";
            inputCompany.hidden = true;
            inputCompany.value = company.id;
            form.appendChild(inputCompany);
        }
        
        const inputUserExist = document.getElementById("input-user-id");
        if(inputUserExist) inputUserExist.value = company.user.id;
        else {
            const inputUser = document.createElement('input');
            inputUser.name = "owner_id";
            inputUser.id = "input-user-id";
            inputUser.hidden = true;
            inputUser.value = company.user.id;
            form.appendChild(inputUser);
        }

        const inputIdentificationCard = document.getElementById("identification-card-compnay");
        if(inputIdentificationCard) inputIdentificationCard.value = company.identification_card;
        else {
            const inputIdentification = document.createElement('input');
            inputIdentification.name = "identification_card";
            inputIdentification.id = "identification-card-compnay";
            inputIdentification.hidden = true;
            inputIdentification.value = company.identification_card;
            form.appendChild(inputIdentification);
        }
        console.log(company.user.name);
        $('.user-name').val(company.user.name);
    }

    const selectizeConfigCompanies = (id, data) => {
    const select = $(id).selectize({
        showAddOptionOnCreate: true,
        create: false,
        onChange: (item) => {
            handleInsertCompnay(item);
        }
    })[0];

    if(!select) return;

    const control = select.selectize;

    if(!data || !data.length){
        const data = { value: 0, text: "No hay empresas disponible" };
        return control.addOption(data);
    }
    data.forEach((item) => {
        const data = { value: item.id, text: item.identification_card };
        control.addOption(data);
    });
    }

    $('select[id^="company-update-identification-card-"]').each(function () {
        selectizeConfigCompanies(`#${this.id}`, compnaiesData);
    });

    selectizeConfigCompanies("#company-identification_card", compnaiesData);
</script>

<script src="{{ URL::asset('build/js/pages/vehicle/index.js') }}"></script>
@endsection
