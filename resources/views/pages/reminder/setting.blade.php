@extends('layouts.master')
@section('title')
@lang('translation.settings')
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card overflow-hidden profile-setting-img">
          

            <div class="card-body">
            <x-profile.page.notification />
            </div>
        </div>
    </div>
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
