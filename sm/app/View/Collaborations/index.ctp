<script type="text/javascript">

$(document).ready(function() {

 $.ajax({
  type: "POST",
  url:"sm/collaborations/task/"
}).done(function(result) {

     $("#table_id").html(result);
 });
$("#Project").on('change',function(){
	liste=Array('Project',$(this).val())
	 $.ajax({
  type: "POST",
  url:"sm/collaborations/task/"+liste
}).done(function(result) {

     $("#table_id").html(result);
 });
})
///////////////////
// $("#Plan").on('change',function(){
// 	liste=Array('Plan',$(this).val())
// 	 $.ajax({
//   type: "POST",
//   url:"sm/collaborations/task/"+liste
// }).done(function(result) {

//      $("#table_id").html(result);
//  });
// })

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
</style>
  <div class=" divPlanTable" style="margin-left: -110px;float: left;">
<div class="outilTable" >
  <div>
    <table >
<tr>
<td class="btn btn-primary btnbtn">
	<select>
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
	<select  id="Plan">

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
 <div id="table_id22">
 	<div>
</div>
<div>
<table class=" table table-striped"style="margin-left: 0px;">
<thead>
<tr>
<th><?php echo __("Date");?>
</th>
<th><?php echo __("Name");?>
</th>
<th><?php echo __("From");?>
</th>
<th><?php echo __("Cell");?>
</th>
<th><?php echo __("Organization");?>
</th>
<th><?php echo __("Comment");?>
</th>
<th><?php echo __("Option");?>
</th>
</tr>
</thead>
<tbody>
<?php foreach ($comments as $comment) {?>
<tr>
<td><?php echo $comment['Comment']['date_send']; ?></td>
<td><?php echo $comment['Comment']['name']; ?></td>
<td><?php echo $comment['Comment']['email_send']; ?></td>
<td><?php echo $comment['Comment']['ref_cellule']; ?></td>
<td><?php echo $comment['Comment']['organization']; ?></td>
<td><?php echo $comment['Comment']['message']; ?></td>
<td><i class="fa fa-trash" aria-hidden="true"></i>

<a href="mailto:waqas@ezzylearning.com">
	<i class="fa fa-share-square-o" aria-hidden="true"></i></a>
<i class="fa fa-heart" aria-hidden="true"></i></td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</div>
</div>