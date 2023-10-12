<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">{{ $title  }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="provinceform" class="needs-validation" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="company-name" class="form-label">@lang('translation.province')</label>
                    <input type="text" id="province-name" value="" class="form-control {{ ($errors->first('province'))?'is-invalid':'' }}" name="province" placeholder="@lang('translation.province')">
                    <p class="text-sm-start text-danger"></p>
                </div>
            </div>
            <div class="modal-footer">
                @if(@$success !='')
                <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
                    {{ @$success }}
                </div>
                @endif
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                <button type="button" onclick="provinceAdd()" id="addProviceSubmit" class="btn btn-primary">@lang('translation.submit')</button>
            </div>
        </form>
    </div>
</div>