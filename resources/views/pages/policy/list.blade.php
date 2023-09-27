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
                        <a style="cursor: pointer;">
                            <a data-key="t-newPolicies" data-bs-toggle="modal" data-bs-target="#addPoliciesModal" style="cursor: pointer;" class="btn btn-success">@lang('translation.new')</a>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="policy-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No. Póliza</th>
                            <th>Compañía Aseguradora</th>
                            <th>Nombre de Aseguradora</th>
                            <th>RUC / Cédula</th>
                            <th>Autos</th>
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
                                    @if(isset($item['insurance_company']))
                                        <span class="{{$year_arr[array_rand($year_arr)]}}">
                                        {{ $item['insurance_company'] }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="{{$colors_arr[array_rand($colors_arr)]}}">
                                        {{ $item['identification_card'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/cars?company={{ $item['companyId'] }}">
                                        <span class="badge text-dark-emphasis  bg-dark-subtle">{{ $item['vehicleCount'] }}
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    @if(isset($item['policy_issuance']))
                                        <span class="{{$rand_arr[array_rand($rand_arr)]}}">
                                           {{ date('F j, Y, g:i a', strtotime($item['policy_issuance'])) }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ date('F j, Y, g:i a', strtotime($item['policy_expiration'])) }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
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

@endsection
@section('script')

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
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
