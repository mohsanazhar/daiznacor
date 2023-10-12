@extends('layouts.master')
@section('title') Vehiculos @endsection

@section('css')
    <style>
        tbody td{font-size: 14px;}
    </style>
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
                        <a style="cursor: pointer;display:none">
                            <a data-key="t-newCompany" data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;display:none" class="btn btn-success">@lang('translation.new')</a>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">@lang('translation.action')</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('cars/create-car') }}" class="dropdown-item" href="#">@lang('translation.new')</a></li>
                                <li><a href="{{route('cars.export')}}" class="dropdown-item" href="#">@lang('translation.export')</a></li>
                                <li><a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="dropdown-item" href="#">@lang('translation.import') </a></li>
                                <li><a href="{{ asset('DemoCSVFiles/cars.csv') }}" class="dropdown-item" download> @lang('translation.demo_import') </a></li>
                            </ul>
                        </div>
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
                            <th>Mes</th>
                            <th>Municipio</th>
                            <th>No. Póliza</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            @php
                            $rand_arr = ['badge badge-outline-primary','badge badge-outline-secondary','badge badge-outline-success','badge badge-outline-info','badge badge-outline-dark'];
                            $year_arr = ["badge rounded-pill text-primary  bg-primary-subtle","badge rounded-pill text-secondary  bg-secondary-subtle",
                                        "badge rounded-pill text-success  bg-success-subtle",
                                        "badge rounded-pill text-info  bg-info-subtle",
                                        "badge rounded-pill text-dark  bg-dark-subtle"];
                            $colors_arr = ["badge text-primary bg-primary-subtle badge-border",
                                            "badge text-info bg-info-subtle badge-border",
                                            "badge text-warning bg-warning-subtle badge-border",
                                            "badge text-success bg-success-subtle badge-border",
                                            "badge text-secondary bg-secondary-subtle badge-border",
                                            "badge text-dark bg-dark-subtle badge-border"];
                            @endphp
                            <x-cars.edit-modal :item="$car" :$provinces :$vehicleType :$fuelType :$policies/>

                            <tr>
                                <td class="opacity-75">
                                    {{ $car['id'] }}
                                </td>
                                <td>
                                    <span class="{{$rand_arr[array_rand($rand_arr)]}}">{{ $car['name'] }}</span>
                                </td>
                                <td class="opacity-75">
                                    @if(isset($car['identification_card']))
                                       <a style="cursor: pointer" class="text-decoration-underline text-info" data-bs-toggle="modal" data-bs-target="#updateCarModal{{ $car['id'] }}">
                                           {{ $car['identification_card'] }}
                                       </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75">
                                    @if(isset($car['month_renewal']))
                                        <span class="badge text-dark-emphasis  bg-dark-subtle">{{ ($car['month_renewal'] > 0 && $car['month_renewal'] < 13 )? date("F", mktime(0, 0, 0, $car['month_renewal'], 10)):"" }}</span>
                                    @else
                                        <span class="badge text-light-emphasis bg-light-subtle">N/A</span>
                                    @endif
                                </td>
                                <td class="opacity-75">
                                @if(isset($car['municipaly']))
                                        {{ $car['municipaly'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75">
                                    @if(isset($car['policy']))
                                        {{ $car['policy']['number'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75">
                                    @if(isset($car['due_date']))
                                        {{ $car['due_date'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li onclick="get_car_details({{$car['id']}})" data-id="">
                                                <a  data-id="{{$car['id']}}" class="dropdown-item cursor-pointer">
                                                    <i class="bi-eye align-bottom me-2 text-muted"></i>
                                                    View Detail
                                                </a>
                                            </li>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('translation.policy-list') @lang('translation.import')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('car/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div>
                        <label for="formFileLg" class="form-label">@lang('translation.upload_csv_file')</label>
                        <input class="form-control form-control-lg" name="file" id="formFileLg" type="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('translation.import')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="viewCarDetailModel" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
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
    const compnaiesData = @json($companies);
    const policiesData = @json($policies);
    const form = document.getElementById("form-new-car");
    function get_car_details(id){
        $.ajax({
            url:'{{route('get_car_details')}}',
            type:'post',
            data:{'_token':'{{csrf_token()}}','id':id},
            dataType:'html',
            success:function (res) {
                $('#viewCarDetailModel').html(res);
                $('#viewCarDetailModel').modal('show');
            }
        });
    }
    $(document).ready(function(){

        $(document).on('change','.policy_id_select',function(){
            console.log($(this).find(':selected').data('name'));
            $(this).closest('div.row').find('#insurance_companies').val($(this).find(':selected').data('name'));
        });
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
        minViewMode: "years",
        autoclose:true
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
