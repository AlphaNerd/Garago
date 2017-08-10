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
<div class="auth-block" style="width:100%;">
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgba(255, 255, 255, 0.8);">
	
  <table class="table"style=" color: black;font-size: x-small;border-style: double;border-color: chocolate;">
    <thead>
<th style="width: 200px;"><?php echo __("Resources(Group ou Users)");?></th>
<th><?php echo __("Tasks");?></th>
    </thead>
<tbody>
	<tr>
		<td><?php echo __("Option");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="1-1">
   <textarea id='textarea'></textarea>
	</div>
</td>
</tr>
<tr>
	<td><?php echo __("Option");?></td>
<td style="width: 200px;">
	<div class="divbudget" id="1-2">
<textarea id='textarea'></textarea>
	</div>
</td>
    </tr>
 
 
  </table>
</div>
</div>