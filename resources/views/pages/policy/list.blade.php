@extends('layouts.modal.policy.modal')
@section('title') @lang('translation.users') @endsection

@section('css')
    <style>
        tbody td{font-size: 14px;}
    </style>
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title') Insurance Policies @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0">@lang('translation.policy-list')</h5>
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
                    <div class='p-1'>
                        <a style="cursor: pointer; display:none">
                            <a data-key="t-newPolicies" data-bs-toggle="modal" data-bs-target="#addPoliciesModal" style="cursor: pointer;display:none" class="btn btn-success">@lang('translation.new')</a>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">@lang('translation.action')</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('policies/create-policy') }}" class="dropdown-item" href="#">@lang('translation.new')</a></li>
                                <li><a href="{{route('policies.export')}}" class="dropdown-item" href="#">@lang('translation.export')</a></li>
                                <li><a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="dropdown-item" href="#">@lang('translation.import') </a></li>
                                <li><a href="{{ asset('DemoCSVFiles/policy.csv') }}" class="dropdown-item" download> @lang('translation.demo_import') </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="policy-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No. Póliza</th>
                            <th>Empresa</th>
                            <th>Emisión de Póliza</th>
                            <th>Vencimiento de Póliza</th>
                            <th>@lang('translation.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        @foreach($policies as $item)

                            <x-policy.edit-modal :item="$item"/>
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>
                                    <span class="{{$colors_arr[array_rand($colors_arr)]}}">{{ $item['number'] }}</span>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#updatePoliciesModal{{ $item['id'] }}" style="cursor:pointer;" class="text-decoration-underline">
                                        {{ $item['insured_name'] }}
                                    </a>
                                </td>
                                <td>
                                    @if(isset($item['policy_issuance']))
                                        <span class="{{$rand_arr[array_rand($rand_arr)]}}">
                                           {{ date('F j, Y', strtotime($item['policy_issuance'])) }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ date('F j, Y', strtotime($item['policy_expiration'])) }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li onclick="get_policy_details({{$item['id']}})" data-id="">
                                                <a  data-id="{{$item['id']}}" class="dropdown-item cursor-pointer">
                                                    <i class="bi-eye align-bottom me-2 text-muted"></i>
                                                    View Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" data-bs-target="#updatePoliciesModal{{ $item['id'] }}" class="dropdown-item edit-item-btn cursor-pointer">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    @lang('translation.edit')
                                                </a>
                                            </li>
                                            <li>
                                                <form id="delete-policy-item-{{ $item['id'] }}" action="{{ route('deletePolicy', $item['id']) }}" method="POST" class="dropdown-item remove-item-btn remove-item-company cursor-pointer">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    <input type="submit" hidden class="ri-delete-bin-fill align-bottom me-2 text-muted"/>
                                                    @lang('translation.delete')
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('translation.policy-list') @lang('translation.import')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('policies.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div>
                    <label for="formFileLg" class="form-label">@lang('translation.upload_csv_file')</label>
                    <input class="form-control form-control-lg" name="file" id="formFileLg" type="file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
                <button type="submit" class="btn btn-primary">@lang('translation.import')</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="viewCarDetailModel" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
</div>
@endsection
@section('script')

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    function get_policy_details(id){
        $.ajax({
            url:'{{route('get_policy_details')}}',
            type:'post',
            data:{'_token':'{{csrf_token()}}','id':id},
            dataType:'html',
            success:function (res) {
                $('#viewCarDetailModel').html(res);
                $('#viewCarDetailModel').modal('show');
            }
        });
    }
    $(document).ready(() => {
        $(document).on('change','.identification_card',function () {
        var id = $(this).find(':selected').data('id');
        var name = $(this).find(':selected').data('name');
        $('#name-insure-'+id).val(name);
    });
        $('#policy-list').DataTable({
            order: [[0, 'desc']],
            language: {
                emptyTable: "No hay datos disponibles en la tabla",
            }
        });

        $('#policy-list tbody').on('click', 'form[id^="delete-policy-item"]', function(event) {
            event.preventDefault();
            $(this).submit();
        });
    })
</script>

@endsection
