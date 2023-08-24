@props([
    'company',
])

<div class="modal fade" id="updateCompanyModal{{ $company['id'] }}" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="updateMemberLabel">@lang('translation.companies-update')</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form
                    action="{{ route('editCompany', $company['id']) }}"
                    method="POST"
                >
                    @csrf
                    @method("PATCH")
                    <div class="g-3 row">
                        <h3>@lang('translation.company')</h3>
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="position-relative d-inline-block">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <label for="company-image-update-input-{{ $company['id'] }}" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Company Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" name="image" id="company-image-update-input-{{ $company['id'] }}" type="file" accept="image/png, image/gif, image/jpeg">
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
                        <div class="col-lg-8 row">
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-update-name-{{ $company['id'] }}" class="form-label">@lang('translation.name')</label>
                                    <div>
                                        <input required value="{{ old('name', $company['name']) }}" type="text" id="company-update-name-{{ $company['id'] }}" class="form-control" name="name" placeholder="@lang('translation.name')">
                                        @error('name')
                                            <div id="name-error" class="invalid-feedback">@lang('translation.name') is required</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-identification_card-{{ $company['id'] }}" class="form-label">RUC/ Cédula</label>
                                    <div>
                                        <input required value="{{ old('identification_card', $company['identification_card']) }}" type="text" id="company-identification_card-{{ $company['id'] }}" class="form-control" name="identification_card" placeholder="RUC">
                                        @error('identification_card')
                                            <div id="ruc-error" class="invalid-feedback">Identification es obligatorio</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-update-phone-{{ $company['id'] }}" class="form-label">@lang('translation.phone')</label>
                                    <div>
                                        <input required type="tel" value="{{ $company['phone_numbers'][0]['phone_number'] }}" id="company-update-phone-{{ $company['id'] }}" class="form-control" name="phone" placeholder="@lang('translation.phone')">
                                        @error('phone')
                                            <div id="phone-update-number-error" class="invalid-feedback">@lang('translation.phone') is required</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div>
                                    <label for="company-update-email-{{ $company['id'] }}" class="form-label">@lang('translation.email')</label>
                                    <div>
                                        <input required value="{{ old('email', $company['emails'][0]['email']) }}" type="email" id="company-update-email-{{ $company['id'] }}" class="form-control" name="email" placeholder="@lang('translation.email')">
                                        @error('email')
                                            <div id="email-update-error" class="invalid-feedback">@lang('translation.email') is required</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>@lang('translation.street-address')</h3>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-update-province-{{ $company['id'] }}" class="form-label">@lang('translation.province')</label>
                                <div>
                                    <select name="province" id="company-update-province-{{ $company['id'] }}" aria-label="Selecciona la provincia">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-update-district-{{ $company['id'] }}" class="form-label">@lang('translation.district')</label>
                                <div>
                                    <select name="district" id="company-update-district-{{ $company['id'] }}" aria-label="@lang('translation.district')">
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-update-corregimiento-{{ $company['id'] }}" class="form-label">@lang('translation.corregimiento')</label>
                                <div>
                                    <select name="corregimiento" id="company-update-corregimiento-{{ $company['id'] }}" aria-label="@lang('translation.corregimiento')" >
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-update-street-{{ $company['id'] }}" class="form-label">@lang('translation.street')</label>
                                <div>
                                    <input type="text" id="company-update-street-{{ $company['id'] }}" value="{{ old('street', $company['street']) }}" class="form-control" name="street" placeholder="@lang('translation.street')">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div>
                                <label for="company-update-house_number-{{ $company['id'] }}" class="form-label">@lang('translation.no-local')</label>
                                <div>
                                    <input id="company-update-house_number-{{ $company['id'] }}" value="{{ old('house_number', $company['house_number']) }}" type="text" class="form-control" name="house_number" placeholder="@lang('translation.no-local')">
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

    <script>
        document.addEventListener('DOMContentLoaded',() => {
            searchInput("#company-update-province-{{ $company['id'] }}", "/api/provinces", {
                defaultValue: "{{ old('name', $company['province']['name']) }}"
            })

            searchInput("#company-update-district-{{ $company['id'] }}", "/api/districts", {
                defaultValue: "{{ old('name', $company['district']) }}"
            })

            searchInput("#company-update-corregimiento-{{ $company['id'] }}", "/api/corregimientos", {
                defaultValue: "{{ old('name', $company['corregimiento']) }}"
            })
        });
    </script>
</div>