@extends('layouts.master')
@section('title') Editar @endsection

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
            </div>
            <div class="card-body">
                <form
                    action="{{ route('editCompany', $company['id']) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    autocomplete="off"
                    id="form-new-company"
                    class="needs-validation" 
                    novalidate
                >
                @csrf
                @method("PATCH")
                <div class="g-3 row">
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
                                        @if(isset($company['avatar']))
                                            <img src="{{ $company['avatar'] }}" id="company-update-image-preview" class="avatar-lg rounded-3 h-auto" />
                                        @else
                                            <img src="/build/images/users/user-dummy-img.jpg" id="company-update-image-preview" class="avatar-lg rounded-3 h-auto" />
                                        @endif
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
                                        <input required value="{{ old('name', $company['name']) }}" type="text" id="company-update-name" class="form-control" name="name" placeholder="@lang('translation.name')">
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
                                    <input required value="{{ old('identification_card', $company['identification_card']) }}" type="text"  id="company-identification_card" class="form-control" name="identification_card" placeholder="RUC">
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
                                        <input  value="{{ old('dv', $company['dv']) }}" type="text"  id="dv" class="form-control" name="dv" placeholder="DV">
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
                                        <input required type="tel" value="{{ $company['phoneNumbers'][0]['phone_number'] }}" id="company-phone" class="form-control" name="phone" placeholder="@lang('translation.phone')">
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
                                        <input required type="email"  value="{{ old('email', $company['emails'][0]['email']) }}" id="company-email" class="form-control" name="email" placeholder="@lang('translation.email')">
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
                                <label for="company-province" class="form-label">@lang('translation.province')</label>
                                <div>
                                    <select name="province" id="company-province" aria-label="@lang('translation.province')">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-district" class="form-label">@lang('translation.district')</label>
                                <div>
                                    <select name="district" id='company-district' aria-label="@lang('translation.district')">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-corregimiento" class="form-label">@lang('translation.corregimiento')</label>
                                <div>
                                    <select name="corregimiento" id="company-corregimiento" aria-label="@lang('translation.corregimiento')">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-street" class="form-label">@lang('translation.street')</label>
                                <div>
                                    <input type="text" id="company-street" value="{{ old('street', $company['street']) }}" class="form-control" name="street" placeholder="@lang('translation.street')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div>
                                <label for="company-no-local" class="form-label">@lang('translation.no-local')</label>
                                <div>
                                    <input id='company-no-local' type="text" class="form-control" value="{{ old('house_number', $company['house_number']) }}" name="house_number" placeholder="@lang('translation.no-local')">
                                </div>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.update')</button>
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
    document.addEventListener('DOMContentLoaded',() => {
        searchInput("#company-province", "/api/provinces", {
            defaultValue: "{{ old('name', $company['province']['name']) }}"
        })

        searchInput("#company-district", "/api/districts", {
            defaultValue: "{{ old('name', $company['district']) }}"
        })

        searchInput("#company-corregimiento", "/api/corregimientos", {
            defaultValue: "{{ old('name', $company['corregimiento']) }}"
        })
    });
</script>


@endsection
