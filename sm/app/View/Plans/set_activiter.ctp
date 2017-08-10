<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
   
    <?php echo $this->Html->css('bootstrap-tagsinput');  ?>
     <?php echo $this->Html->script('bootstrap-tagsinput.min');  ?>
 
<style type="text/css">

      .placepicker-map {
        width: 100%;
        height: 300px;
      }

      .another-map-class {
        width: 100%;
        height: 300px;
      }

      .pac-container {
        border-radius: 5px;
      }

.form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: none;
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: inline-block;   
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
    display: inline-block;
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
    display: none;   
}


.divselectone{
  height: 46px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
    cursor: pointer;

}
.demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
#progress-bar {background-color: #12CC1A;height:73px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
.btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}

#targetLayer{width:100%;text-align:center;}

</style>
<?php echo $this->Html->script('jquery.form.min');  ?>
<script>
function listindicator($id)
{
$.ajax({
          type: "POST",
           url:"sm/plans/listeindicator/"+$id
        }).done(function(result){
          $("#indicators").html(result);
        })
}
$('.fa-times, #save').click(function(){
 $(this).parent().hide();
  $("#refersh").show();
});
listindicator($("#idActivite").val());
	$(".fa-floppy-o").click(function(){
		$idActiviter=$("#id_activiter").val();
		$datefin=$("#datefin").val();
		$type=$("#typeA").val();
		$description=$("#description").val();
		$num=$("#num").val();
		$cible=$("#cible").val();
		$liste=Array($num,$description,$type,$cible,$datefin,$idActiviter);
		 $.ajax({
          type: "POST",
           url:"sm/plans/newIndicator/"+$liste
        });
		    
		
       $("#newIndicateur").find('input').val(" ");
       $("#num").val("--");
       $("#description").text('bilel');
	})
	$("#save").click(function(){
		$Activiter_Title=$("#Activiter_Title").val();
		$Actviter_Description=$("#Actviter_Description").val();
		$idActivite=$("#idActivite").val();
		$Activiter_Cible=$("#Activiter_Cible").val();
		$liste=Array($idActivite,$Actviter_Description,$Activiter_Cible,$Activiter_Title);
		 $.ajax({
          type: "POST",
           url:"sm/plans/saveActiviter/"+$liste
        });
		
	})
</script>
<div class="auth-block2" >
	<input type="hidden" value="<?php  echo $activiter['Activite']['id'] ; ?>" id="idActivite">
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgb(245, 245, 245);">
	<div class="outilTable">
	<?php echo __("Modifier Activité");?>
	</div>
	<input type="hidden" name="frmAction" value="CreateProject">
		<div>
			<input type="text" id="Activiter_Title" value="<?php echo $activiter['Activite']['title'];?>" class="form-control2" placeholder="<?php echo __("Titre");?>" style="width: 600px;">
	    </div>
	    <div>
			<input type="text" id="Activiter_Cible" value="<?php echo $activiter['Activite']['cible'];?>" class="form-control2" placeholder="<?php echo __("Titre");?>" style="width: 600px;">
	    </div>
		<div>
		<input id="Actviter_Description" class="form-control2 input-lg" value="<?php echo $activiter['Activite']['description'];?>"
       placeholder="<?php echo __('Description');?>" style="width: 600px;">
		</div>
			<div>
              <input type="text" list="users" value="" name="keyword" data-role="tagsinput" class="form-control2 input-lg" placeholder="User" tabindex="4"> 
          </div>
      <?php echo $activiter['Activite']['num'];?>  	
</div>
<?php echo __("INDICATOR"); ?>
	<div class="indicator" id="indicators">
<?php //include('listeindicator.ctp') ;?>
	</div>
	<table class="table" id="newIndicateur">
			<tr>
				<td><input style="width: 20px;" class="form-control2-2 edit_Input" value="--" id="num"></td>
				<td><textarea name="" id="description" class="form-control2-2 edit_Input" style="resize: none;height: 20px;"></textarea></td>
				<td><select class="form-control2-2 edit_Input" name="" id="typeA">
						<option value="0">%</option>
						<option value="1">#</option>
						<option value="2">$</option>
					</select>
				</td>
				<td><input type="date" class="form-control2-2 edit_Input" id="datefin"></td>
				<td><input type="number" class="form-control2-2 edit_Input" id="cible"></td>
				<td><span class="fa fa-floppy-o" aria-hidden="true"></span></td>
			</tr>
	</table>
<button class="btn1212"style="float: right;width: 200px;" id="save">save
</button>
</div>

<datalist id="users">
  <?php foreach ($users as $user) {
	?>
<option value="<?php echo $user['User']['email'] ?>">
	</option>
<?php
} ?>
   </datalist>