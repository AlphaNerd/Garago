<div class="notificationTitle">Notifications</div>
<div class="notificationsBody notifications">
	<ul>
	<?php foreach ($tab as $action) {
		
?>
	<li>
<div class="col-md-2" style="padding-left: 0px;">

<img src="/smartsearch/img/profile/<?php echo $action['profile']['SocialProfiles']['picture'];?>">
</div>
<div  class="col-md-10 notificationsdiv"><a href="">
	<?php echo $action['profile']['SocialProfiles']['display_name'];?></a>    <?php echo $action['type'];?> le document <a href=""><?php echo $action['document']['name'] ?></a> a <?php echo $action['date_action'];?> </div>
</li>

<?php
	}
	?>
</ul>
</div>
<div class="notificationFooter"><a href="#">See All</a></div>