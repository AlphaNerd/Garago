 <div  class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur=""style="width: 237px;height: 268px;">

<div class="panel" style="height: 240px;">
	<div  style="height: 200px;overflow: auto;">
<?php 

foreach ($messages as $message) {
	?>
	<div>
		<?php echo $message['Message']['description'];?></div>
	<?php } ?>


</div>
<div style="position: absolute;margin-top: 2px;">
	<div class="input-group ng-scope">
              <input type="text" class="form-control with-danger-addon" placeholder="<?php echo __('Write Message...');?>" id="search-suggest" list="query">
               <span class="input-group-btn">
                <button class="btn btn-danger" type="button" id="submitmessage"> <i class="fa fa-opencart" aria-hidden="true"></i></button>
               </span>
             </div >
</div>
 
</div>
</div>
