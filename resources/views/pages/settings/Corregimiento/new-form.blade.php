<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">{{ $title  }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="corregimientoform" class="needs-validation" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="company-name" class="form-label">@lang('translation.corregimiento')</label>
                    <input type="text" id="corregimiento-name" value="" class="form-control {{ ($errors->first('corregimiento'))?'is-invalid':'' }}" name="corregimiento" placeholder="@lang('translation.corregimiento')">
                    <p class="text-sm-start text-danger"></p>
                </div>
                <div>
                    <label for="company-name" class="form-label">@lang('translation.select') @lang('translation.district')</label>
                    <select id="district-select-edit" name="selectedCorregimiento" class="form-select form-control {{ ($errors->first('selectedCorregimiento'))?'is-invalid':'' }}" aria-label="Default select example">
                        <option value="">@lang('translation.select') @lang('translation.district')</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
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
                <button type="button" onclick="corregimientoStore()" id="addDistrictSubmit" class="btn btn-primary">@lang('translation.submit')</button>
            </div>
        </form>
    </div>
</div>