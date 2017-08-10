<script type="text/javascript">
$(document).ready(function() {
$(".onoffswitchonoff-checkbox").on('change',function(){
	var x=$(this).is(":checked")
	if(x==true)
$("#inputpricetotal").val(Number($("#inputpricetotal").val())+Number($(this).attr('price')));
else
$("#inputpricetotal").val(Number($("#inputpricetotal").val())-Number($(this).attr('price')));
});
$(".submit").click(function(){
	var liste=$("#name").val();
	liste+=",-,"+$("#inputpricetotal").val()+",-,"+$("#description").val()+",-,"+$("#periode").val();
	var itemliste="";
$('.listeitem').find('.onoffswitchonoff-checkbox').each(function(i,li){
	x=$(this).is(":checked")
	if(x)
	itemliste=itemliste+','+$(this).attr('itemID');
})
liste=liste+",-,"+itemliste;
$.ajax({
   type: "POST",
  url:"sm/offers/index/"+liste
 }).done(function(result) {
alert(result)
  });
})
})
</script>
<div style=" display: flex;">
<?php 
foreach ($Regulations as $regulation)
{
?>

<table class="pricing-table1" style="width: 200px; border: nones;">	
<tr>
<td colspan="2">
<div class="title">
	<?php echo $regulation['Regulation']['name'] ?>
</div></td>
</td>
<tr><td colspan="2" style=" background: none repeat scroll 0 0 #fff;"><span>$</span><div class="price"><?php echo $regulation['Regulation']['total_price'] ?><span style="font-size: x-large;font-family: monospace;color: rgba(0, 0, 255, 0.41);">/<?php if($regulation['Regulation']['period']!=12){echo $regulation['Regulation']['period'] ?><?php echo __(".month");}else echo __("Year");?></span></div></td></tr>
<tr>
	<td colspan="2"><span>•
<?php echo $regulation['Regulation']['description'];?>
</span>
</td>
</tr>
<?php 
foreach ($offers as $offer)
  if($regulation['Regulation']['id']==$offer['Offer']['regulation_id'])
  {
   foreach ($Items as $item) 
	if($item['Item']['id']==$offer['Offer']['items_id'])
	{
	?>
	<tr>
<td style=" padding: 15px 0;"><b class="dim">•</b><?php echo $item['Item']['name'] ?></td>
</tr>
<?php } 
}
?>

<tr><td colspan="2"><a class="btn btn-default submit" href="#">Sign Up</a></td></tr>
</table>

<?php }?>
	<table class="table listeitem"style="width: 200px;border: none;background: rgba(42, 65, 76, 0.45);">	
<tr>
<td colspan="2"><input class="form-control" id="name" placeholder="Enter your name of offers"></td>
</tr><tr>
<td colspan="2">
	<div class="divbudget" id="4-2">
   <div class="input-group ng-scope" style="margin-top: 4px;">
   	<span class="input-group-addon addon-left input-group-addon-success">$</span>
   	<input type="number" class="form-control with-success-addon" id="inputpricetotal"  placeholder="00"> <span class="input-group-addon addon-right input-group-addon-success">.00</span></div>
	</div>
</td>
</tr>
<tr>
<td colspan="2">
	<select id="periode" class="form-control">
<?php for ($i=1; $i <13; $i++) { 
	?>
<option value="<?php echo $i ?>"><?php echo $i.__("month"); ?></option>

	<?php 
} ?>
	</select>
<input class="form-control" placeholder="15 day trial lite version" id="description">
</td>
</tr>

<?php 
foreach ($Items as $item) {
	?>
	<tr>
		<td>
<?php echo $item['Item']['name'] ?>
</td><td>
<div class="onoffswitchonoff">
    <input type="checkbox" name="onoffswitch<?php echo $item['Item']['id']?>" itemID="<?php echo $item['Item']['id']?>" class="onoffswitchonoff-checkbox" id="myonoffswitch<?php echo $item['Item']['id']?>" price="<?php echo $item['Item']['price']?>">
    <label class="onoffswitchonoff-label" for="myonoffswitch<?php echo $item['Item']['id']?>"></label>
</div>
</td>
</tr>
<?php } ?>
<tr>
<td colspan="2">
	<button type="button" class="btn btn-default submit"><?php echo __("Creat new Offer") ?></button>
</td>
</tr>
</table>
</div>
