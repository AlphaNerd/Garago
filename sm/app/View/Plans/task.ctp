
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">

$(document).ready(function() {

$('.fa-times').click(function(){
	$("#popup").parent().hide();
	$("#outiltable").show();
	$("#example").find('div').css('pointer-events','auto');
});
$("#save").click(function(){
var liste=Array(
					$("#Task_Title").val(),
					$("#Task_Description").val(),
					$("#Task_Project").val(),
					$("#Task_Start").val(),
					$("#Task_End" ).val(),
					$("#heurEstimer" ).val(),
					$("#TauxEstimee" ).val(),
					$("#Budget" ).val(),
					$("#Task_Urgent" ).is(":checked"),
					$("#Task_Notify").is(":checked")
		 		);
	 $.ajax({
	         type: "POST",
	         url:"sm/plans/task/"+liste
			}).done(function(result){
	          $("#InterfaceTache").html($(".table-responsive").html())
        $("#example").find('div').css('pointer-events','auto');
	          })  
	        });

$( "#slider" ).slider({
      range: "max",
      min: 0,
      max: 100,
      value: 0,
      slide: function( event, ui ) {
        $( "#accompli" ).text( ui.value );
      }
    });
});

$(".check_overlay").click(function(){
	if($(this).find("input[type='checkbox']").is(":checked"))
	{
		$(this).css('background-color','rgba(60, 118, 61, 0.88)')
		$(this).css('color','rgba(255, 255, 255, 1)')
		$(this).find('span').show()
	}else
	{
		$(this).css('background-color','rgba(255, 255, 255, 1)')
		$(this).css('color','rgba(0, 0, 0, 0.6)')
		$(this).find('span').hide()
	}
})
</script>
<input type="text" value="<?php echo $liste; ?>" id="Task_Project">
<div id="popup">
	<div class="table-responsive" style="background: rgba(255, 255, 255, 0.8);">
		<div class="outilTable">
			<?php echo __("Créer un Task");?></div>
    <input type="text" name="Task_Title" id="Task_Title" value="" class="form-control2" placeholder="Titre">
				<div>
					<textarea id="Task_Description" class="form-control2 input-lg"
           placeholder="<?php echo __('Description');?>"></textarea>
				</div>
					<input type="date" id="Task_Start" value=""class="form-control2" placeholder="Début" >
					<input type="date"  id="Task_End" value="" class="form-control2" placeholder="Échéance" >
					<input type="number" class="form-control2" id="heurEstimer" placeholder="<?php echo __("Heur(s) Esstimee(s)") ?>"> 
					
				<div class="input-group ng-scope" >
					<span class="input-group-addon addon-left input-group-addon-success" style="background: #2389c6;">&nbsp;$</span>
					<input type="number" class="form-control2 input-task" id="TauxEstimee" placeholder="<?php echo __("Taux Esstimé") ?>"> 
					<span class="input-group-addon addon-right input-group-addon-success" style="background: #2389c6;">.00</span>
				</div>
				
               <div class="input-group ng-scope"><span style="background: #2389c6;" class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control2 input-task" id="Budget" placeholder="<?php echo __("Budget") ?>"> <span class="input-group-addon addon-right input-group-addon-success" style="background: #2389c6;">.00</span></div>
			
			<div>
		<label class="check_overlay "for="Task_Urgent"><?php echo __("Urgent");?>
					 <span class="fa fa-check-circle" style="margin-top: -4px;"></span>
						<input type="checkbox" id="Task_Urgent" id="Task_Urgent" value="1" class="text ui-widget-content ui-corner-all">
				
					</label>
				</div>

					<div>
		<label class="check_overlay "for="Task_Notify"><?php echo __("Aviser les utiliateurs par courriel");?>
					 <span class="fa fa-check-circle" style="margin-top: -4px;"></span>
						<input type="checkbox" id="Task_Notify" id="Task_Notify" value="1" class="text ui-widget-content ui-corner-all">
				
					</label>
				</div>
				
			 <button type="button" class="btn-btn12" id="save" ><?php echo __("SAVE");?>
            </button> 
            <button type="button" class="btn-btn12" ><?php echo __("CANCEL");?>
            </button>
				</fieldset>
		
		</div>
	</div>

