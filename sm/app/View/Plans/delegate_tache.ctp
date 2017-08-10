  <?php echo $this->Html->css('jquery-te-1.4.0');?>
<?php echo $this->Html->script('jquery-te-1.4.0');?>
<script type="text/javascript">
$('.fa-times').click(function(){
 $(this).parent().hide();
  $("#refersh").show();
  $("#outiltable").show();
  $(".barre_Tache_projet").show();
});
$("#save").click(function(){
	$(this).hide();
	$("#message").find('.jqte_editor').text($("#message").find('.jqte_editor').text()+$(".link").text())
})
$(".glyphicon-remove").click(function(){
	$(".link").hide();
	$("#save").show()
	$(this).hide();
})
$("#send").click(function(){
$("#refersh").show();
	$(this).parent().hide();
	$("#outiltable").show();
	 $(".barre_Tache_projet").show();
})
$('.jqte-test').jqte();
  
  // settings of status
  var jqteStatus = true;
  $(".status").click(function()
  { 
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({"status" : jqteStatus})
  });
   $(".jqte_editor").focus(function(){	
$(this).parent().find(".jqte_toolbar").show();
});
   $(".jqte_editor").focusout(function(){	
$(this).parent().find(".jqte_toolbar").hide();
});
    $('.verif-email').focusout(function(){
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailblockReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $(this).val();
         
        if(emailaddressVal == '') {
            $('.error').text('Le champs est vide.');
        } else if(!emailReg.test(emailaddressVal)) {
            $('.error').text('Ce n\'est pas une adresse email');
        } else if(!emailblockReg.test(emailaddressVal)) {
            $('.error').text('N\'utilisez pas votre adresse hotmail ! GRRR');
        } else {
            $('.error').text('');
        }
    });
</script>
<form action="." method="POST">
<div class="auth-block2" >
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="table-responsive" style="background: rgba(255, 255, 255, 0.8);">
<div class="col-md-10 contact" >
<input  name="verif-email" list="users" class="form-control verif-email" placeholder="<?php echo __('Email');?>">
<span class="error"></span>
</div>
<div class="col-md-10 contact" >
<input  name="name"  class="form-control " placeholder="<?php echo __('name');?>"required>
</div>
<div class="composantVertical col-md-10" id="message" style="resize: both;background: white;">
<div class=" jqte-test">

 <?php echo __("Message...");?>
</div>
</div>

<div class="col-md-12 link qte-test"  style="display:none; color:#0000ff">
	<div class="col-md-3">SHARED WITH</div>
	<div class="col-md-7"><?php echo $link; ?></div>
	<div class="col-md-2"><i class="glyphicon glyphicon-remove"></i></div>
</div>
<button class="btn1212"style="width: 200px;" id="save">CREATE LINK</button>
</div>
<button type="submit" class="btn1212"style="float: right;width: 200px;" id="send">SEND</button>
</div>
</form>
<datalist id="users">
  <?php foreach ($users as $user) {
	?>
<option value="<?php echo $user['User']['email'] ?>">
	</option>
<?php
} ?>
   </datalist>