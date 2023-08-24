
   
<h3 class="box-title">@lang('media.upload_media')</h3>
<div class="ins-left">
    <div class="inner">
        <form id="f_upload_form" method="post" enctype="multipart/form-data">
            <select name="folder" class="form-control media-folder-u">
               {{\App\Models\MediaPanel::_getFolders()}}
            </select>
            <div class="form-group mt-2">
                <label>@lang('media.file_name')</label>
                <input type="text" class="form-control media-file-name" name="file_name"/>
            </div>
            <input type="hidden" name="action" value="_medialPanel"/>
            <input type="hidden" name="method" value="_upload_mediamanager"/>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="upload-f">
                <div class="label">@lang('media.upload_media')</div>
                <div class="upf">
                    <input type="file" name="ufile" id="mediaUpload" accept="image/*|application/pdf"/>
                </div>
            </div>
        </form>           
    </div>
</div>
