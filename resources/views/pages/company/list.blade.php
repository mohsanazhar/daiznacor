`@extends('layouts.master')
@section('title') @lang('translation.companies') @endsection

@section('css')
    <style>
        tbody td{font-size: 14px;}
    </style>
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Inicio @endslot
@slot('title') @lang('translation.companies') @endslot
@endcomponent
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
@include('pages.company.create_company_form')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex" style="align-items: center;">
                <h5 class="card-title mb-0">@lang('translation.companies-list')</h5>

                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                    @include('layouts.common.display_error')
                    <a style="cursor: pointer;">
                        <a data-key="t-newCompany" data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;" class="btn btn-success">@lang('translation.new')</a>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="company-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('translation.name')</th>
                            <th>RUC</th>
                            <th>@lang('translation.phone')</th>
                            <th>@lang('translation.email')</th>
                            <th>Autos</th>
                            <th>@lang('translation.province')</th>
                            <th>@lang('translation.district')</th>
                            <th>@lang('translation.corregimiento')</th>
                            <th>@lang('translation.no-local')</th>
                            <th>@lang('translation.street')</th>
                            <th>@lang('translation.time')</th>
                            <th>@lang('translation.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
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
                            <x-company.edit-modal :company="$company"/>
                            <tr>
                                <td class="opacity-75">
                                    {{ $company['id'] }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-start" name='image-preview'>
                                        <div class="bg-light badge-outline-success rounded-circle mx-1">
                                            @if(isset($company['avatar']))
                                                <img name='avatar' src="{{ $company['avatar'] }}" class="avatar-xs rounded-circle" />
                                            @else
                                                <img name='avatar' src="/build/images/users/user-dummy-img.jpg" class="avatar-xs rounded-circle" />
                                            @endif
                                        </div>
                                        <span name='name'class="align-items-center d-flex opacity-75">
                                            @if(isset($company['name']))
                                                <a href="{{ route('editViewCompany', $company['id']) }}" style="cursor: pointer" class="text-sm">
                                                {{ $company['name'] }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="opacity-75" name='ruc'>
                                    @if(isset($company['identification_card']))
                                        <span class="{{$colors_arr[array_rand($colors_arr)]}}">{{ $company['identification_card'] }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='phone_number'>
                                    @if(isset($company['phone_numbers']))
                                        {{ $company['phone_numbers'][0]['phone_number'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75 text-decoration-underline text-warning" name='email'>
                                    @if(count($company['emails'])>0)
                                    {{ $company['emails'][0]['email'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75">
                                    <a href="/cars?company={{ $company['id'] }}">
                                        <span class="badge text-dark-emphasis  bg-dark-subtle">{{ $company['vehicleCount'] }}</span>
                                    </a>
                                </td>
                                <td class="opacity-75" name='province'>
                                    @if(isset($company['province']))
                                        <span class="{{$colors_arr[array_rand($colors_arr)]}}"> {{ $company['province']['name'] }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='district'>
                                    @if(isset($company['district']))
                                        {{ $company['distric']['name'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='corregimiento'>
                                    @if(isset($company['corregimiento']))
                                        {{ $company['corregimiento']['name'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='house_number'>
                                    @if(isset($company['house_number']))
                                        {{ $company['house_number'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='street'>
                                    @if(isset($company['street']))
                                        {{ $company['street'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="opacity-75" name='created_at'>
                                    @if(isset($company['created_at']))
                                        <span class="{{$year_arr[array_rand($year_arr)]}}">{{ date('F j, Y, g:i a', strtotime($company['created_at'])) }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end action-company">
                                            <li>
                                                <a  href="{{ route('editViewCompany', $company['id']) }}" class="dropdown-item edit-item-btn">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    @lang('translation.edit')
                                                </a>
                                            </li>
                                            <li>
                                                <form id="delete-company-item-{{ $company['id'] }}" action="{{ route('deleteCompany', $company['id']) }}" method="POST" class="dropdown-item remove-item-btn remove-item-company cursor-pointer">
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

@endsection
@section('script')

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        var form = document.getElementById('form-new-company');
        form.addEventListener('submit', function (event) {

            // add was-validated to display custom colors
            form.classList.add('was-validated')
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

        }, false);

    });
</script>
<script>
    $(document).ready(() => {
        $("#company-list").DataTable({
            buttons: [
                "reload", "excel"
            ],
            order: [[0, 'desc']],
            language: {
                emptyTable: "No hay datos disponibles en la tabla",
            }
        });

        $('#company-list tbody').on('click', 'form[id^="delete-company-item"]', function(event) {
            event.preventDefault();
            $(this).submit();
        });
    })
</script>

<script>    

    const getAreCode = () => {
        return fetch("https://ipapi.co/json")
            .then((res) => res.json())
            .catch((error) => console.error("https://ipapi.co/json", { error }));
    }

    const phoneElement = document.getElementById("company-phone");
    const closeButtonCompany = document.getElementById("close-modal-company");

    const instance = window.intlTelInput(phoneElement, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
       /* autoPlaceholder: "aggressive",*/
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: (success) => {
            getAreCode().then(data => {
                success(data.country_code);
            });
        },
    });
    
    const handleChange = () => {
        if(!phoneElement.value.trim()) return;

        if(instance.isValidNumber()) {
            phoneElement.classList.remove("is-invalid");
            phoneElement.classList.add("is-valid");
        } else {
            phoneElement.classList.add("is-invalid");
            phoneElement.classList.remove("is-valid");
        }
    }

    phoneElement.addEventListener("blur", handleChange);
    phoneElement.addEventListener("change", handleChange);
    phoneElement.addEventListener("keyup", handleChange);

    closeButtonCompany.addEventListener('click', () => {
        $("#addCompanyModal").modal("toggle");
        document.getElementById("form-new-company").reset();
    });

    const imageFileCompany = document.getElementById("company-image-input");
    const previewImageCompany = document.getElementById("company-img-preview");
    imageFileCompany.addEventListener("change", ({ target }) => {
        const file = target.files[0];
        if(!file) return;

        previewImageCompany.setAttribute("src", URL.createObjectURL(file));
    });

</script>

<script>
    const phoneUpdateElement = document.getElementById("company-update-phone");
    const closeUpdateButtonCompany = document.getElementById("close-modal-company");

    if(!window.intlTelInput) {

        const instanceUpdatePhone = window.intlTelInput(phoneUpdateElement, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                /*autoPlaceholder: "aggressive",*/
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: (success) => {
                    getAreCode().then(data => {
                        success(data.country_code);
                    });
                },
            });
        
        const handleUpdateChange = () => {
            if(!phoneUpdateElement.value.trim()) return;
    
            if(instanceUpdatePhone.isValidNumber()) {
                phoneUpdateElement.classList.remove("is-invalid");
                phoneUpdateElement.classList.add("is-valid");
            } else {
                phoneUpdateElement.classList.add("is-invalid");
                phoneUpdateElement.classList.remove("is-valid");
            }
        }
    
        phoneUpdateElement.addEventListener("blur", handleUpdateChange);
        phoneUpdateElement.addEventListener("change", handleUpdateChange);
        phoneUpdateElement.addEventListener("keyup", handleUpdateChange);
    
        closeUpdateButtonCompany.addEventListener('click', () => {
            $("#addCompanyModal").modal("toggle");
            document.getElementById("form-new-company").reset();
        });
    
        const imageUpdateFileCompany = document.getElementById("company-image-update-input");
        const previewUpdateImageCompany = document.getElementById("company-update-image-preview");
        imageUpdateFileCompany.addEventListener("change", ({ target }) => {
            const file = target.files[0];
            if(!file) return;
    
            previewUpdateImageCompany.setAttribute("src", URL.createObjectURL(file));
        });
    }

</script>




@endsection
