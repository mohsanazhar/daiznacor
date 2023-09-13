<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Registro de nuevo vehículo</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form
                        action="{{ route('createCar') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        autocomplete="off"
                        id="form-new-car"
                        class="needs-validation"
                        novalidate
                >
                    @csrf
                    <div class="g-3 row">
                        <h3>Vehiculo</h3>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="user-name" class="form-label">
                                    Nombre del propietario
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input required type="text" id="user-name" class="user-name form-control" name="name" placeholder="Nombre del propietario" autocomplete="off">
                                    @error('name')
                                    <div class="d-block invalid-feedback text-danger">El nombre del propietario es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-identification_card" class="form-label">
                                    RUC/ Cédula
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select type="text" id="company-identification_card" placeholder="RUC" autocomplete="off"></select>
                                    @error('identification_card')
                                    <div class="d-block invalid-feedback text-danger">Identification es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="car_plate" class="form-label">
                                    Placa
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input required type="text" id="car_plate" class="form-control" name="car_plate" placeholder="Placa" autocomplete="off">
                                    @error('car_plate')
                                    <div  class="d-block invalid-feedback text-danger">La placa es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="month_renewal" class="form-label">
                                    Mes de renovacion
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select required type="email" id="month_renewal" class="form-control" name="month_renewal">
                                        @php
                                        $months = \App\Helper\RequestHelper::months();
                                        @endphp
                                        @foreach($months as $k=>$v)
                                            <option value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                    @error('month_renewal')
                                    <div class="invalid-feedback text-danger">El mes es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="brand" class="form-label">
                                    Marca
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input id='brand' type="text" class="form-control" name="brand" placeholder="Marca" required autocomplete="off">
                                    @error('brand')
                                    <div class="invalid-feedback text-danger">La marca es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="model" class="form-label">
                                    Modelo
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="model" class="form-control" name="model" placeholder="Modelo" required autocomplete="off">
                                    @error('brand')
                                    <div class="d-block invalid-feedback text-danger">El modelo es obligatorio</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="year-car" class="form-label">Año del vehiculo</label>
                                <div>
                                    <input type="text" id="year-car" placeholder="Seleccionar año" name="year" class="year-car form-control"  autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="chassis" class="form-label">
                                    Chasis
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="chassis" class="form-control" name="chassis" placeholder="Chasis" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">

                            <div>
                                <label for="engine" class="form-label">
                                    Motor
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <input type="text" id="engine" class="form-control" name="engine" placeholder="Motor" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="color" class="form-label">Color</label>
                                <div>
                                    <input type="text" id="color" class="form-control" name="color" placeholder="Color" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="municipality" class="form-label">
                                    Municipio
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select name="municipality" class="selectize-select" id="municipality" ar ia-label="Selecciona el municipio" required>
                                        <option value=""></option>
                                        @if(count($provinces)>0)
                                            @foreach($provinces as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="type-vehicle" class="form-label">
                                    Tipo de vehículo
                                </label>
                                <div>
                                    <select name="type-vehicle" id="type-vehicle" class="selectize-select" aria-label="Tipo de vehiculo">
                                        <option value=""></option>
                                        @if(count($vehicleType)>0)
                                            @foreach($vehicleType as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <label for="fuel-type" class="form-label">Tipo de combustible</label>
                                <div>
                                    <select name="fuel-type" id="fuel-type" class="selectize-select" aria-label="Tipo de combustible">
                                        <option value=""></option>
                                        @if(count($fuelType)>0)
                                            @foreach($fuelType as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="no-polize" class="form-label">Numero de poliza</label>
                                <div>
                                    <select type="text" id="no-polize" class="selectize-selec" name="no-polize" placeholder="Numero de poliza">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="insurance_companies" class="form-label">Compañia Aseguradora</label>
                                <div>
                                    <input disabled type="text" id="insurance_companies" class="form-control" name="insurance_companies" placeholder="Compañia Aseguradora" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="weights" class="form-label">Numero de pesas y dimensiones</label>
                                <div>
                                    <input type="text" id="weights" class="form-control" name="weights" placeholder="Numero de pesas" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">

                            <div>
                                <label for="due_date" class="form-label">Fecha de vencimiento</label>
                                <div>
                                    <input type="text" id="due_date" placeholder="Select date" name="due_date" class="due_date form-control flatpickr flatpickr-input" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            {{--<div>
                                <label for="dimensions" class="form-label">Numero Dimensiones</label>
                                <div>
                                    <input type="text" id="dimensions" class="form-control" name="dimensions" placeholder="Numero de dimensiones" autocomplete="off">
                                </div>
                            </div>--}}
                            <div>
                                <label for="revised_no" class="form-label">Numero de revisado</label>
                                <div>
                                    <textarea type="text" id="revised_no" class="form-control" name="revised_no" placeholder="Numero de revisado" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mb-3">

                        </div>

                        <div class="col-lg-12 mb-3">
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" id="mortgagee" style="position: relative; top: -3px;margin-right: 6px;">
                                <label for="mortgagee" class="form-label">Acreedor hipotecario</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div>
                                <textarea type="text" id="mortgageeInfo" class="form-control"  name="mortgagee" style="display: none;"></textarea>
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