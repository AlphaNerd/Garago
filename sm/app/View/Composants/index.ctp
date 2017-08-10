
<script type="text/javascript">
$(document).ready(function() {
$(".b_edit").click(function(){
	var id=$(this).attr("id");
$("#button"+id).hide();
$("#form"+id).show();
$("#titre"+id).prop( "disabled", false );
$("#titre"+id).select()
$("#type"+id).prop( "disabled", false );
$("#type"+id).select();
$("#description"+id).prop( "disabled", false );
$("#description"+id).select();
$("#language"+id).prop( "disabled", false );
$("#Sectors"+id).prop( "disabled", false );
$("#Customers"+id).prop( "disabled", false );
$("#Categorys"+id).prop( "disabled", false );
})
$(".save").click(function(){
	var id=$(this).attr("id");
$("#button"+id).show();
$("#form"+id).hide();

var id_language=$("#language"+id).val();
var id_sectors=$("#Sectors"+id).val();
var id_customers=$("#Customers"+id).val();
var id_categorie=$("#Categorys"+id).val();
var titre=$("#titre"+id).val();
var type=$("#type"+id).val();
var description=$("#description"+id).val();
var liste=id+",-,"+titre+",-,"+type+",-,"+description+",-,"+id_language+",-,"+id_sectors+",-,"+id_customers+",-,"+id_categorie;
$.ajax({
  type: "POST",
 url:"sm/composants/index/"+liste
}).done(function(result){
	$("#liste").html(result);
})
$("#titre"+id).prop( "disabled", true );
$("#type"+id).prop( "disabled", true );
$("#description"+id).prop( "disabled", true );
$("#language"+id).prop( "disabled", true );
$("#Sectors"+id).prop( "disabled", true );
$("#Customers"+id).prop( "disabled", true );
$("#Categorys"+id).prop( "disabled", true );
});

$(".savenew").click(function(){
var id_language=$("#language0").val();
var id_sectors=$("#Sectors0").val();
var id_customers=$("#Customers0").val();
var id_categorie=$("#Categorys0").val();
var titre=$("#titre0").val();
var type=$("#type0").val();
var description=$("#description0").val();
alert(description)
var liste=titre+",-,"+type+",-,"+description+",-,"+id_language+",-,"+id_sectors+",-,"+id_customers+",-,"+id_categorie;
alert(liste)
$.ajax({
  type: "POST",
 url:"sm/composants/index/"+liste
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
 url:"sm/composants/index/"+liste
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
   <?php echo $this->Html->script('multiple-select.js'); ?>
   <script>
        $('.selectmultiple').multipleSelect();
    </script>
<?php echo $this->Html->css('multiple-select'); ?>
<div id="liste">
<div class="add-row-editable-table"><button class="btn btn-primary addnew" style="margin-left: -176px;" ><?php echo __("Add row")?></button></div>
<table class="table table-bordered table-hover table-condensed">
    <tr  style="background: #2389c6;">
 
        	<th style="color: white;"><?php echo __('id'); ?></th>		
	       <th  style="color: white;"><?php echo __('titre'); ?></th>
			<th  style="color: white;"><?php echo __('description'); ?></th>
			<th  style="color: white;"><?php echo __('type'); ?></th>
			<th  style="color: white;"><?php echo __('Language'); ?></th>
			<th  style="color: white;"><?php echo __('Sectors'); ?></th>
			<th  style="color: white;"><?php echo __('Clientels'); ?></th>
			<th  style="color: white;"><?php echo __('Category'); ?></th>
			<th class="actions"  style="color: white;"><?php echo __('Actions'); ?></th>
    </tr>
    
<?php $i=1; foreach ($composants as $Composant): ?>
    <tr  style="background: #2b3a41;">
        <td  style="color: white;"><?php echo $i++; ?></td>
        <td>
        	<input type="text" class="form-control input-lg input_lg" disabled="disabled" value="<?php echo h($Composant['Composant']['titre']); ?>" style="cursor: initial; color: white;" 
        	id="titre<?php echo h($Composant['Composant']['id']); ?>">
        </td>
        <td>
        	<textarea  class="form-control input-lg input_lg" disabled="disabled" style="cursor: initial; color: white; margin: 0px;width: 193px;height: 46px;padding: 0px;"
        	id="description<?php echo h($Composant['Composant']['id']); ?>">
            <?php echo h($Composant['Composant']['description']); ?>
        </textarea>
        </td>
        <td>
   <select  class="input_lg" id="type<?php echo h($Composant['Composant']['id']); ?>"style="background: rgba(4, 4, 4, 0.27); height: 46px;border: 0px;border-radius: 4px;">
    <option>
        <?php foreach ($TypeComponents as $value ) {
        if( $value['TypeComponent']['id']==h($Composant['Composant']['type_id']))
   echo $value['TypeComponent']['description'];
  } ?>
    </option>
  <?php foreach ($TypeComponents as $value ) {
      ?>
<option><?php echo $value['TypeComponent']['description'];?></option>


      <?php 
  } ?>

   </select>
        	
        </td>
       <td>
        	<select multiple="multiple" class="input_lg selectmultiple" id="language<?php echo h($Composant['Composant']['id']); ?>"  placeholder="Enter your name"  style="cursor: initial;">
        <?php $Languges1=$Languges;foreach ($Languges as $language) {
        	?>
        	<option value="<?php echo $language['Language']['id'];?>"><?php echo $language['Language']['name'];?></option>
      <?php  } ?>
        
    </select>
    
        </td>
        <td>
        	<select multiple="multiple" class="input_lg selectmultiple" id="Sectors<?php echo h($Composant['Composant']['id']); ?>"   style="cursor: initial;">
        <?php $Sectors1=$Sectors; foreach ($Sectors as $sector) {
        	?>
        	<option value="<?php echo $sector['Sector']['id'];?>"><?php echo $sector['Sector']['description'];?></option>
      <?php  } ?>
        
    </select>
     
        </td>
       <td>
        	<select multiple="multiple" class="input_lg selectmultiple" id="Customers<?php echo h($Composant['Composant']['id']); ?>"    style="cursor: initial;">
        <?php $Customers1=$Customers ;foreach ($Customers as $customer) {
        	?>
        	<option value="<?php echo $customer['Customer']['id'];?>"><?php echo $customer['Customer']['description'];?></option>
      <?php  } ?>
        
    </select>
  
 
        </td>
         <td>
        
        	<select multiple="multiple" class="input_lg selectmultiple" id="Categorys<?php echo h($Composant['Composant']['id']); ?>"   style="cursor: initial;">
        <?php $Categorys1=$Categorys; foreach ($Categorys as $categorie) {
        	?>
        	<option value="<?php echo $categorie['Category']['id'];?>"><?php echo $categorie['Category']['description'];?></option>
      <?php  } ?>
        
    </select>

        </td>
       
        <td>
            <form editable-form="" name="rowform"  class="form-buttons form-inline" style="display:none" id="form<?php echo h($Composant['Composant']['id']); ?>">
            <button type="button" class="btn btn-primary editable-table-button btn-xs save" id="<?php echo h($Composant['Composant']['id']); ?>"><?php echo __("Save")?></button> 
            <button type="button"  class="btn btn-default editable-table-button btn-xs save" id="<?php echo h($Composant['Composant']['id']); ?>"><?php echo __("Cancel");?></button>
           </form>
            <div class="buttons" id="button<?php echo h($Composant['Composant']['id']); ?>">
            <button class="btn btn-primary editable-table-button btn-xs b_edit" id="<?php echo h($Composant['Composant']['id']); ?>" ><?php echo __("Edit")?></button> 
            <button class="btn btn-danger editable-table-button btn-xs delete_b" id="<?php echo h($Composant['Composant']['id']); ?>" ><?php echo __("Delete");?>
            </button>
        </div>
        </td>
    </tr>
    <?php endforeach; ?>
     <tr style="display:none2" id="trnew">
        <td></td>
          <td>
        	<input type="text" class="form-control input-lg input_lg"  value="" style="cursor: initial; color: white;" id="titre0">
        </td>
        <td>
        	<textarea class="form-control input-lg input_lg" required style="margin: 0px; color: white; width: 193px;height: 46px;padding: 0px;" id="description0">
           
        </textarea>
        </td>
        <td>

        	
<select  class="input_lg" id="type0"style="background: rgba(4, 4, 4, 0.27); height: 46px;border: 0px;border-radius: 4px;">

             <?php foreach ($TypeComponents as $value ) {
      ?>
<option><?php echo $value['TypeComponent']['description'];?></option>


      <?php 
  } ?>

   </select>
        </td>
          <td>
        
        	<select multiple="multiple" class="input_lg selectmultiple" id="language0"   style="display:block"   style="cursor: initial;">
        <?php foreach ($Languges1 as $language) {
        	?>
        	<option value="<?php echo $language['Language']['id'];?>"><?php echo $language['Language']['name'];?></option>
      <?php  } ?>
        
    </select>
    
        </td>
        <td>
        	<select multiple="multiple" class="input_lg selectmultiple" id="Sectors0" style="display:block"   style="cursor: initial;">
        <?php foreach ($Sectors1 as $sector) {
        	?>
        	<option value="<?php echo $sector['Sector']['id'];?>"><?php echo $sector['Sector']['description'];?></option>
      <?php  } ?>
        
    </select>
     
        </td>
       <td>
        	<select multiple="multiple" class="input_lg selectmultiple" id="Customers0"    style="cursor: initial;">
        <?php foreach ($Customers1 as $customer) {
        	?>
        	<option value="<?php echo $customer['Customer']['id'];?>"><?php echo $customer['Customer']['description'];?></option>
      <?php  } ?>
        
    </select>
  
 
        </td>
         <td>
        
        	<select multiple="multiple" class="input_lg selectmultiple" id="Categorys0"   style="cursor: initial;">
        <?php foreach ($Categorys1 as $categorie) {
        	?>
        	<option value="<?php echo $categorie['Category']['id'];?>"><?php echo $categorie['Category']['description'];?></option>
      <?php  } ?>
        
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