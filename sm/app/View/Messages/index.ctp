<script type="text/javascript">

$("#openmessageDiv").click(function()
{
	var nameprofile=$("#nameProfile").text();
$("#messagediv").show();
$("#name_profile").text(nameprofile);
$("#id_profile").val($("#id_profile_Social").val());
});

</script>
<div class="notificationTitle">Notifications</div>
<div class="notificationsBody notifications">
	<ul>
	<?php foreach ($tab as $action) {
		
?>
<input type="hidden" value="<?php echo $action['profile']['SocialProfiles']['user_id'] ?>" id="id_profile_Social">
	<li id="openmessageDiv">
<div class="col-md-2" style="padding-left: 0px;">
<img src="/smartsearch/img/profile/<?php echo $action['profile']['SocialProfiles']['picture'];?>">

</div>
<div  class="col-md-10 notificationsdiv">
	<i id="nameProfile"><?php echo $action['profile']['SocialProfiles']['display_name'];?></i>

<?php echo substr($action['description'], 0,200);?>  <?php echo $action['date_message'];?>.....
</div><div ><i class="fa fa-ellipsis-h" aria-hidden="true"style="cursor: pointer;color: darkturquoise;"></i></div>
</li>
<?php
	}
	?>
</ul>
</div>
<div class="notificationFooter"><a href="#">See All</a></div>
