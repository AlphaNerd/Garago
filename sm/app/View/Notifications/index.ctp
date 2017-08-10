
		echo "<pre>";
	print_r($tab);
	echo "</pre>";


<div class="notificationTitle">Notifications</div>
<div class="notificationsBody notifications">
	<ul>
	<?php foreach ($notifications as $notification) {
		foreach ($profiles as $socialprofile) 
			if($socialprofile['SocialProfiles']['user_id']==$notification['Notification']['id_profile_send'])
			{
?>
	<li>
<div class="col-md-2" style="padding-left: 0px;">

<img src="/smartsearch/img/profile/<?php echo $socialprofile['SocialProfiles']['picture'];?>">
</div>
<div  class="col-md-10 notificationsdiv"><font color="black" size="3"><?php echo $socialprofile['SocialProfiles']['display_name'];?></font><?php echo $notification['Notification']['description'];?></div>
</li>

<?php
	}	}?>
</ul>
</div>
<div class="notificationFooter"><a href="#">See All</a></div>