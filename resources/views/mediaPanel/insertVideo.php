<h3 class="box-title"></h3>
<div class="ins-left">
	<div class="inner">
       <div class="col-md-6">
       			<input type="hidden" name="url" value="<?php echo admin_url(); ?>videoframe">
                <div class="form-group">
                  <label class="req">source</label>
                  <select name="source" class="form-control">
                      <option value="facebook">Facebook</option>
                      <option value="dailymotion">Dailymotion</option>
                      <option value="tune.pk">Tune.pk</option>
                      <option value="vimeo">Vimeo</option>
                      <option value="youtube">Youtube</option>
                  </select>
               </div>
               <div class="form-group">
                  <label class="req">Video Url</label>
                  <input type="text" name="embed" class="form-control"  autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="submit" name="v-submit" class="btn btn-primary v-submit">
               </div>
       </div>   
	</div>
</div>