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
        @slot('title') @lang('translation.province')  @endslot
    @endcomponent

    {{--@include('pages.cars.create_car_form') --}}
    {{-- @show --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0">@lang('translation.list_of_provinces')</h5>
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
                                    <li><a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="dropdown-item" href="#">@lang('translation.new') </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="card-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($provinces as $province)
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

                            <tr>

                                <td>
                                    <span class="{{$rand_arr[array_rand($rand_arr)]}}">{{ $province['name'] }}</span>
                                </td>


                                <td>
                                    <a data-province="{{$province['id']}}"  data-bs-toggle="" data-bs-target="" style="cursor: pointer;" class="btn_edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a data-province="{{$province['id']}}"  data-bs-toggle="modal" data-bs-target="#deleteProvice" style="cursor: pointer;color:#ff6c6c" class="btn_delet">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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
            id="form-delete-province"
            class="needs-validation"
            novalidate
    >
    @csrf
        <input type="hidden" name="province_input_id" id="province_input_id">
    </form>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteProvice" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="{{ route('createProvince') }}" class="needs-validation" method="POST">
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


    <!-- Edit Modal -->
    <div class="modal fade" id="editProvinceModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProvinceModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProvinceModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" method="POST" id="edit-province-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="modal-body">
                        <div>
                            <label for="company-name" class="form-label">@lang('translation.province')</label>
                            <input required type="text" id="edit-province-name" class="form-control" name="province" placeholder="@lang('translation.province')">
                            <input  type="hidden" id="edit-province-id" class="form-control" name="provinceId">
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
        @php
            if(session()->has('status')){
                session()->remove('status');
            }
            if(session()->has('error')){
                session()->remove('error');
            }
            if(session()->has('validError')){
                session()->remove('validError');
            }
        @endphp
        @endsection
        @section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
            <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

            <script src="{{ URL::asset('build/js/app.js') }}"></script>
            <script>
                var province_id = 0;
                $(".btn_delet").on("click", function(){
                    province_id = $(this).attr("data-province");
                    $("#province_input_id").val(province_id);
                    $('#form-delete-province').attr('action', '{{ route("deleteProvince") }}' );
                });

                var modalConfirm = function(callback){

                    $("#btn_delet").on("click", function(){
                        $("#deleteProvice").modal('show');
                    });

                    $("#modal-btn-delete").on("click", function(){
                        callback(true);
                       $("#form-delete-province").submit()
                        $("#deleteProvice").modal('hide');
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

                $(".btn_edit").on("click", function(){

                    var province_id = 0;

                    province_id = $(this).attr("data-province");
                    if (province_id === undefined) {
                        province_id = 0;
                    }
                    var url_var = "<?= url('settings/get-province/'); ?>"+'/'+province_id;
                    $("#province_input_id").val(province_id);
                    $('#form-delete-province').attr('action', '{{ route("deleteProvince") }}' );

                    $.ajax({
                        url: url_var ,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $("#editProvinceModel").modal('show');
                            $('#edit-province-id').val(data.id);
                            $('#edit-province-name').val(data.name);
                            var url_var = "<?= url('settings/editProvince/'); ?>"+'/'+data.id;
                            $('#edit-province-form').attr('action', url_var );
                        }
                    });
                });

            </script>
            <script>

                $(document).ready(() => {
                    $("#card-list").DataTable({
                    buttons: [
                        "reload", "excel"
                    ],
                    order: [[0, 'desc']],
                    language: {
                        emptyTable: "No hay datos disponibles en la tabla",
                    }
                });

                $('#card-list tbody').on('click', 'form[id^="delete-car-item"]', function(event) {
                    event.preventDefault();
                    $(this).submit();
                });
                });
            </script>
@endsection
