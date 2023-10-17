<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">{{ $title  }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="districtform" class="needs-validation" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="company-name" class="form-label">@lang('translation.district')</label>
                    <input type="text" id="district-name" value="" class="form-control {{ ($errors->first('district'))?'is-invalid':'' }}" name="district" placeholder="@lang('translation.district')">
                    <p class="text-sm-start text-danger"></p>
                </div>
                <div>
                    <label for="company-name" class="form-label">@lang('translation.select') @lang('translation.district')</label>
                    <select {{ (count($provinces) > 0)?'':'disabled' }} id="district-select-edit" name="selectedProvince" class="form-select form-control {{ ($errors->first('selectedProvince'))?'is-invalid':'' }}" aria-label="Default select example">
                        <option value="">@lang('translation.select') @lang('translation.province')</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                @if(@$success !='')
                    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
                        {{ @$success }}
                    </div>
                @endif
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                <button type="button" onclick="districtStore()" id="addDistrictSubmit" class="btn btn-primary">@lang('translation.submit')</button>
            </div>
        </form>
    </div>
</div>