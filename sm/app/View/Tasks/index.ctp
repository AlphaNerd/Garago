

<script type="text/javascript">
$(document).ready(function() {
$(".b_edit").click(function(){
	var id=$(this).attr("id");
$("#button"+id).hide();
$("#form"+id).show();
$("#name"+id).prop( "disabled", false );
$("#name"+id).select()
$("#price"+id).prop( "disabled", false );
$("#price"+id).select()
$("#description"+id).prop( "disabled", false );
$("#description"+id).select()
})
$(".save").click(function(){
	var id=$(this).attr("id");
$("#button"+id).show();
$("#form"+id).hide();
var liste=id+",-,"+$("#name"+id).val()+",-,"+$("#price"+id).val()+",-,"+$("#description"+id).val();
$.ajax({
  type: "POST",
 url:"index/"+liste
}).done(function(result){
	$("#liste").html(result);
})
$("#price"+id).prop( "disabled", true );
$("#name"+id).prop( "disabled", true );
$("#description"+id).prop( "disabled", true );
});

$(".savenew").click(function(){
var liste=$("#inputnew").val()+",-,"+$("#inputnew1").val()+",-,"+$("#inputnew2").val();
alert(liste);
$.ajax({
  type: "POST",
 url:"index/"+liste
}).done(function(result){
	$("#liste").html(result);
});});
$(".delete_b").click(function(){
var r = confirm("<?php echo __('Avez-vous Supprimer!');?>");
if (r == true) {
    var id=$(this).attr("id");
var liste=id;
alert(liste);
$.ajax({
  type: "POST",
 url:"index/"+liste
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
<div class="add-row-editable-table"><button class="btn btn-primary addnew" style="margin-left: -176px;"><?php echo __("Add row")?></button></div>
<table class="table table-bordered table-hover table-condensed">
    <tr style="background: #2389c6;">
 
        	<th style="color: white;"><?php echo __('id'); ?></th>
			
	        <th style="color: white;"><?php echo __('Description'); ?></th>
			<th style="color: white;"><?php echo __('references'); ?></th>
			<th style="color: white;"><?php echo __('Task'); ?></th>
		
			<th class="actions" style="color: white;"><?php echo __('Actions'); ?></th>
    </tr>
    
<?php $i=1; foreach ($Tasks as $Task): ?>
    <tr style="background: #2b3a41;">
        <td style="color: white;"><?php echo $i++; ?></td>
        <td>
        	<input type="text" class="form-control input-lg input_lg" disabled="disabled" value="<?php echo h($Task['Task']['description']); ?>" style="cursor: initial; color: white;" 
        	id="description<?php echo h($Task['Task']['id']); ?>">
        </td>
        <td>
        	<input type="text" class="form-control input-lg input_lg" disabled="disabled" value="<?php echo h($Task['Task']['references']); ?>" style="cursor: initial; color: white;" 
        	id="references<?php echo h($Task['Task']['id']); ?>">
        </td>
        <td>
        <select class="form-control input-lg input_lg" style="cursor: initial; color: white;" disabled="disabled"
        	id="item<?php echo h($Task['Task']['id']); ?>">
        	<?php foreach ($items as $Item) {
        	?>
        	 <option Value="<?php echo $Item['Item']['id'];?>" <?php if($Item['Item']['id']==$Task['Task']['item_id']) echo "selected='selected'";?>">
        	<?php echo $Item['Item']['name']; ?>
        </option>
        	<?php
        	} ?>
        </select>
        </td>
        <td>
            <form editable-form="" name="rowform"  class="form-buttons form-inline" style="display:none" id="form<?php echo h($Task['Task']['id']); ?>">
            <button type="button" class="btn btn-primary editable-table-button btn-xs save" id="<?php echo h($Task['Task']['id']); ?>"><?php echo __("Save")?></button> 
            <button type="button"  class="btn btn-default editable-table-button btn-xs save" id="<?php echo h($Task['Task']['id']); ?>"><?php echo __("Cancel");?></button>
           </form>
            <div class="buttons" id="button<?php echo h($Task['Task']['id']); ?>">
            <button class="btn btn-primary editable-table-button btn-xs b_edit" id="<?php echo h($Task['Task']['id']); ?>" ><?php echo __("Edit")?></button> 
            <button class="btn btn-danger editable-table-button btn-xs delete_b" id="<?php echo h($Task['Task']['id']); ?>" ><?php echo __("Delete");?>
            </button>
        </div>
        </td>
    </tr>
    <?php endforeach; ?>
     <tr style="display:none" id="trnew">
        <td></td>
        <td><input type="text" class="form-control input-lg " id="inputnew" value="" style="cursor: initial;" ></td>
         <td><input type="text" class="form-control input-lg " id="inputnew1" value="" style="cursor: initial;" ></td>
         <td><select class="form-control input-lg " id="inputnew2" value="" style="cursor: initial;">
        	<?php foreach ($items as $Item) {
        	?>
        	 <option Value="<?php echo $Item['Item']['id']; ?>">
        	<?php echo $Item['Item']['name']; ?>
        </option>
        	<?php
        	} ?>
        </select>
         </td>
        <td>
            <form editable-form="" name="rowform"  class="form-buttons form-inline" >
            <button type="button" class="btn btn-primary editable-table-button btn-xs savenew"><?php echo __("Save")?></button> 
            <button type="button"  class="btn btn-default editable-table-button btn-xs" id="cancelnew"><?php echo __("Cancel");?></button>
           </form>
        </td>
       </tr>
    </table>
</div>