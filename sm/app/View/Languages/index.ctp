
<script type="text/javascript">
$(document).ready(function() {
$(".b_edit").click(function(){
	var id=$(this).attr("id");
$("#button"+id).hide();
$("#form"+id).show();
$("#name"+id).prop( "disabled", false );
$("#name"+id).select()
$("#abbrevation"+id).prop( "disabled", false );
$("#abbrevation"+id).select()
})
$(".save").click(function(){
	var id=$(this).attr("id");
$("#button"+id).show();
$("#form"+id).hide();
var liste=id+",-,"+$("#name"+id).val()+",-,"+$("#abbrevation"+id).val();
$.ajax({
  type: "POST",
 url:"sm/languages/index/"+liste
}).done(function(result){
	$("#liste").html(result);
})
$("#abbrevation"+id).prop( "disabled", true );
$("#name"+id).prop( "disabled", true );
});

$(".savenew").click(function(){
var liste=$("#inputnew").val()+",-,"+$("#inputnew2").val();
$.ajax({
  type: "POST",
 url:"sm/languages/index/"+liste
}).done(function(result){
	$("#liste").html(result);
});});
$(".delete_b").click(function(){
var r = confirm("<?php echo __('Avez-vous Supprimer!');?>");
if (r == true) {
    var id=$(this).attr("id");
var liste=id;
$.ajax({
  type: "POST",
 url:"sm/languages/index/"+liste
}).done(function(result){
    $("#liste").html(result);
})
} else {  
}
})
$(".addnew").click(function(){
	$("#trnew").show()
	})
$("#cancelnew").click(function(){
	$("#trnew").hide()
})
	});
</script>


<div id="liste">

<div class="add-row-editable-table"><button class="btn btn-primary addnew" style="margin-left: -176px;" ><?php echo __("Add row")?></button></div>
<table class="table table-bordered table-hover table-condensed">
    <tr style="background: #2389c6;">
 
        	<th style="color: white;"><?php echo __('id'); ?></th>
			
			<th style="color: white;"><?php echo __('name'); ?></th>
			<th style="color: white;"><?php echo __('abbreviation'); ?></th>
		
			<th class="actions" style="color: white;"><?php echo __('Actions'); ?></th>
    </tr>
    
<?php $i=1; foreach ($languages as $Language): ?>
    <tr style="background: #2b3a41;">
        <td style="color: white;"><?php echo $i++; ?></td>
        <td>
        	<input type="text" class="form-control input-lg input_lg" disabled="disabled" value="<?php echo h($Language['Language']['name']); ?>" style="cursor: initial; color: white;" 
        	id="name<?php echo h($Language['Language']['id']); ?>">
        </td>
        
        	<td><input type="text" class="form-control input-lg input_lg" disabled="disabled" value="<?php echo h($Language['Language']['abbreviation']); ?>" style="cursor: initial; color: white;" 
        	id="abbrevation<?php echo h($Language['Language']['id']); ?>"></td>
       
        <td>
            <form editable-form="" name="rowform"  class="form-buttons form-inline" style="display:none" id="form<?php echo h($Language['Language']['id']); ?>">
            <button type="button" class="btn btn-primary editable-table-button btn-xs save" id="<?php echo h($Language['Language']['id']); ?>"><?php echo __("Save")?></button> 
            <button type="button"  class="btn btn-default editable-table-button btn-xs save" id="<?php echo h($Language['Language']['id']); ?>"><?php echo __("Cancel");?></button>
           </form>
            <div class="buttons" id="button<?php echo h($Language['Language']['id']); ?>">
            <button class="btn btn-primary editable-table-button btn-xs b_edit" id="<?php echo h($Language['Language']['id']); ?>" ><?php echo __("Edit")?></button> 
            <button class="btn btn-danger editable-table-button btn-xs delete_b" id="<?php echo h($Language['Language']['id']); ?>" ><?php echo __("Delete");?>
            </button>
        </div>
        </td>
    </tr>
    <?php endforeach; ?>
     <tr style="display:none" id="trnew">
        <td></td>
        <td>
        	<input type="text" class="form-control input-lg " id="inputnew" value="" style="cursor: initial;" ></td>
        	 <td>
        	<input type="text" class="form-control input-lg " id="inputnew2" value="" style="cursor: initial;" ></td>
        <td>
            <form editable-form="" name="rowform"  class="form-buttons form-inline" >
            <button type="button" class="btn btn-primary editable-table-button btn-xs savenew"><?php echo __("Save")?></button> 
            <button type="button"  class="btn btn-default editable-table-button btn-xs" id="cancelnew"><?php echo __("Cancel");?></button>
           </form>
        </td>
    </tr>
</table>

</div>


