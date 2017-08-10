
<div ba-panel="" ba-panel-title="Standard Fields" ba-panel-class="with-scroll">
    <div  class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur="" style="background-size: 1530px 861px; background-position: 0px -64px; min-height: 441px">
<?php
$view=0;
$favourite=0;
$like=0;
$download=0;
$unlike=0;
$send=0;
$Userview=0;
$Userfavourite=0;
$Userlike=0;
$Userdownload=0;
$Userunlike=0;
$Usersend=0;
foreach ($actions as $action) {
	if($action['Action']['type']=="view")
	{
		$view++;
		if($action['Action']['profile_id']==$user_id)
		{
			$Userview++;
		}
	}	
	else if($action['Action']['type']=="favourite")
		{
			$favourite++;
			if($action['Action']['profile_id']==$user_id)
		{
			$Userfavourite++;
		}
		}
	else if($action['Action']['type']=="like")
		{
			$like++;
			if($action['Action']['profile_id']==$user_id)
		{
			$Userlike++;
		}
		}
	else if($action['Action']['type']=="download")
		{
			$download++;
			if($action['Action']['profile_id']==$user_id)
		{
			$Userdownload++;
		}
		}
	else if($action['Action']['type']=="unlike")
		{
			$unlike++;
			if($action['Action']['profile_id']==$user_id)
			{
				$Userunlike++;
			}
		}
	else
		{
			$send++;
			if($action['Action']['profile_id']==$user_id)
			{
				$Usersend++;
			}
		}
		
}
?>    
<div class="panel-heading clearfix">
<input type="hidden" value="<?php echo $documents['Document']['id']?>" id="id_document">
<input type="hidden" value="<?php echo $user_id;?>" id="id_profile">
<div class="col-sm-2">
<button class='glyphicon glyphicon-eye-open' style="border: none;background: none;" id="view" 
documentID="<?php echo $documents['Document']['id'];?>">
</button><span style="color: lightsteelblue;">
<?php echo $view;?></span>
</div>
<div class="col-sm-2">
<button  style="border: none;background: none;"
 id="favourite"  title="<?php if ($Userfavourite)echo 'favourite'?>"
  <?php
   if($Userfavourite) {  ?> etat='0' class='glyphicon glyphicon-heart' <?php }else{?>
   class='glyphicon glyphicon-heart-empty' etat='1' <?php }?>>
</button >
  <span style="color: lightsteelblue;"><?php echo $favourite;?></span>
</div>
<div class="col-sm-2">
<button  class='glyphicon glyphicon-thumbs-up' style="border: none;background: none;"
 id="like" <?php if($Userlike) echo "disabled='disabled'"; ?> ></button><span style="color: lightsteelblue;"><?php echo $like;?></span>
</div>
<div class="col-sm-2">
<button  class='glyphicon glyphicon-thumbs-down' style="border: none;background: none;"
 id="unlike" <?php if($Userunlike) echo "disabled='disabled'"; ?>></button ><span style="color: lightsteelblue;"><?php echo $unlike;?></span>
</div>
<div class="col-sm-2">
<button  class='glyphicon glyphicon-envelope' style="border: none;background: none;"
 id="Send" ></button ><span style="color: lightsteelblue;"><?php echo $send;?></span>
</div>
<div class="col-sm-2">
<button  class="glyphicon glyphicon-save" style="border: none;background: none;"
 id="download"></button ><span style="color: lightsteelblue;"><?php echo $download;?></span>
</div>
</div>
<div class="panel" >
<h3>
<?php echo $documents['Document']['name'];?>
</h3>
<?php  $uesrname = $this->Session->read("username");
echo $uesrname;?>
<hr>
<?php echo $documents['Document']['description'];?>
</div>
</div>
  <div class="col-md-9" id="openDocument" tabindex="-1" style="position: fixed;margin-left: -600px;margin-top: -581px; display:none">
<div ba-panel="" ba-panel-title="Standard Fields" ba-panel-class="with-scroll">
    <div class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur="" style="background-size: 1530px 861px; background-position: 0px -64px;min-height: 441px">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>
       <div class="panel-heading clearfix"><?php echo $documents[0]['Document']['name'];?>
      </div>
      <div class="panel" style="overflow: auto;height: 560px;">
<?php 
print_r($documents);
?>
</div>
  </div>
</div>
</div>
<div class="col-md-4 " id="downloadDocument" tabindex="-1" style="position: fixed;margin-top: -479px;overflow: hidden;display: none;margin-left: -271px;">
 <div ba-panel="" ba-panel-title="Standard Fields" ba-panel-class="with-scroll">
    <div class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur="" style="background-size: 1530px 861px; background-position: 0px -64px;min-height: 441px">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeudownload"><span aria-hidden="true">&times;</span></button>
        <div class="panel-heading clearfix"><?php echo $documents['Document']['name'];?>
      </div>
      <div class="panel" style="overflow: auto;height: 360px;">
      	<?php 
print_r($attachments);
      	// $name=$documents['Document']['name'].".zip";
      	// $tab=explode("\\",$documents['Document']['url']);
      	// $url=$tab[0].'/'.$tab[1].'/'.$tab[2].'/'.$tab[3].'/'.$name;
      	?>
      	<a href="<?php //$url ;?>">download</a>
      <a class="btn btn-block btn-social btn-dropbox">   
  </a>
    </div>  
    </div>
  </div>
</div>
</div>
</div>