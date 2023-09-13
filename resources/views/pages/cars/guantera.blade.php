@extends('layouts.master')
@section('title') Editar @endsection

@section('css')
    <style>
        .uimage-label{display:block}
        .image_display{height: 90px;  width: 80px;  }
        .image_display img {height:100% !important; width: 100%;}
        .uc-image{width:120px; height:160px; display:inline-block; vertical-align:middle; border:1px solid #ccc; margin:4px; text-align:center; padding:5px; position:relative;}
        .uc-image img{max-width:100%}
        .comm {
            width: 30px !important;
            height: 29px !important;
        }
        .comm i{font-size: 18px;
            text-align: center;}
        .insert-media {
            background-color: #2dcb72;
            border-radius: 18%;
            color: #FFF;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }
        .download-image-x {
            background-color: #00599c;
            border-radius: 20%;
            color: #FFF;
            cursor: pointer;
            z-index: 999;
            text-align: center;
            display: inline-block;
        }
        .close-image-x {
            background-color: #C00;
            border-radius: 20%;
            color: #FFF;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }
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
                        <div class="col-md-12 col-sm-12">
                            <table id="card-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('translation.linked_with')</th>
                                        <th>@lang('translation.file_name')</th>
                                        <th>@lang('translation.type')</th>
                                        <th>@lang('translation.media')</th>
                                        <th>@lang('translation.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $vehicle_paper = ['record','reviewed','policy','weight-dimension',
                    'payment-receipt','scanned-sticker','photos-01','photos-02','photos-03',
                    'photos-04','others'];
                                    $i=1;
                                foreach ($vehicle_paper as $k=>$v){
                                    $media = \App\Helper\RequestHelper::getMediaFile($vehiclePaper[$v]);
                                    $type = $name = "";
                                    if(!is_null($vehiclePaper[$v])){
                                        $exp = explode('/',$vehiclePaper[$v]);
                                        $file_name = end($exp);
                                        $expp = explode('.',$file_name);
                                        $type = end($expp);
                                        $name = str_replace(".".$type,"",$file_name);
                                    }
                                ?>
                                <tr class="tr-{{$v}}">
                                      <td>{{$i}}</td>
                                      <td>{{__('translation.'.$v)}}</td>
                                      <td class="file_name">{{$name}}</td>
                                      <td class="file_type">{{ucwords($type)}}</td>
                                      <td >
                                          <input type="hidden" name="{{$v}}" class="image_value" value="{{$vehiclePaper[$v]}}"/>
                                          <div id = "m-{{$v}}" class="image_display">
                                              <img src='{{url('/').'/'.$vehiclePaper[$v]}}' alt="Image" />
                                          </div>
                                      </td>
                                      <td>
                                          <a class="comm insert-media" data-type="image" data-for="display"
                                             data-return="#m-{{$v}}" data-link="{{$v}}">
                                              <i class="mdi mdi-upload"></i>
                                          </a>
                                          <a href="/{{($media['is'])?$media['name']:$vehiclePaper[$v]}}" target="_parent" download class="comm download-image-x">
                                              <i class=" mdi mdi-download"></i>
                                          </a>
                                          <a data-row="tr-{{$v}}" class="comm close-image-x">
                                              <i class="mdi mdi-close"></i>
                                          </a>
                                      </td>
                                </tr>

                                <?php
                                        $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                       {{-- <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Subir archivos</label>
                            <input class="form-control" type="file" name="others" multiple>
                        </div>--}}
                        <div class="hstack gap-2 justify-content-end">
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
            var tr = $(this).data('row');
            $('.'+tr).find(".image_display img").attr("src","");
            $('.'+tr).find(".image_value").val("");
        }else{
            return false;
        }
    });
</script>
@endsection
