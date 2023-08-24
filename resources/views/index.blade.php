@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')




<div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Ultimos vehiculos insertados</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                <table id="card-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del propietario</th>
                            <th>Identificatión</th>
                            <th>Placa</th>
                            <th>Mes</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Motor</th>
                            <th>Chasis</th>
                            <th>Color</th>
                            <th>Municipio</th>
                            <th>Tipo de vehículo</th>
                            <th>Tipo de Combustible</th>
                            <th>Acreedor Hipotecario</th>
                            <th>No. Póliza</th>
                            <th>Compañia de Aseguradora</th>
                            <th>No. de Revisado</th>
                            <th>No. Pesas / Dimensiones</th>
                            <th>Fecha de Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <th class="opacity-75">
                                    {{ $car['id'] }}
                                </th>
                                <th>
                                    {{ $car['name'] }}
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['identification_card']))
                                        {{ $car['identification_card'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['car_plate']))
                                        {{ $car['car_plate'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['month_renewal']))
                                    {{ $car['month_renewal'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['brand']))
                                        {{ $car['brand'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['model']))
                                        {{ $car['model'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['year']))
                                        {{ $car['year'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['engine']))
                                        {{ $car['engine'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['chassis']))
                                        {{ $car['chassis'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['color']))
                                        {{ $car['color'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['municipaly']))
                                        {{ $car['municipaly'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['vehicleType']))
                                        {{ $car['vehicleType'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['fuelType']))
                                        {{ $car['fuelType'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['mortgagee']))
                                        {{ $car['mortgagee'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['Póliza']))
                                        {{ $car['Póliza'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['revised_no']))
                                        {{ $car['revised_no'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['weights']))
                                        {{ $car['weights'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['dimensions']))
                                        {{ $car['dimensions'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
                                <th class="opacity-75">
                                    @if(isset($car['due_date']))
                                        {{ $car['due_date'] }}
                                    @else
                                        N/A
                                    @endif
                                </th>
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
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(() => {
        $("#card-list").DataTable({
            lengthMenu: false,
            searching: false,
            paging: false,
            buttons: [
                "reload", "excel"
            ],
            order: [[0, 'desc']],
            language: {
                emptyTable: "No hay datos disponibles en la tabla",
                info: ""
            }

            
        });
    })
</script>
@endsection
