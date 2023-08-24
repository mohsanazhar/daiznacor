 <?php

?>
<h3 class="box-title">@lang('media.create_folder')</h3>
<div class="ins-left">
	<div class="inner">
       <div class="col-md-6">
               <div class="form-group mb-1">
                  <label class="req">@lang('media.folder_title')</label>
                  <input type="text" name="title" class="form-control f-gal"  autocomplete="off">
               </div>
                <div class="form-group mb-1">
                    <label class='req'>@lang('media.parent')</label>
                    <select name="parent_folder" class="form-control parent_name">
                        {{\App\Models\MediaPanel::_getFolders()}}
                    </select>
                </div>
               <div class="form-group mb-1">
                  <input type="submit" name="v-submit-u" class="btn btn-primary v-submit-f" data-input='new'>
               </div>
               
          <?php
		  	$r = \App\Models\CategoryModel::where(['type'=>'folder','parent'=>0])->orderBy('name','ASC')->get();
			echo "<ul class='folder-g'>";
			foreach ($r as $k=>$row){
				echo "
					<li>
						".$row->name."
						<div class='action'>
							<a data-title='".$row->name."' data-parent='".$row->parent."' class='edit-folder'>".__('media.edit')."</a>
							<a data-title='".$row->name."' data-parent='".$row->parent."' class='del-folder'>x</a>
						</div>
						<div class='m-clear'></div>
					</li>
				";

                                $sfolder = \App\Models\MediaPanel::_get_sub_folder($row->id);
                                if(count($sfolder)>0){
                                    foreach($sfolder as $s=>$sf){
                                       echo "
                                            <li>
                                                        -".$sf->name."
                                                        <div class='action'>
                                                                <a data-title='".$sf->name."' data-parent='".$sf->parent."' class='edit-folder'>".__('media.edit')."</a>
                                                                <a data-title='".$sf->name."' data-parent='".$sf->parent."' class='del-folder'>x</a>
                                                        </div>
                                                        <div class='m-clear'></div>
                                                </li>
                                        "; 
                                    }
                                }
			}	
			echo "<ul>";
		?>
       </div>   
	</div>
    
    
    
</div>