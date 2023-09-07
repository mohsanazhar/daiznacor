@if(session("status"))
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
        <i class="bi bi-check-circle-fill mx-1"></i>
        {{ session("status") }}
    </div>
    </div>
@endif
@if(session("error"))
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
        <i class="bi bi-x-circle-fill mx-1"></i>
        {{ session("error")}}
    </div>
    </div>
@endif
@if(session("validError"))
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
        <i class="bi bi-x-circle-fill mx-1"></i>
        {!! session("validError")  !!}
    </div>
@endif