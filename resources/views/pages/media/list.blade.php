@extends('layouts.master')
@section('title')@lang('translation.media') @endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Inicio @endslot
        @slot('title') Vehiculos @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0">Lista de @lang('translation.media')</h5>
                    <div style="flex: 1 1 auto" class="d-flex justify-content-end">
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
                            {{ session("error") }}
                        </div>
                </div>
                @endif

            </div>
        </div>
        <div class="card-body">
            <table id="card-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('translation.file_name')</th>
                    <th>@lang('translation.type')</th>
                    <th>@lang('translation.linked_with')</th>
                    <th>@lang('translation.actions')</th>
                </tr>
                </thead>
                <tbody>
                @if(count($media)>0)
                    @foreach($media as $k=>$v)
                        @php
                        $vehicle_id = $vehicle_paper = 0;
                        $media = $v['media'];
                        $expl = explode(".",$media);
                        $ext = end($expl);
                        $linked = \App\Helper\RequestHelper::getLinkedVehicle($v['name']);
                        
                     
                        @endphp
                        <tr>
                            <td>{{$v['id']}}</td>
                            <td>{{$v['name']}}</td>
                            <td>{{ucwords($ext)}}</td>
                            <td>{!! (!is_null($linked))?$linked:'' !!}</td>
                            <td>
                                <a data-media="{{$v['id']}}" data-vehcile="{{$vehicle_id}}" data-vpaper ="{{$vehicle_paper}}"  data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;" class="btn_edit_file">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                   @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <h5 class="modal-title" id="createMemberLabel">@lang('translation.rename_file')</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{route('updateMedia')}}" method="POST" enctype="multipart/form-data" autocomplete="off" id="form-new-car" class="needs-validation" novalidate="">
                        @csrf
                        <div class="g-3 row">
                            <h3>Vehiculo</h3>
                            <input type="hidden" name="media_id" class="media_id"/>
                            <input type="hidden" name="vehiclePaper" class="vehiclePaper"/>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="rename_file">@lang('translation.rename_file')</label>
                                    <input type="text" class="form-control" name="rename"/>
                                </div>
                            </div>
                            <div class="hstack gap-2 justify-content-end">
                                <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
        $(document).ready(function () {
            $(document).on('click','.btn_edit_file',function () {
                var media = $(this).data('media');
                var vehicle = $(this).data('vehcile');
                var vehicle_paper = $(this).data('vpaper');
                $('.media_id').val(media);
                $('.vehiclePaper').val(vehicle_paper);
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

    <script>
        $("#year-car").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        flatpickr(document.getElementById("due_date"), {
            dateFormat: "Y-m-d",
            minDate: `${new Date().getFullYear()}`,
            enableTime: false
        });
    </script>

@endsection
