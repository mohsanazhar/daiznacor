@extends('layouts.master')
@section('title') Editar @endsection

@section('css')
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Inicio @endslot
@slot('title') @lang('translation.companies') @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex" style="align-items: center;">
            </div>
            <input type="hidden" class="preview_container" value=""/>
            <input type="hidden" class="image_for" value=""/>
            <div class="card-body item-wrapper one">
                <form
                    action="{{ route('createGloveBox', $vehicleId) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <input hidden name="owner_id" value="{{ $owner['id'] }}">
                    <div class="row">
                        <div class="row">
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="record-input" data-preview="update-record-preview">
                                        @if(isset($vehiclePaper['record']))
                                            <img src="{{ $vehiclePaper['record'] }}" alt="" id="update-record-preview" class="uploaded-image" />
                                        @else
                                            <img src="" alt="" id="update-record-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Registro</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="record"
                                        id="record-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      ></input>
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="reviewed-input" data-preview="update-reviewed-preview">
                                        @if(isset($vehiclePaper['reviewed']))
                                            <img src="{{ $vehiclePaper['reviewed'] }}" alt="" id="update-reviewed-preview" class="uploaded-image" />
                                        @else
                                            <img src="" alt="" id="update-reviewed-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Revisado</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="reviewed"
                                        id="reviewed-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="weight-dimension-input" data-preview="update-weight-dimension-preview">
                                        @if(isset($vehiclePaper['weight-dimension']))
                                            <img src="{{ $vehiclePaper['weight-dimension'] }}" alt="" id="update-weight-dimension-preview" class="uploaded-image" />
                                        @else
                                            <img src="" alt="" id="update-weight-dimension-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Tarjeta de pesas y dimensiones</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="weight-dimension"
                                        id="weight-dimension-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="policy-input" data-preview="update-policy-preview">
                                        @if(isset($vehiclePaper['policy']))
                                            <img src="{{ $vehiclePaper['policy'] }}" alt="" id="update-policy-preview" class="uploaded-image" />
                                        @else
                                            <img src="" alt="" id="update-policy-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Póliza</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="policy"
                                        id="policy-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="payment-receipt-input" data-preview="update-payment-receipt-preview">
                                        @if(isset($vehiclePaper['payment-receipt']))
                                            <img src="{{ $vehiclePaper['payment-receipt'] }}" alt="" id="update-payment-receipt-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-payment-receipt-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Tarjeta de pago de placa</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="payment-receipt"
                                        id="payment-receipt-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="scanned-sticker-input" data-preview="update-scanned-sticker-preview">
                                        @if(isset($vehiclePaper['scanned-sticker']))
                                            <img src="{{ $vehiclePaper['scanned-sticker'] }}" alt="" id="update-scanned-sticker-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-scanned-sticker-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Sticker Escaneado</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="scanned-sticker"
                                        id="scanned-sticker-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                        <div class="mt-5 row">
                            <h2 class='mb-3'>Vehículo</h2>
                            
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="photos-01-input" data-preview="update-photos-01-preview">
                                        @if(isset($vehiclePaper['photos-01']))
                                            <img src="{{ $vehiclePaper['photos-01'] }}" alt="" id="update-photos-01-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-photos-01-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Vehículo foto 01</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="photos-01"
                                        id="photos-01-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" for="photos-02-input" data-preview="update-photos-02-preview">
                                        @if(isset($vehiclePaper['photos-02']))
                                            <img src="{{ $vehiclePaper['photos-02'] }}" alt="" id="update-photos-02-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-photos-02-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Vehículo foto 02</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="photos-02"
                                        id="photos-02-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" class="rc" data-preview="update-photos-03-preview" for="photos-03-input">
                                        @if(isset($vehiclePaper['photos-03']))
                                            <img src="{{ $vehiclePaper['photos-03'] }}" alt="" id="update-photos-03-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-photos-03-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Vehículo foto 03</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="photos-03"
                                        id="photos-03-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-6">
                                <div class="item-content">
                                  <div class="image-upload">
                                    <label style="cursor: pointer" for="photos-04-input" class="rc" data-preview="update-photos-04-preview">
                                        @if(isset($vehiclePaper['photos-04']))
                                            <img src="{{ $vehiclePaper['photos-04'] }}" alt="" id="update-photos-04-preview" class="uploaded-image" />
                                        @else 
                                            <img src="" alt="" id="update-photos-04-preview" class="uploaded-image" />
                                        @endif
                        
                                      <div class="h-100">
                                        <div class="dplay-tbl">
                                          <div class="dplay-tbl-cell">
                                            <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Vehículo foto 04</b></h5>
                                            <h6 class="mt-10 mb-70">Arrastrar la imagen aquí</h6>
                                          </div>
                                        </div>
                                      </div>
                                      <input
                                        data-required="image"
                                        type="hidden"
                                        name="photos-04"
                                        id="photos-04-input"
                                        class="image-input"
                                        data-traget-resolution="image_resolution"
                                      />
                                    </label>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Subir archivos</label>
                            <input class="form-control" type="file" name="others" multiple>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button id="close-modal-company" type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addNewMember">Añadir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="//static.filestackapi.com/filestack-js/3.x.x/filestack.min.js"></script>
    <script>
        const client = filestack.init("Az5FUiwB1REOjApxhufLxz");

        const options = {
            onUploadDone: updateForm,
            maxSize: 10 * 1024 * 1024,
            /*accept: 'image/!*,application/pdf',*/
            uploadInBackground: false,
        };
        $(document).on('click','.rc',function(e){
            e.preventDefault();
            $('.image_for').val($(this).attr('for'));
            var preview = $(this).data('preview');
            $('.preview_container').val(preview);
            const picker = client.picker(options);
            picker.open();
        });
        function updateForm (result) {
            const fileData = result.filesUploaded[0];
            var url= fileData.url;
            $('#'+$('.preview_container').val()).attr('src',fileData.url);
            var image_for = $('.image_for').val();
            $('#'+image_for).val(url);
            console.log(url);
            // Some ugly DOM code to show some data.
            /*const name = document.createTextNode('Selected: ' + fileData.filename);
            const url = document.createElement('a');
            url.href = fileData.url;
            url.appendChild(document.createTextNode(fileData.url));
            nameBox.appendChild(name);
            urlBox.appendChild(document.createTextNode('Uploaded to: '));
            urlBox.appendChild(url);*/
        };
    </script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>

    insertImage("record-input", "update-record-preview");
    insertImage("reviewed-input", "update-reviewed-preview");
    insertImage("policy-input", "update-policy-preview");
    insertImage("payment-receipt-input", "update-payment-receipt-preview");
    insertImage("scanned-sticker-input", "update-scanned-sticker-preview");
    insertImage("weight-dimension-input", "update-weight-dimension-preview");
    insertImage("photos-01-input", "update-photos-01-preview");
    insertImage("photos-02-input", "update-photos-02-preview");
    insertImage("photos-03-input", "update-photos-03-preview");
    insertImage("photos-04-input", "update-photos-04-preview");

</script>


@endsection
