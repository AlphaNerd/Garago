<script type="text/javascript">
$(document).ready(function() {
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
$('.fa-times').click(function(){
 $(this).parent().hide();
  $("#refersh").show();
});
});
</script>
<div class="auth-block2">
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgba(255, 255, 255, 0.8);">
	
  <table class=""style=" color: black;font-size: x-small;border-style: double;border-color: chocolate;">
    <thead>
<th><?php echo __("Item");?></th>
<th><?php echo __("Temporary/Internship");?></th>
<th><?php echo __("Permanent");?></th>
    </thead>
<tbody>
	<tr>
		<td><?php echo __("Youth");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="1-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input1-1" > </div>
	</div>
</td>
<td style="width: 200px;">
	<div class="divbudget" id="1-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input1-2" ></div>
	</div>
</td>
    </tr>
    <tr>
		<td><?php echo __("Women");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="2-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input2-1" ></div>
	</div>
</td>
<td style="width: 200px;">
	<div class="divbudget" id="2-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input2-2" > </div>
	</div>
</td>
    </tr>
    <tr>
		<td><?php echo __("Immigrants");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="3-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input3-1" ></div>
	</div>
</td>
<td style="width: 200px;">
	<div class="divbudget" id="3-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input3-2" > </div>
	</div>
</td>
    </tr>
    <tr>
		<td><?php echo __("Aboriginals");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="4-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input4-1" > </div>
	</div>
</td>
<td style="width: 200px;">
	<div class="divbudget" id="4-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input4-2" > </div>
	</div>
</td>
    </tr>
    <tr>
		<td><?php echo __("Generals");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="5-1">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input5-1" > </div>
	</div>
</td>
<td style="width: 200px;">
	<div class="divbudget" id="5-2">
    <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;"><input type="number" class="form-control with-success-addon" id="input5-2" > </div>
	</div>
</td>
    </tr>
   <thead>
<TD><?php echo __("SUB TOTAL"); ?></TD>
<TD>  <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;">
	<input style="color:#000000;" id="subtotalcash1" disabled = 'disabled' type="number" class="form-control with-success-addon" id="input1-2" >
	</div></TD>
<TD>  <div class="input-group ng-scope" style="margin-top: 4px;width: 190px;">
	<input disabled ='disabled' id="subtotalcash2" type="number" style="color:#000000;" class="form-control with-success-addon" id="input1-2" > 
</div></TD>

</thead>
    <tr ><TD>Total</TD>
<TD colspan="2" align="center">

<div class="input-group ng-scope" style="margin-top: 4px;width: 380px;">
	<input disabled ='disabled' id="total" type="number" style="color:#000000;" class="form-control with-success-addon" id="input1-2" placeholder=""> 
</div>

</TD></tr>
  </table>
</div>
<button class="btn form-control"style="float: right;width: 200px;">save</button>
</div>