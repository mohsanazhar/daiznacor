<div class="modal-dialog modal-xl">
    <div class="modal-content border-0">
        <div class="modal-header p-4 pb-0">
            <h5 class="modal-title" id="createMemberLabel">View Policy Info</h5>
            <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>#</th>
                            <td>{{ $item['id'] }}</td>
                            <th>No. Póliza</th>
                            <td>{{ $item['number'] }}</td>
                        </tr>
                        <tr>
                            <th>Empresa</th>
                            <td>{{ $item['insured_name'] }}</td>
                            <th>Compañía Aseguradora</th>
                            <td>
                                @if(isset($item['insuranceCompany']))
                                    {{ $item['insuranceCompany']['name'] }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>RUC / Cédula</th>
                            <td>{{ $item['identification_card'] }}</td>
                            <th>Autos</th>
                            <td>{{ $item['vehicleCount'] }}</td>
                        </tr>
                        <tr>
                            <th>Emisión de Póliza</th>
                            <td>{{ date('F j, Y, g:i a', strtotime($item['policy_issuance'])) }}</td>
                            <th>Vencimiento de Póliza</th>
                            <td>
                                {{ date('F j, Y, g:i a', strtotime($item['policy_expiration'])) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>