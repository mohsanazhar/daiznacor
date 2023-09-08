<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">@lang('translation.companies-add')</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
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
                            <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.companies-add')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
