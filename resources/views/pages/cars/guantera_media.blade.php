@extends('layouts.master')
@section('title') Editar @endsection

@section('css')
    <style>
        .uimage-label{display:block}
        .image_display{height: 110px;}
        .image_display img {height:100% !important;}
        .uc-image{width:120px; height:160px; display:inline-block; vertical-align:middle; border:1px solid #ccc; margin:4px; text-align:center; padding:5px; position:relative;}
        .uc-image img{max-width:100%}
        .close-image-x{position: absolute;right: -10px; padding: 5px; background-color: #C00; border-radius: 100%;color: #FFF;
            cursor: pointer; top: -9px; width: 27px; z-index:999}
        .download-image-x{position: absolute;left: -8px; padding: 5px; background-color: #005; border-radius: 100%;color: #FFF;
            cursor: pointer; top: -9px; width: 27px; z-index:999}
    </style>
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
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Registro</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['record']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['record']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="record" value="{{$vehiclePaper['record']}}"/>
                                            <div id = "m-image" class="image_display">
                                                <img src='{{$vehiclePaper['record']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#m-image" data-link="record">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Revisado</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['reviewed']);

                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['reviewed']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="reviewed" value="{{$vehiclePaper['reviewed']}}"/>
                                            <div id = "reviewed" class="image_display">
                                                <img src='{{$vehiclePaper['reviewed']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#reviewed" data-link="reviewed">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>
                                            Tarjeta de pesas y dimensiones</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['weight-dimension']);

                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['weight-dimension']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="weight-dimension" value="{{$vehiclePaper['weight-dimension']}}"/>
                                            <div id = "weight-dimension" class="image_display">
                                                <img src='{{$vehiclePaper['weight-dimension']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#weight-dimension" data-link="weight-dimension">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>
                                            Póliza</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['policy']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['policy']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="policy" value="{{$vehiclePaper['policy']}}"/>
                                            <div id = "policy" class="image_display">
                                                <img src='{{$vehiclePaper['policy']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#policy" data-link="policy">Add Image</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>
                                            Tarjeta de pago de placa</label>
                                        <br>
                                        
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['payment-receipt']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['payment-receipt']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="payment-receipt" value="{{$vehiclePaper['payment-receipt']}}"/>
                                            <div id = "payment-receipt" class="image_display">
                                                <img src='{{$vehiclePaper['payment-receipt']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#payment-receipt" data-link="payment-receipt">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Sticker Escaneado</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['scanned-sticker']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['scanned-sticker']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="scanned-sticker" value="{{$vehiclePaper['scanned-sticker']}}"/>
                                            <div id = "scanned-sticker" class="image_display">
                                                <img src='{{$vehiclePaper['scanned-sticker']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#scanned-sticker" data-link="scanned-sticker">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                        <div class="mt-5 row">
                            <h2 class='mb-3'>Vehículo</h2>
                            
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Vehículo foto 01</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['photos-01']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['photos-01']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>
                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="photos-01" value="{{$vehiclePaper['photos-01']}}"/>
                                            <div id = "photos-01" class="image_display">
                                                <img src='{{$vehiclePaper['photos-01']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#photos-01" data-link="photos-01">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Vehículo foto 02</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['photos-02']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['photos-02']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>

                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="photos-02" value="{{$vehiclePaper['photos-02']}}"/>
                                            <div id = "photos-02" class="image_display">
                                                <img src='{{$vehiclePaper['photos-02']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#photos-02" data-link="photos-02">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                            <label>Vehículo foto 03</label>
                                        <br>
                                        @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['photos-03']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['photos-03']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>

                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="photos-03" value="{{$vehiclePaper['photos-03']}}"/>
                                            <div id = "photos-03" class="image_display">
                                                <img src='{{$vehiclePaper['photos-03']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#photos-03" data-link="photos-03">Add Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-inner col-lg-3">
                                <div class="item-content">
                                    <div class="form-group">
                                        <label>Vehículo foto 04</label>
                                        <br>
                                       @php
                                        $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper['photos-04']);
                                        @endphp
                                        <div class="uc-image">
                                            <a href="{{($media['is'])?$media['name']:$vehiclePaper['photos-04']}}" target="_blank" download class="mdi mdi-download download-image-x"></a>

                                            <span class="close-image-x">x</span>
                                            <input type="hidden" name="photos-04" value="{{$vehiclePaper['photos-04']}}"/>
                                            <div id = "photos-04" class="image_display">
                                                <img src='{{$vehiclePaper['photos-04']}}' alt="Image" />
                                            </div>
                                            <div style="margin-top:10px;">
                                                <a class="insert-media btn btn-danger btn-sm" data-type="image" data-for="display"
                                                   data-return="#photos-04" data-link="photos-04">Add Image</a>
                                            </div>
                                        </div>
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
<script>
    baseURL = "{{url('/')}}/";
    token = "{{csrf_token()}}";
</script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
/*
    insertImage("record-input", "update-record-preview");
    insertImage("reviewed-input", "update-reviewed-preview");
    insertImage("policy-input", "update-policy-preview");
    insertImage("payment-receipt-input", "update-payment-receipt-preview");
    insertImage("scanned-sticker-input", "update-scanned-sticker-preview");
    insertImage("weight-dimension-input", "update-weight-dimension-preview");
    insertImage("photos-01-input", "update-photos-01-preview");
    insertImage("photos-02-input", "update-photos-02-preview");
    insertImage("photos-03-input", "update-photos-03-preview");
    insertImage("photos-04-input", "update-photos-04-preview");*/

</script>

{{\App\Models\MediaPanel::insertMedia()}}
<script>

    function upload_u_file(){
        var f;
        var fdata = new FormData()

        fdata.append("_token",$('input[name="_token"]').val());
        fdata.append("action",'_medialPanel');
        fdata.append("method",'_upload_mediamanager');
        fdata.append("folder",$('#f_upload_form').find('.media-folder-u').find(':selected').val());
        fdata.append("file_name",$('#f_upload_form').find('.media-file-name').val());

        if($("#mediaUpload")[0].files.length>0)
            fdata.append("file",$("#mediaUpload")[0].files[0])
        //d = $("#add_new_product").serialize();
        $.ajax({
            type: 'POST',
            url: '/ajaxrequest',
            data:fdata,
            'dataType':'html',
            contentType: false,
            processData: false,
            success: function(response)
            {
                $("#f_upload_form").resetForm();
                console.log(response);
                f = response.responseText;
                $(".file-list").html(response);

            }
        })
    }
    $(document).on("click", ".close-image-x", function(){
        var c = window.confirm("Do you want to continue?");
        if (c){
            return true;
        }else{
            return false;
        }
    });
    $(document).on("click", ".close-image-x", function(){
        $(this).parent().find(".image_display img").attr('src','');
        /*$(".uc-image").each(function(index, value){
            var indx = index + 1;
            $(this).find("input[type='hidden']").attr("name", "image"+indx);
            $(this).find(".image_display").attr("id", "image"+indx);
            $(this).find(".insert-media").attr("data-return", "#image"+indx);
            $(this).find(".insert-media").attr("data-link", "image"+indx);
        });
        var m = $(".uc-image").length;
        $("input[name='total_images']").val(m)*/
    });
</script>
@endsection
