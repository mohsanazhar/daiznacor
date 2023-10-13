@extends('layouts.master')
@section('title') @lang('translation.province') @endsection

@section('css')
    <style>
        tbody td{font-size: 14px;}
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Inicio @endslot
        @slot('title') @lang('translation.district')  @endslot
    @endcomponent

    {{--@include('pages.cars.create_car_form') --}}
    {{-- @show --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0">@lang('translation.list_of_district')</h5>
                    <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                    @include('layouts.common.display_error')
                    <!-- Button trigger modal -->
                        <div class='p-1'>
                            <a style="cursor: pointer;display:none">
                                <a data-key="t-newCompany" data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;display:none" class="btn btn-success">@lang('translation.new')</a>
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success">@lang('translation.action')</button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a id="addDistrict" class="dropdown-item" href="javascript:;">@lang('translation.new') </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>@lang('translation.district')</th>
                            <th>@lang('translation.province')</th>
                            <th data-orderable="false">Acciones</th>
                        </tr>
                        @php
                            $rand_arr = ['badge badge-outline-primary','badge badge-outline-secondary','badge badge-outline-success','badge badge-outline-info','badge badge-outline-dark'];
                            $year_arr = ["badge rounded-pill text-primary  bg-primary-subtle","badge rounded-pill text-secondary  bg-secondary-subtle",
                                        "badge rounded-pill text-success  bg-success-subtle",
                                        "badge rounded-pill text-info  bg-info-subtle",
                                        "badge rounded-pill text-dark  bg-dark-subtle"];
                            $colors_arr = ["badge text-primary bg-primary-subtle badge-border",
                                            "badge text-info bg-info-subtle badge-border",
                                            "badge text-warning bg-warning-subtle badge-border",
                                            "badge text-success bg-success-subtle badge-border",
                                            "badge text-secondary bg-secondary-subtle badge-border",
                                            "badge text-dark bg-dark-subtle badge-border"];
                        @endphp
                        {{-- <x-cars.edit-modal :item="$province"/>--}}
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form
            action=""
            method=""
            autocomplete="off"
            id="form-delete-district"
            class="needs-validation"
            novalidate
    >
        @csrf
        <input type="hidden" name="district_input_id" id="district_input_id">
    </form>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteDistrict" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @lang('translation.are_you_sure_you_want_to_delete?')
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-btn-cancle" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                    <button type="button" id="modal-btn-delete" class="btn btn-danger">@lang('translation.delete')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('createDistrict') }}" class="needs-validation" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.district')</label>
                            <input required type="text" id="district-name" class="form-control" name="district" placeholder="@lang('translation.district')">
                        </div>
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.select') @lang('translation.province')</label>
                            <select {{ (count($provinces) > 0)?'':'disabled' }} name="selectedProvince" class="form-select form-control" aria-label="Default select example">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            @if(empty($provinces))
                                <small class='text-danger'>@lang('translation.please_add_provices')</small>
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                        <button {{ (count($provinces) > 0)?'':'disabled' }}  type="submit" class="btn btn-primary">@lang('translation.new') @lang('translation.district')</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editDistrictModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDistrictModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDistrictModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" method="POST" id="edit-district-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="modal-body">
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.district')</label>
                            <input required type="text" id="edit-district-name" class="form-control" name="district" placeholder="@lang('translation.district')">
                            <input  type="hidden" id="edit-district-id" class="form-control" name="districtId">
                        </div>
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.select') @lang('translation.province')</label>
                            <select {{ (count($provinces) > 0)?'':'disabled' }} name="district-select-edit" id="district-select-edit" name="selectedDistrict" class="form-select form-control" aria-label="Default select example">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            @if(empty($provinces))
                                <small class='text-danger'>@lang('translation.please_add_provices')</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('translation.edit') @lang('translation.province')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ajax Add Modal -->
    <div class="modal fade" id="districtAddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="districtAddModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="districtAddModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.province')</label>
                            <input required type="text" id="province-name" class="form-control" name="province" placeholder="@lang('translation.province')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('translation.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        var district_id = 0;
        $(".btn_delet").on("click", function(){
            district_id = $(this).attr("data-district");
            $("#district_input_id").val(district_id);

        });

        var modalConfirm = function(callback){

            $("#btn_delet").on("click", function(){
                $("#deleteDistrict").modal('show');
            });

            $("#modal-btn-delete").on("click", function(){
                callback(true);
                $("#form-delete-district").submit()
                $("#deleteDistrict").modal('hide');
            });

            $("#modal-btn-cancle").on("click", function(){
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm(function(confirm){
            if(confirm){

                //$("#result").html("CONFIRMADO");
            }else{
                //$("#result").html("NO CONFIRMADO");
            }
        });

        $("#addDistrict").on("click", function(){
            var url_var = "<?= url('settings/get-district-form/'); ?>";
            $.ajax({
                url: url_var ,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $("#districtAddModel").html(' ');
                    $("#districtAddModel").html(data);
                    $("#districtAddModel").modal('show');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        function editDistrict(id){
            var url_var = "<?= url('settings/get-district-form/'); ?>"+'/'+id;
            $.ajax({
                url: url_var ,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $("#districtAddModel").html(' ');
                    $("#districtAddModel").html(data);
                    $("#districtAddModel").modal('show');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function districtStore(){
            var url_var = "<?= url('settings/storeDistrictAjax/'); ?>";
            $.ajaxSetup({
            });
            $.ajax({
                url: url_var,
                method: 'POST',
                data: $('#districtform').serialize(),
                success: function(data){
                    $("#districtAddModel").html(' ');
                    $("#districtAddModel").html(data);
                    table.draw();
                }
            });
        }

        function districtUpdate(){
            var url_var = "<?= url('settings/updateDistrictAjax/'); ?>";
            $.ajaxSetup({
            });
            $.ajax({
                url: url_var,
                method: 'POST',
                data: $('#districtform').serialize(),
                success: function(data){
                    $("#districtAddModel").html(' ');
                    $("#districtAddModel").html(data);
                    table.draw();
                }
            });
        }
        function deleteDistrict(id){
            var url_var = "<?= url('settings/deleteDistrict/'); ?>"+'/'+id;
            $.ajax({
                url: url_var ,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    table.draw();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            searchable: true,
            pageLength : 10,
            order: [[ 0, "desc" ]],
            ajax: "{{ route('list-district') }}",
            columns: [
                { data: 'name' },
                { data: 'provinceName' },
                { data: 'Acciones' },
            ]
        });
    </script>
    <script>
    </script>
@endsection
