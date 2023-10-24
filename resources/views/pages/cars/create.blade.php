@extends('layouts.master')
@section('title') Vehiculos @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Inicio @endslot
        @slot('title') Vehiculos @endslot
    @endcomponent
    {{-- @show --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0">Registro de nuevo vehículo</h5>
                    <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                        @include('layouts.common.display_error')
                    </div>
                </div>
                <div class="card-body">
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
                        <input type="hidden" name="owner_id" class="owner_id" value="0"/>
                        <div class="g-3 row">
                            <h3>Vehiculo</h3>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="user-name" class="form-label">
                                        Nombre del propietario
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>

                                        <select required id="" class="user-name form-control" name="name" placeholder="Nombre del propietario" autocomplete="off">
                                            <option value="">Please select company</option>
                                            @if(count($companies)>0)
                                                @foreach($companies as $k=>$v)

                                                    <option value="{{$v['name']}}" data-ident="{{$v['identification_card']}}" data-user_id="{{(!is_null($v['user']))?$v['user']['id']:0}}">{{$v['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
                                        <input type="text" class="form-control" required id="company-identification_card" placeholder="RUC" name="identification_card"/>
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
                                            @php
                                                $months = \App\Helper\RequestHelper::months();
                                            @endphp
                                            @foreach($months as $k=>$v)
                                                <option value="{{$k}}">{{$v}}</option>
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
                                        <input type="text" id="year-car" placeholder="Seleccionar año" name="year" class="year-car form-control"  autocomplete="off">
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
                                        <select name="municipality" class="form-control" id="municipality" ar ia-label="Selecciona el municipio" required>
                                            <option value=""></option>
                                            @if(count($provinces)>0)
                                                @foreach($provinces as $k=>$v)
                                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                                                @endforeach
                                            @endif
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
                                        <select name="type-vehicle" id="type-vehicle" class="form-control" aria-label="Tipo de vehiculo">
                                            <option value=""></option>
                                            @if(count($vehicleType)>0)
                                                @foreach($vehicleType as $k=>$v)
                                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
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
                                        <select name="fuel-type" id="fuel-type" class="form-control" aria-label="Tipo de combustible">
                                            <option value=""></option>
                                            @if(count($fuelType)>0)
                                                @foreach($fuelType as $k=>$v)
                                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="no-polize" class="form-label">Numero de poliza</label>
                                    <div>
                                        <select type="text" id="no-polize" class="selectize-selec" name="no-polize" placeholder="Numero de poliza">
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

                            <div class="col-lg-4 mb-3">
                                <div>
                                    <label for="weights" class="form-label">Numero de pesas y dimensiones</label>
                                    <div>
                                        <input type="text" id="weights" class="form-control" name="weights" placeholder="Numero de pesas" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">

                                <div>
                                    <label for="due_date" class="form-label">Fecha de vencimiento</label>
                                    <div>
                                        <input type="text" id="due_date" placeholder="Select date" name="due_date" class="due_date form-control flatpickr flatpickr-input" autocomplete="off">
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
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                    </form>
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
        const compnaiesData = @json($companies);
        const policiesData = @json($policies);
        const form = document.getElementById("form-new-car");
        $(document).ready(function(){
            $(document).on('click','.user-name',function(){
                var v = $(this).find(':selected').data('ident');
                var user_id = $(this).find(':selected').data('user_id');
                $('.owner_id').val(user_id);
                $('#company-identification_card').val(v);
                $('#company-identification_card').attr('readonly');
            });
        });
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

            const inputIdentificationCard = document.getElementById("user-name");
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
            $('.company-identification_card').val(company.user.name);
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

        selectizeConfigCompanies("#user-name", compnaiesData);
        $('.selectize-select').selectize({
            showAddOptionOnCreate: true,
            create: true,
        });
    </script>
@endsection
