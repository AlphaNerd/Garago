<script type="text/javascript">
$('.fa-times').click(function(){
 $(this).parent().hide();
  $("#refersh").show();
  $("#outiltable").show();
});
$(".check_overlay").click(function(){
	if($(this).find("input[type='checkbox']").is(":checked"))
	{
		$(this).css('background-color','rgba(60, 118, 61, 0.88)')
		$(this).find('span').show()
	}else
	{
		$(this).css('background-color','rgba(255, 255, 255, 1)')
		$(this).find('span').hide()
	}
})
$('#save').click(function(){
	$id=$("#id_liste").val()
	$title=$("#Project_Title").val();
	$Project_Description=$("#Project_Description").val();
	$Task_Notify=$("#Task_Notify").val();
	$liste=$title+"--.--"+$Project_Description+"--.--"+$Task_Notify+"--.--"+$id;
	
	 $.ajax({
          type: "POST",
           url:"sm/plans/setProject/"+$liste
        }).done(function(result){
        	
        });
         $(this).parent().hide();
  $("#refersh").show();
  $("#outiltable").show();
	
})
</script>
<div class="auth-block2" >
	<input type="hidden" value="<?php  echo $liste; ?>" id="id_liste">
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgb(245, 245, 245);">
<div class="outilTable">
			<?php echo __("Créer un projet");?></div
	
			<input type="hidden" name="frmAction" value="CreateProject">
			<div>
					<input type="text" id="Project_Title" value="" class="form-control2" placeholder="<?php echo __("Titre");?>" style="width: 600px;">
		    </div>
			<div>
					<textarea id="Project_Description" class="form-control2 input-lg"
           placeholder="<?php echo __('Description');?>" style="width: 600px;"></textarea>
			</div>
        	<div>
		<label class="check_overlay "for="Task_Notify"><?php echo __("Aviser les utiliateurs par courriel");?>
					 <span class="fa fa-check-circle" style="margin-top: -4px;"></span>
						<input type="checkbox" id="Task_Notify" id="Task_Notify" value="1" class="text ui-widget-content ui-corner-all">
				
		</label>
		</div>

 
</div>
<button class="btn1212"style="float: right;width: 200px;" id="save">save</button>
</div>