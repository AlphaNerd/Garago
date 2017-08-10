<style type="text/css">
textarea {
    display: -webkit-box;
    width: 100%;
    background: none;
    border-style: groove;
    border-color: cadetblue;
    min-width: 40px;
    min-height: 20px;
    height: 30px;
    border-top: none;
    border-left: none;
    border-right: none;
    resize: vertical;
}
input {
    display: -webkit-box;
    width: 100%;
    background: none;
    border-style: groove;
    border-color: cadetblue;
    min-width: 40px;
    min-height: 20px;
    height: 40px;
    border-top: none;
    border-left: none;
    border-right: none;
    
}
</style><script type="text/javascript">
$(document).ready(function() {
$('textarea').focusout(function(){
	if($(this).val()=="")
		$(this).remove();
})
$('input').focusout(function(){
	if($(this).val()=="")
		$(this).parent().remove();
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

});
</script>
<?php  $index=explode('-', $liste);
if($index[1]=='1'|| $index[1]=='2')
{
?>
<div class="input-group ng-scope" style="margin-top: 4px;width: 140px;"><span class="input-group-addon addon-left input-group-addon-success">$</span><input type="number" class="form-control with-success-addon" id="input<?php echo $liste;?>" aria-label="Amount (to the nearest dollar)"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
<?php }else{ ?>
<textarea id='textarea<?php echo $liste; ?>'></textarea>
<?php }?>