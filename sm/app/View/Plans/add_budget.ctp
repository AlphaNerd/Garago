<script type="text/javascript">
$(document).ready(function() {
$(".fa-plus-square").click(function(){
	var liste=$(this).attr('attr');
	$.ajax({
   type: "POST",
  url:"sm/plans/textarea/"+liste
 }).done(function(result) {
$("#"+liste).append(result);
  });
});

$('textarea').focusout(function(){
	if($(this).val()=="")
		$(this).remove();
})
$('input').on('change',function(){
	if($(this).val()=="")
		$(this).parent().remove();
	else{
		var id=$(this).attr('id');
		if(id.split('-')[1]=='1')
		{ 
			$("#subtotalcash1").val(Number($("#subtotalcash1").val())+Number($(this).val()));
			$("#total").val(Number($("#subtotalcash2").val())+Number($("#subtotalcash1").val()))
		}else if(id.split('-')[1]=='2')
		{
			$("#subtotalcash2").val(Number($("#subtotalcash2").val())+Number($(this).val()));
			$("#total").val(Number($("#subtotalcash2").val())+Number($("#subtotalcash1").val()))
		}

	}
})

$('#save').click(function(){
	var liste=$("#hiddenindex").val();
$('.auth-block2').find('.item').each(function(i,li){
 var id=$(this).attr('id');
liste=liste+",-,"+$(this).text();
	$('.auth-block2').find('input,textarea').each(function(i,li){
		if($(this).attr('iditem')==id)
			if($(this).is("[type='checkbox']"))
			{
				x=$(this).is(":checked");
				liste=liste+","+x;
			}else
			{
		       liste=liste+","+$(this).val();
	       }
	});
	
});
alert(liste)
	$.ajax({
  type: "POST",
  url:"sm/plans/budget/"+liste
}).done(function(result){
	alert(result);
});
	$(this).parent().hide();
	$("#refersh").show();
})



$('.fa-times').click(function(){
 $(this).parent().hide();
  $("#refersh").show();
});
});
</script>
<input type='hidden' value="" id="hiddenindex">
<div class="auth-block2" >
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgba(255, 255, 255, 0.8);">
	
  <table class="table"  style=" color: black;font-size: x-small;border-style: double;border-color: chocolate;">
    <thead>
<th style="width: 130px;"><?php echo __("Item");?></th>
<th><?php echo __("Amount(cash)");?></th>
<th><?php echo __("In-Kind");?></th>
<th style=" width: 200px;"><?php echo __("Sources");?></th>
<th style=" width: 100px;"><?php echo __("Status");?></th>
    </thead>
<tbody>
	<tr>
<td><div   id="item-1"><?php echo __("Community");?><div></td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="1-1"></i>
	<div class="divbudget" attr="1-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-1" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="1-2"></i>
	<div class="divbudget" attr="1-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-1" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="1-3"></i>
	<div class="divbudget" id="1-3">
    <textarea iditem="item-1"></textarea>
	</div>
</td>
<td>

	<div class="divbudget" id="1-4">
    <div class="onoffswitch">
	    <input type="checkbox" name="onoffswitch" iditem="item-1" class="onoffswitch-checkbox" id="myonoffswitch1" checked>
	    <label class="onoffswitch-label" for="myonoffswitch1">
	        <span class="onoffswitch-inner"></span>
	        <span class="onoffswitch-switch"></span>
	    </label>
		</div>
	</div>
</td>
</tr>
<tr>
<td><div   id="item-2"><?php echo __("Municipal");?></div></td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="2-1"></i>
	<div class="divbudget" attr="2-1">
   <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-2" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="2-2"></i>
	<div class="divbudget" attr="2-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-2" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="2-3"></i>
	<div class="divbudget" attr="2-3">
    <textarea iditem="item-2"></textarea>
	</div>
</td>
<td>
	<div class="divbudget" attr="2-4">
    <div class="onoffswitch">
	    <input type="checkbox" iditem="item-2" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch2" checked>
	    <label class="onoffswitch-label" for="myonoffswitch2">
	        <span class="onoffswitch-inner"></span>
	        <span class="onoffswitch-switch"></span>
	    </label>
		</div>
	</div>
</td>
</tr>
<tr>
<td><div   id="item-3"><?php echo __("Provincial Government");?></div></td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="3-1"></i>
	<div class="divbudget" attr="3-1">
   <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-3" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="3-2"></i>
	<div class="divbudget" attr="3-2">
<div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-3" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="3-3"></i>
	<div class="divbudget" attr="3-3">
    <textarea iditem="item-3"></textarea>
	</div>
</td>
<td>

	<div class="divbudget" attr="3-4">
    <div class="onoffswitch">
	    <input type="checkbox" iditem="item-3" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
	    <label class="onoffswitch-label" for="myonoffswitch3">
	        <span class="onoffswitch-inner"></span>
	        <span class="onoffswitch-switch"></span>
	    </label>
		</div>
	</div>
</td>
</tr>
<tr>
<td><div   id="item-4"><?php echo __("Federal government");?></div></td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="4-1"></i>
	<div class="divbudget" id="4-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-4" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="4-2"></i>
	<div class="divbudget" id="4-2">
   <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-4" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="4-3"></i>
	<div class="divbudget" id="4-3">
    <textarea id='4-3'></textarea>
	</div>
</td>
<td>

	<div class="divbudget" attr="4-4">
 <div class="onoffswitch">
	    <input type="checkbox" iditem="item-4" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch4" checked>
	    <label class="onoffswitch-label" for="myonoffswitch4">
	        <span class="onoffswitch-inner"></span>
	        <span class="onoffswitch-switch"></span>
	    </label>
		</div>
	</div>
</td>
</tr>
<tr>
<td><div   id="item-5"><?php echo __("Private");?></div></td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="5-1"></i>
	<div class="divbudget" id="5-1">
   <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-5" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="5-2"></i>
	<div class="divbudget" id="5-2">
   <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" iditem="item-5" placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
<td>
	<i class="fa fa-plus-square" aria-hidden="true"style="float: right;margin-right: 0px;" attr="5-3"></i>
	<div class="divbudget" attr="5-3">
    <textarea iditem="item-5"></textarea>
	</div>
</td>
<td>

	<div class="divbudget" attr="5-4">
		<div class="onoffswitch">
	    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch5" checked>
	    <label class="onoffswitch-label" for="myonoffswitch5">
	        <span class="onoffswitch-inner"></span>
	        <span class="onoffswitch-switch"></span>
	    </label>
		</div>
</div>

</td>
</tr>
</tbody>
<thead>
<TD><div   id="item-6"><?php echo __("SUB TOTAL"); ?></div></TD>
<TD>  <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span>
	<input style="color:#000000;" id="subtotalcash1" type="number" class="form-control with-success-addon" id="input1-2" placeholder="00">
	 <span class="input-group-addon addon-right input-group-addon-success">.00</span></div></TD>
<TD>  <div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span>
	<input  id="subtotalcash2" type="number" style="color:#000000;" class="form-control with-success-addon" id="1-2" placeholder="00"> 
	<span class="input-group-addon addon-right input-group-addon-success">.00</span></div></TD>

</thead>
<tr><TD>Total</TD>
<TD colspan="2" align="center">

<div class="input-group ng-scope" style="margin-top: 4px;width: 280px;"><span class="input-group-addon addon-left input-group-addon-success">$</span>
	<input  id="total" type="number" style="color:#000000;" class="form-control with-success-addon" id="input1-2" placeholder="00"> 
	<span class="input-group-addon addon-right input-group-addon-success">.00</span></div>

</TD></tr>
  </table>
</div>
<button class="btn form-control"style="float: right;width: 200px;" id="save">save</button>
<<<<<<< HEAD
</div>
=======
</div>
bilel belwafi
>>>>>>> master
