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
<tr><td colspan="2" style=" background: none repeat scroll 0 0 #fff;"><span>$</span><div class="price"><?php echo $regulation['Regulation']['total_price'] ?><span style="font-size: x-large;font-family: monospace;color: rgba(0, 0, 255, 0.41);">/<?php echo $regulation['Regulation']['period'] ?><?php echo __("month");?></span></div></td></tr>
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

<tr><td colspan="2"><a class="btn btn-default submit" href="sm/PersonalOffers/subscribe/<?php echo $regulation['Regulation']['id']?>">Sign Up</a></td></tr>
</table>

<?php }?>
</div>
<div style=" margin-left: -110px;">
<hr>
<div class="col-md-4 col-md">
<div class="extra" ><span>User</span><b>PER ADDITIONAL USER</b></div>
<div class="prixExtra">$4.99/month</div>
<div></div>


</div>
<div class="col-md-4 col-md">
<div class="extra"><span>Plan</span><b>PER ADDITIONAL PLAN</b></div>
<div class="prixExtra">$57/year</div>
<div></div>


</div>

<div class="col-md-4 col-md">
<div class="extra"><span>FORM</span><b>PER ADDITIONAL FORM</b></div>
<div class="prixExtra">97$/year</div>
<div></div>
</div>
</div>

