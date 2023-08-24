
<script src="/app-assets/mediaPanel_assets/form.js"></script>
<script src="/app-assets/mediaPanel_assets/custom.js?<?php echo rand(1000,9999); ?>"></script>
<link rel="stylesheet" href="/app-assets/mediaPanel_assets/style.css?<?php echo rand(1000,9999); ?>" />
<input type="hidden"  value="<?php echo url('/'); ?>/admin/" name="ajaxurl" />
<div class="media-wrapper">
	
	<div class="mediaPanel">
    	<div class="close-m-panel">x</div>
		<div class='m-left'>
        	<ul>
            	<li class="active" data-for="m-insert"><a href="#">@lang('media.insert_media')</a></li>
                <li data-for="m-folder"><a href="#">@lang('media.create_folder')</a></li>
                <li data-for="m-upload"><a href="#">@lang('media.upload_media')</a></li>
                <!--<li data-for="m-url"><a href="#">Insert From Url</a></li>-->
            </ul>
        </div>
        
        <div class="m-right">
        	<div class="m-insert m-box">
                @include('mediaPanel.uploaded_files')
            </div>
             <div class="m-folder m-box">
                 @include('mediaPanel.create_gallery')
            </div>
            <div class="m-upload m-box">
                @include('mediaPanel.uploadMedia')
            </div>
            <div class="m-url m-box">
            	<?php //require "insertMedia.php"; ?>
            </div>
            <div class="m-video m-box">
                <?php /*$this->load->view("admin/mediaPanel/insertVideo");*/ ?>
            </div>
        </div>
        
        <div class="m-clear"></div>
    </div>
</div>
