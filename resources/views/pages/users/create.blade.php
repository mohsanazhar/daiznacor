@extends('layouts.master')
@section('title') Create User @endsection
@section('css')
<link href="{{ URL::asset('build/libs/multi.js/multi.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title')Crear Usuario @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Crear Usuario</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">First Name</label>
                            <div>
                                <input type="text" class="form-control" readonly placeholder="Firt name" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">First Name</label>
                            <div>
                                <input type="text" class="form-control" readonly placeholder="Last name" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div>
                            <label class="form-label">Email</label>
                            <div>
                                <input type="text" class="form-control" readonly placeholder="Email" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">City</label>
                            <div>
                                <input type="text" class="form-control" readonly placeholder="City" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">Phone Number</label>
                            <div>
                                <input type="text" class="form-control" readonly placeholder="Phone Number" />
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12">
                        <div>
                            <label class="form-label">Link</label>
                            <div>
                                <input type="text" class="form-control" readonly disabled />
                            </div>
                        </div>
                    </div> -->

                    <div class="col-lg-12">
                        <div class="d-flex justify-content-end" style="width: 100%">
                            <button type="button" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!--end row-->

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/multi.js/multi.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/form-advanced.init.js') }}"></script>
<!-- input flag init -->
<script src="{{URL::asset('build/js/pages/flag-input.init.js')}}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
