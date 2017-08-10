<script type="text/javascript">
$(".panel-heading").click(function(){
	if($("#a"+$(this).attr('id')).is(":visible"))
	$("#a"+$(this).attr('id')).hide();
else
	$("#a"+$(this).attr('id')).show();
})


</script>
<style type="text/css">
.btnbtn{
    margin-top: -9px;
    margin-left: 32px;
        height: 31px;
}
</style>
 
<div class="outilTable">
  <div>
    <table>
<tr>
	<td class="btn btn-primary btnbtn">

	 <i id="Completed">
  	<?php echo __("Completed");?>
</i>
</td>
	<td class="btn btn-primary btnbtn">
	
	 <i id="Year">
  	<?php echo __("Year");?>
</i>
</td>
	<td class="btn btn-primary btnbtn">
 <i id="Trimester">
  	<?php echo __("Trimester");?>
</i>
</td>
	<td class="btn btn-primary btnbtn">
 <i id="Month">
  	<?php echo __("Month");?>
</i>
</td>
	<td class="btn btn-primary btnbtn">
 <i id="Week">
  	<?php echo __("Week");?>
</i>
</td>
	<td class="btn btn-primary btnbtn">
  <i id="Tomorrow">
  	<?php echo __("Tomorrow");?>
</i>
</td>
<td class="btn btn-primary btnbtn">
  <i id="Today"><?php echo __("Today");?>
</i>
</td>
<td class="btn btn-primary btnbtn">
  <i id="Urgent"><?php echo __("Urgent");?>
</i>
</td>
</tr>

</table>
</div></div>
 <div id="table_id">
 	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
 		<?php 

 		 foreach ($taches as $tache) 
 		 {
 		?>
 		
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="<?php echo $tache['Tach']['id'] ?>" style="background: #2389c6;cursor: pointer;">
      <h4 class="panel-title">
        
          <?php echo $tache['Tach']['titre'];?>
        
      </h4>
    </div>
    <div id="a<?php echo $tache['Tach']['id'] ?>" class="panel-collapse collapse in" role="tabpanel" style="display:none">
      <div class="panel-body">
       <?php echo $tache['Tach']['description']; ?>
      </div>
    </div>
  </div>
<?php } ?>

</div>
</div>
</div>