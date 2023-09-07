@extends('layouts.master')
@section('title') Vehiculos @endsection

@section('css')
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Inicio @endslot
@slot('title') Vehiculos @endslot
@endcomponent

@include('pages.cars.create_car_form')
{{-- @show --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0">Lista de carros</h5>
                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                     @include('layouts.common.display_error')
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
                            <x-cars.edit-modal :item="$car" :$provinces :$vehicleType :$fuelType/>
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
@php
if(session()->has('status')){
    session()->remove('status');
}
if(session()->has('error')){
    session()->remove('error');
}
if(session()->has('validError')){
    session()->remove('validError');
}
@endphp
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(function(){
        var form = document.getElementById('form-new-car');
        form.addEventListener('submit', function (event) {

            // add was-validated to display custom colors
            form.classList.add('was-validated')
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

        }, false);
    });
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
    $(".year-car").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    flatpickr(document.getElementsByClassName("due_date"), {
        dateFormat: "Y-m-d",
        minDate: `${new Date().getFullYear()}`,
        enableTime: false
    });
</script>

<script>
    $(document).on('click','#mortgagee',function(){
        let checked = $('#mortgagee').is(':checked');
        let info = $('#mortgageeInfo').val();
        if(checked){
            $('#mortgageeInfo').css("display", "block");
        }else{
            $('#mortgageeInfo').css("display", "none");
        }
    });
    $(document).on('click','#editmortgagee',function(){
        let checked = $('#editmortgagee').is(':checked');
        let info = $('#editmortgageeInfo').val();
        if(checked){
            $('#editmortgageeInfo').css("display", "block");
        }else{
            $('#editmortgageeInfo').css("display", "none");
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
            const data = { value: item.id, text: item.number };
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
        console.log(company.identification_card);
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
        //console.log(compnaiesData);
        selectizeConfigCompanies(`#${this.id}`, compnaiesData);
    });

    selectizeConfigCompanies("#company-identification_card", compnaiesData);
    $('.selectize-select').selectize({
        showAddOptionOnCreate: true,
        create: true,
    });
</script>
@endsection
