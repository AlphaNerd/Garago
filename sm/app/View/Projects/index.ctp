<script type="text/javascript">

$(document).ready(function() {

 $.ajax({
  type: "POST",
  url:"sm/projects/task/"
}).done(function(result) {

     $("#table_id").html(result);
 });
$("#Project").on('change',function(){
	liste=Array('Project',$(this).val())
	 $.ajax({
  type: "POST",
  url:"sm/projects/task/"+liste
}).done(function(result) {

     $("#table_id").html(result);
 });
})
///////////////////
$("#Plan").on('change',function(){
	liste=Array('Plan',$(this).val())
	 $.ajax({
  type: "POST",
  url:"sm/projects/task/"+liste
}).done(function(result) {

     $("#table_id").html(result);
 });
})


});
</script>
<style type="text/css">
.btnbtn{
    margin-top: -9px;
    margin-left: 32px;
    height: 31px;
    padding: 0px;
}
.btnbtn>select{
	background: #337ab7;
    color: white;
    border: none;
    padding: 7px;
}
.btnbtn>i{
padding: 6px 12px;	
}
</style>
  <div class=" divPlanTable" style="margin-left: -110px;float: left;">
<div class="outilTable" >
  <div>
    <table >
<tr>
<td class="btn btn-primary btnbtn">
  <i><?php echo __("Gantt Chart");?>
</i>
</td><td class="btn btn-primary btnbtn">
  <i ><?php echo __("Report");?>
</i>
</td><td class="btn btn-primary btnbtn">
  <i  class="recording"><?php echo __("Tasks");?>
</i></td>
<td class="btn btn-primary btnbtn">
	<select  >
		<?php foreach ($users as $user) { ?>
<option value="<?php echo $user['User']['id']; ?>">
	<?php echo explode('_',$user['User']['username'])[0].' '.explode('_',$user['User']['username'])[1]; ?>
</option>
		<?php }?></select>
</td>
<td class="btn btn-primary btnbtn">
	<select id="Group">
		<?php foreach ($groupes as $groupe) { ?>
<option value="<?php echo $groupe['Group']['id']; ?>">
	<?php echo $groupe['Group']['name']; ?>
</option>
		<?php }?></select>
</td>
<td class="btn btn-primary btnbtn">
	<select  id="Task">
		<?php foreach ($taches as $tache) { ?>
<option value="<?php echo $tache['Tach']['id']; ?>">
	<?php echo $tache['Tach']['titre']; ?>
</option>
		<?php }?></select>
	

</td>
<td class="btn btn-primary btnbtn">
	<select  id="Project">

		<?php foreach ($projects as $project) { ?>
<option value="<?php echo $project['Project']['id']; ?>">
	<?php echo $project['Project']['titre']; ?>
</option>

		<?php }?></select>
	

</td>
<td class="btn btn-primary btnbtn">
	<select id="Plan">

		<?php foreach ($plans as $plan) { ?>
<option value="<?php echo $plan['Plan']['id']; ?>">
	<?php echo $plan['Plan']['titre']; ?>
</option>

		<?php }?></select>
	

</td>
</tr>

</table>
</div>
  </div>
 <div id="table_id">
</div>
</div>