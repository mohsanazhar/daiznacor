@extends('layouts.master')
@section('title') @lang('translation.companies') @endsection

@section('css')
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Inicio @endslot
@slot('title') @lang('translation.companies') @endslot
@endcomponent
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex" style="align-items: center;">
                <h5 class="card-title mb-0">@lang('translation.companies-add')</h5>

                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                    @include('layouts.common.display_error')
                </div>
            </div>
            <div class="card-body">
                <form
                        action="{{ route("createCompany") }}"
                        method="POST"
                        enctype="multipart/form-data"
                        autocomplete="off"
                        id="form-new-company"
                        class="needs-validation"
                        novalidate
                >
                    @php
                        $province = \App\Services\ProvinceService::getInstance()->get();
                        $district = \App\Services\DistrictService::getInstance()->get();
                        $corregimento = \App\Services\CorregimientoService::getInstance()->get();
                    @endphp
                    @csrf
                    <div class="g-3 row">
                        <h3>@lang('translation.company')</h3>
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="position-relative d-inline-block">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <label for="company-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Company Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" id="company-image-input" name="image" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-xl">
                                    <div class="avatar-title bg-light rounded-3">
                                        <img src="/build/images/users/user-dummy-img.jpg" id="company-img-preview" class="avatar-lg rounded-3 h-auto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 row">
                            <div class="col-lg-4 mb-3">
                                <div>
                                    <label for="company-name" class="form-label">
                                        @lang('translation.name')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input required type="text" id="company-name" class="form-control" name="name" placeholder="@lang('translation.name')">
                                        @error('name')
                                        <div id="name-error" class="invalid-feedback">@lang('translation.name') es obligatorio</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div>
                                    <label for="company-identification_card" class="form-label">
                                        RUC/ Cédula
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input required type="text" id="company-identification_card" class="form-control" name="identification_card" placeholder="RUC">
                                        @error('identification_card')
                                        <div id="ruc-error" class="invalid-feedback">Identification es obligatorio</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div>
                                    <label for="dv" class="form-label">
                                        DV
                                    </label>
                                    <div>
                                        <input  type="text" id="dv" class="form-control" name="dv" placeholder="DV">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-phone" class="form-label">
                                        @lang('translation.phone')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input required type="tel" id="company-phone" class="form-control" name="phone" placeholder="@lang('translation.phone')">
                                        @error('phone')
                                        <div id="phone-number-error" class="invalid-feedback">@lang('translation.phone') es obligatorio</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-email" class="form-label">
                                        @lang('translation.email')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input required type="email" id="company-email" class="form-control" name="email" placeholder="@lang('translation.email')">
                                        @error('email')
                                        <div id="email-error" class="invalid-feedback">@lang('translation.email') es obligatorio</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>@lang('translation.street-address')</h3>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-province" class="form-label">@lang('translation.province')<span class="text-danger">*</span></label>
                                <div>
                                    <select name="province" id="company-province" class="form-control" aria-label="@lang('translation.province')" required>
                                        <option value=""></option>
                                        @if(count($province)>0)
                                            @foreach($province as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-district" class="form-label">@lang('translation.district')<span class="text-danger">*</span></label>
                                <div>
                                    <select name="district" id='company-district' class="form-control" aria-label="@lang('translation.district')" required>
                                        <option value=""></option>
                                        @if(count($district)>0)
                                            @foreach($district as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-corregimiento" class="form-label">@lang('translation.corregimiento')<span class="text-danger">*</span></label>
                                <div>
                                    <select name="corregimiento" id="company-corregimiento" class="form-control" aria-label="@lang('translation.corregimiento')" required>
                                        <option value=""></option>
                                        @if(count($corregimento)>0)
                                            @foreach($corregimento as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-street" class="form-label">@lang('translation.street')</label>
                                <div>
                                    <input type="text" id="company-street" class="form-control" name="street" placeholder="@lang('translation.street')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div>
                                <label for="company-no-local" class="form-label">@lang('translation.no-local')</label>
                                <div>
                                    <input id='company-no-local' type="text" class="form-control" name="house_number" placeholder="@lang('translation.no-local')">
                                </div>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.companies-add')</button>
                        </div>
                    </div>
                </form>
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
