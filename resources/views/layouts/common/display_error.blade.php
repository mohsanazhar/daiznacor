@if(session("status"))
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
        {{ session()->get('status')}}
    </div>
@endif
@if(session("error"))
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
        {{ session()->get('error')}}
    </div>
@endif
@if(session("validError"))
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
        {!! session()->get('validError')  !!}
    </div>
@endif