@extends('layouts.modal.policy.modal')
@section('title') @lang('translation.users') @endsection

@section('css')
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
                        @foreach($policies as $item)
                            <x-policy.edit-modal :item="$item"/>
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['number'] }}</td>
                                <td>{{ $item['insured_name'] }}</td>
                                <td>
                                    @if(isset($item['insurance_company']))
                                        {{ $item['insurance_company'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item['identification_card'] }}</td>
                                <td>
                                    <a href="/cars?company={{ $item['companyId'] }}">{{ $item['vehicleCount'] }}</a>
                                </td>
                                <td>
                                    @if(isset($item['policy_issuance']))
                                        {{ date('F j, Y, g:i a', strtotime($item['policy_issuance'])) }}
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
