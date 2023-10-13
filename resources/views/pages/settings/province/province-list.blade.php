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
                                    <li><a id="addProvince" class="dropdown-item" href="javascript:;">@lang('translation.new') </a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                       <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                           <thead>
                           <tr>
                               <th>Name</th>
                               <th data-orderable="false">Acciones</th>
                           </tr>
                           </thead>
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
                           <tbody>
                           </tbody>
                       </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajax Add Modal -->
    <div class="modal fade" id="provinceAddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="provinceAddModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="provinceAddModelLabel"></h5>
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
                var province_id = 0;

                $(".btn_delet").on("click", function(){
                    province_id = $(this).attr("data-province");
                    $("#province_input_id").val(province_id);

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

                $("#addProvince").on("click", function(){
                    var url_var = "<?= url('settings/get-province-form/'); ?>";
                    $.ajax({
                        url: url_var ,
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $("#provinceAddModel").html(' ');
                            $("#provinceAddModel").html(data);
                            $("#provinceAddModel").modal('show');
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
                function provinceAdd(){
                    var url_var = "<?= url('settings/storeProvinceAjax/'); ?>";
                    $.ajaxSetup({
                    });
                    $.ajax({
                        url: url_var,
                        method: 'POST',
                        data: $('#provinceform').serialize(),
                        success: function(data){
                            $("#provinceAddModel").html(' ');
                            $("#provinceAddModel").html(data);
                            table.draw();
                        }
                    });
                }
                function editProvince(id){
                    var url_var = "<?= url('settings/get-province-form/'); ?>"+'/'+id;
                    $.ajax({
                        url: url_var ,
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $("#provinceAddModel").html(' ');
                            $("#provinceAddModel").html(data);
                            $("#provinceAddModel").modal('show');
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

                function deleteProvince(id){
                    var url_var = "<?= url('settings/deleteProvince/'); ?>"+'/'+id;
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

                function provinceUpdate(){
                    var url_var = "<?= url('settings/updateProvinceAjax/'); ?>";
                    $.ajaxSetup({
                    });
                    $.ajax({
                        url: url_var,
                        method: 'POST',
                        data: $('#provinceform').serialize(),
                        success: function(data){
                            $("#provinceAddModel").html(' ');
                            $("#provinceAddModel").html(data);
                            table.draw();
                        }
                    });
                }

                var table = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    searchable: true,
                    pageLength : 10,
                    order: [[ 0, "desc" ]],
                    ajax: "{{ route('list-province') }}",
                    columns: [
                        { data: 'name' },
                        { data: 'Acciones' },
                    ]
                });

            </script>
@endsection
