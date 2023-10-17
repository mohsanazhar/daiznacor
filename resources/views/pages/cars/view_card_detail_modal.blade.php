<div class="modal-dialog modal-xl">
    <div class="modal-content border-0">
        <div class="modal-header p-4 pb-0">
            <h5 class="modal-title" id="createMemberLabel">View Car Info</h5>
            <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>#</th>
                            <td>{{$car['id']}}</td>
                            <th>RUC/ Cédula</th>
                            <td>{{$car['identification_card']}}</td>
                        </tr>
                        <tr>
                            <td>Placa</td>
                            <td>{{$car['car_plate']}}</td>
                            <th>Mes de renovacion</th>
                            <td>{{$car['month_renewal']}}</td>
                        </tr>
                        <tr>
                            <th>Placa</th>
                            <td>{{$car['car_plate']}}</td>
                            <th>Mes de renovacion</th>
                            <td>{{$car['month_renewal']}}</td>
                        </tr>
                        <tr>
                            <th>Marca</th>
                            <td>{{$car['brand']}}</td>
                            <th>Modelo</th>
                            <td>{{$car['model']}}</td>
                        </tr>
                        <tr>
                            <th>Año del vehiculo</th>
                            <td>{{$car['year']}}</td>
                            <th>Chasis</th>
                            <td>{{$car['chassis']}}</td>
                        </tr>
                        <tr>
                            <th>Motor</th>
                            <td>{{$car['engine']}}</td>
                            <th>Color</th>
                            <td>{{$car['month_renewal']}}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{$car['municipaly']['name']}}</td>
                            <th>Tipo de vehículo</th>
                            <td>{{$car['color']}}</td>
                        </tr>
                        <tr>
                            <th>Tipo de combustible</th>
                            <td>{{$car['type']['name']}}</td>
                            <th>Numero de poliza</th>
                            <td>{{$car['policy']['number']}}</td>
                        </tr>
                        <tr>
                            <th>Compañia Aseguradora</th>
                            <td>{{$car['company']['name']}}</td>
                            <th>Numero de pesas y dimensiones</th>
                            <td>{{$car['dimensions']}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de vencimiento</th>
                            <td>{{$car['due_date']}}</td>
                            <th>Numero de revisado</th>
                            <td>{{$car['revised_no']}}</td>
                        </tr>
                        <tr>
                            <th>Acreedor hipotecario</th>
                            <td colspan="3">{!! $car['mortgagee'] !!}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>