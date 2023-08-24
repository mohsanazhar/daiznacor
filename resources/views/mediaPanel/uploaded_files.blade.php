<h3 class="box-title">@lang('media.insert_media')</h3>
<div class="ins-left">
<div class="row">
    <div class="col-md-6">
    <select name="folder" class="form-control media-folder-u image-from-folder">
    {{\App\Models\MediaPanel::_getFolders()}}
    </select>
    </div>
</div>
<div class="inner">
<?="<ul class='file-list'>";?>
    {{\App\Models\MediaPanel::_get_images()}}
<?="</ul>";?>
</div>
</div>
<div class="ins-right">
	<div class="f-info">
    	<h4>@lang('media.media_information')</h4>
    	<div class="img">
        
        </div>
        <div class="title"></div>
        <div class="date"></div>
        <div class="size"></div>
        <div class="dimension"></div>
        <div class="del del-fu"><a href="#">@lang('media.delete_permanently')</a></div>
        
        <div class="alt-form">
        	 <div class="form-group">
                 <label>@lang('media.title')</label>
                 <input type="text" name="img-title" class="form-control" style="border:1px solid #999;"/>
             </div>
             
             <div class="form-group">
                 <label>@lang('media.alt')</label>
                 <input type="text" name="img-alt" class="form-control" style="border:1px solid #999;"/>
             </div>
             
        	 <button class="btn insert-m-to">@lang('media.insert_media')</button>
        </div>
        
    </div>
   
</div>