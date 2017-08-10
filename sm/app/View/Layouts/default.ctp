	
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js">
  
	<?php 
 echo $this->Html->css('overhang.min');
        echo $this->Html->script('overhang.min');
        
	echo $this->Html->charset('ISO-8859-1');          
	  echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

		echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
       
		echo $this->Html->script('jquery.min'); 
		echo $this->Html->script('slider.module'); 
		?>
	
	
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		
        echo $this->Html->css('main');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		// echo $this->Html->script('date_heure');

	?>
<?php echo $this->Html->css('jquery-te-1.4.0');?>
<?php echo $this->Html->script('jquery-te-1.4.0');?>




<script type="text/javascript">
$(document).ready(function() {
$('#imgprofile').live('click',function(){

if($('#panelProfile').is(':visible'))
{
$('#panelProfile').hide("blind");
}
else
{
  $('#panelProfile').slideDown("show");
}
});
$('#openMenuBar').live('click',function(){

if($('#MenuBar').is(':visible'))
{
$('#MenuBar').hide("show");
}
else
{
  $('#MenuBar').slideDown("slide");
}
});

/////////////////// notification


$("#notificationLink").click(function()
{
$("#notificationContainer").fadeToggle(300);
$("#messageContainer").hide();
$("#notification_count").fadeOut("slow");
return false;
});

$(document).click(function()
{
$("#notificationContainer").hide();
});

$("#notificationContainer").click(function()
{
return false;
});
$("#mesaageLink").click(function()
{
$("#messageContainer").fadeToggle(300);
$("#notificationContainer").hide();
$("#notification_count").fadeOut("slow");
return false;
});

$(document).click(function()
{
$("#messageContainer").hide();
});

$("#messageContainer").click(function()
{
return false;
});
/////////////////
$("#closeMessage").click(function()
{
	$("#messagediv").hide();
});

$("#name_profile").click(function()
{
	if($('#messagedetail').is(':visible'))
{
     $("#messagedetail").hide();
	$("#openMessageDetaile").css('bottom','0px'); 
	$("#closeMessage").show();
	$("#closeMessage").css({"position":"fixed","margin-left": "193px","margin-top":"-6px"}); 
}
else
{
	$("#messagedetail").show();
	$("#openMessageDetaile").css('bottom','270px'); 
	$("#closeMessage").hide();

var id_profile=$("#id_profile").val();
var liste=Array(id_profile,"message");
$.ajax({
  type: "POST",
  url:<?php echo $this->webroot ; ?>+"/messages/add/"+liste
}).done(function(result) {
     $('#messagedetail').html(result);

 });
 }
});





});
refresh();
message()
function refresh()
{	
	$.ajax({
  type: "POST",
  url:<?php echo $this->webroot ; ?>+"/actions/index/"
}).done(function(result) {
     $('#notificationContainer').html(result);
 });
}
function message()
{
	$.ajax({
  type: "POST",
  url:<?php echo $this->webroot ; ?>+"/messages/index/"
}).done(function(result) {
     $('#messageContainer').html(result);
 });
}
setInterval(function(){refresh()}, 300000);
setInterval(function(){message()}, 3000000);
</script>




<div id="content" class="content">
<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
	