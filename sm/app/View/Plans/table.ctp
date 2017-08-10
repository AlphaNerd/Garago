 <?php 
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
    echo $this->Html->css('main');
    ?>
    <?php echo $this->Html->css('jquery-te-1.4.0');?>
<?php echo $this->Html->script('jquery-te-1.4.0');?>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" type="text/javascript"></script>
  <?php 
      echo $this->Html->css('evol-colorpicker');
      echo $this->Html->script('evol-colorpicker'); 
  ?>
   <?php
echo $this->Html->script('RowSorter');

     ?>
 <?php 
 echo $this->Html->script('colResizable-1.6');
 ?>

<script type="text/javascript">
function printDiv(maydiv) {
     var printContents = document.getElementById(maydiv).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
  
     document.body.innerHTML = originalContents;
window.close();
}
$(document).ready(function() {
  setInterval(function(){refresh()}, 500);
  mise("ligne");

function refresh(){
   if($("#refersh").is(':visible'))
  {
  var coordonners=$("#NBRCOLONE").val();
 $.ajax({
  type: "POST",
  url:"sm/plans/tableau/"+coordonners
}).done(function(result) {
     $("#table_id").html(result);
 });
 $("#refersh").hide();
}
}

//   $(".fa-refresh").click(function (){
// refresh();
//   });

  function mise(type)
  { 
    ligne=-1;
      colone=-1;
 $('#example').find('tr').each(function(il,el) {
ligne++;
 });
  $('#example').find('th').each(function(il,el) {
colone++;
 });
  if(type=="colone")
  {
    colone+=1;
  }
    
  else{
    ligne+=1;
  }
    
  var coordonner=Array(ligne,colone);
    $.ajax({
  type: "POST",
  url:"sm/plans/tableau/"+coordonner
}).done(function(result) {
     $("#table_id").html(result);
 });

  }
mise("ligne");

    $(".glyphicon-text-size").click(function(){
       if($("#slider1").is(':visible'))
        $("#slider1").hide();
      else
      $("#slider1").show();
    })
    $( "#slider" ).slider({
      range: "max",
      min: 8,
      max: 32,
      value: 12,
      slide: function( event, ui ) {
        $( "#font" ).text( ui.value );
          $('#example').css( "font-size",ui.value+"px" );
      }
    });

var color;
 $('.cp2').colorpicker({
  })
    .on('change.color', function(evt, color){
      ligne=-1;
      colone=-1;
 $('#example').find('tr').each(function(il,el) {
ligne++;
 });
  $('#example').find('th').each(function(il,el) {
colone++;
 });
         colors=$(this).val();
       colors=colors.substring(1);
          $("#example").css('background-color',color);
var coordonners=ligne+","+colone;
alert(coordonners)
          var liste=Array("0,0",colors,coordonners);
          alert(liste)
         $.ajax({
         type: "POST",
         url:"sm/plans/colors/"+liste
      })
         $("#refersh").show();
    })
    .on('mouseover.color', function(evt, color){
            if(color){
                $("#example").css('background-color',color);
              
            }
    });
$(".partage").click(function(){
   if($(".checkbox").is(':visible'))
  $(".checkbox").hide();
else
  $(".checkbox").show();
})

$(".blockage").click(function(){
  var liste;
  if($(".fa-unlock-alt").is(':visible'))
  {
    $(".fa-unlock-alt").hide();
    $(".fa-unlock").show(); 
liste="block"   
  }else
  {
    $(".fa-unlock-alt").show();
    $(".fa-unlock").hide(); 
     liste="none"
  }
   $.ajax({
         type: "POST",
         url:"sm/plans/blockage/"+liste
      })
  $("#refersh").show();
})


$(".open-close").click(function(){
  if($(".glyphicon-eye-open").is(':visible'))
  {
    $(".glyphicon-eye-open").hide();
    $(".glyphicon-eye-close").show();   
  }else
  {
    $(".glyphicon-eye-open").show();
    $(".glyphicon-eye-close").hide(); 
    
  }
})

$(".onoffswitch-checkbox2").change(function(){
var x=$(this).is(":checked")
 // alert($(".onoffswitch-inner:before").css("content"));
 if(x==true)
liste="groups";
else
liste="users";
$.ajax({
         type: "POST",
         url:"sm/plans/listeusergroups/"+liste
      }).done(function(result) {
        $("#listegroupe").html(result)
      });
})
$(".glyphicon-option-horizontal").click(function(){
  if($(".glyphicon-text-size").is(":visible"))
  {
  $(".outilTable").find("div,table").hide()
  $(".outilTable").css({"width":"19px","float":"right","margin_right":"-3px"})
  $("#table_id").css({"width":"97%"})
}else{
    $(".outilTable").find("div,table").show()
  $("#table_id").css({"width":"82%"})
  $(".outilTable").css({"width":""})
}
})

$(".fa-comments").click(function(){
 
  if($(".divoutilcellule").is(':visible'))
  {$(".divoutilcellule").hide();
$(".checkbox").hide();}

else
  {$(".divoutilcellule").show();
 $(".checkbox").show();}
  $('#table_id').find('.checkbox').each(function(i,li){
    x=$(this).is(":checked")
    if(x)
    alert($(this).attr('id'));
  })
})
$("#recording").click(function(){
  var id=$("#id_plans").val();
 $.ajax({
         type: "POST",
         url:"sm/plans/recording/"+id
      }).done(function(result) {
      alert(result)
      });
})
});
</script>
<div style="display:nones "class="refreshdiv"  id="refersh">
  <div>
    <?php echo $this->Html->image("LoaderIcon.gif");?>
</div>
</div>
<div style="display:none "class="notificationdiv"  id="notification">
  <div>

</div>
</div>
<form>
<div style="background: rgba(255, 255, 255, 1);padding-left: 10px;padding-right: 0px;min-height: 91%;">
 
    <div class="panel-heading clearfix" style="height: 100px;margin-top: 0px;
    background: #ffffff;">
<div class="row">

<div class="divTitre">
<h2 style="text-align: center;">
<input type="text" class="inputplan" value="" placeholder="<?php echo $plans['Plan']['titre'] ?>" style="width:100%">
</h2>
<h2 style="text-align: center;">
<input type="text" class="inputplan" value="" placeholder="<?php echo $plans['Plan']['adress'] ?>" style="width:100%">
</h2>
</div>
<div class="divDate">
	<input type="text" class="inputplan" value="<?php echo date("F j, Y, g:i a"); ?>" placeholder="<?php echo date("F j, Y, g:i a"); ?>" disabled></div>
</div>
	<div class="row">
<div class="divLogo">
 <label class=""style=" width: 90px;height: 90px;">
  <img src="./sm/<?php  echo $plans['Plan']['logo'];?>" style=" width: 90px;height: 90px;">
  <?php echo $this->Form->file('file',array('label'=>false,'multiple',
                 'style'=>'display: none','id'=>'userImage'));?>
</label>  
</div>
</form>
<input type="hidden" value="<?php echo $plans['Plan']['id']; ?>" id="id_plans">

<div class="divFiltrage">
	   <div class="form-group">
	    <i class="fa fa-filter" aria-hidden="true"></i>
      </div>
      <div><button id="recording">save</button></div>
</div>
</div>
    </div></br>
<div style="display:none; margin-top:20px">
 <input type="hidden"  class='colors'/>
</div>
<div id="table_id"style="color: navy;margin-top: 17px;" class="col-md-10" >
<table id="example"  class="display " cellspacing="0" style="color: black;background: rgba(240, 248, 255, 0.86);border: 3px solid;border-color: #e6dbea;width: 100%;">
        <thead>
            <tr id="typecomposante">
              <th>move</th>
                <th> 
   <input list="query" placeholder='Select type component' class="form-control input2" id="input"> 
 
               </th>
                  <th> 
   <input list="query" placeholder='Select type component' class="input2 form-control"id="input"> 

               </th>
                  <th> 
   <input list="query" placeholder='Select type component' class="input2 form-control"id="input"> 

               </th>
                  <th> 
   <input list="query" placeholder='Select type component' class="input2 form-control"id="input"> 
 
               </th>
                
            </tr>
        </thead>

    
    </table>
   </div>
    <div class="col-md-2 outilTable">
      <i class="glyphicon glyphicon-option-horizontal" aria-hidden="true" style="position: absolute;font-size: x-large;right: 4px;color: white;"></i>
     

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
<div style="display:none;background: #ffffff;width: 97px;height: 36px;position: absolute;margin-left: -74px;" id="slider1" >
  <em style="color:black"><?php echo __("Font size:")?><span id="font" >8</span> px</em>
<div id="slider" ></div>
</div>
<table  style=" top: 30px;font-size: x-large;">
<tr>
  <td>
  <i class="fa fa-unlock-alt blockage" aria-hidden="true" style="display:none"></i>
  <i class="fa fa-unlock blockage" aria-hidden="true" ></i>
</td>
<td>
 <i  class="glyphicon glyphicon-text-size"></i>
</td>
<td>
 <i class="fa fa-floppy-o" aria-hidden="true"></i>
</td>
<td>
 <i class="glyphicon glyphicon-text-color" aria-hidden="true"></i>
</td>
<td>
 <i class="glyphicon glyphicon-eye-open open-close" aria-hidden="true" style="display:none"></i>
 <i class="glyphicon glyphicon-eye-close open-close" aria-hidden="true" ></i>
</td>
<td>
<input class="cp2"type="hidden"/>
</td>
<td>
<i class="fa fa-comments" aria-hidden="true"></i></td>
</tr>
</table>

<div style="bottom: 100px;display:none;position: absolute;width: 80%;" class="checkbox">
  <div class="onoffswitch">
      <input type="checkbox" name="group" class="onoffswitch-checkbox2" id="groupeusers" value="">
      <label class="onoffswitch-label2" for="groupeusers">
          <span class="onoffswitch-inner2"></span>
          <span class="onoffswitch-switch2"></span>
      </label>
    </div>
  <i class="fa fa-paper-plane" aria-hidden="true"style=" position: absolute; margin-left: 183px;margin-top: 10px;"></i>
<input list="usersliste" class="form-control" style="width:100%">
</div>
 <div style="bottom: 50px;position: absolute;width: 80%;">
<button class="partage form-control input-lg "><?php echo __("EXPORT & SHARE");?></button>
 </div>

<table style=" bottom: 10px;">
  <tr>
    <td>
      <i class="fa fa-reply" aria-hidden="true"></i>
    </td>
    <td>
<i class="fa fa-share" aria-hidden="true"></i>
</td>
  <td>
<i class="glyphicon glyphicon-print" aria-hidden="true" onclick="printDiv('table_id')"></i>
</td>
 <td>
<i class="fa fa-envelope" aria-hidden="true"></i>
</td>
<td>
<i class="fa fa-files-o" aria-hidden="true"></i>
</td>
<td>
<i class="fa fa-trash" aria-hidden="true"></i>
</td>
</tr>
<tr>
  <td><?php  echo __("Undo");?></td>
  <td><?php  echo __("Redo");?></td>
  <td><?php  echo __("Print");?></td>
   <td><?php  echo __("send");?></td>
  <td><?php  echo __("Duplicate");?></td>
  <td><?php  echo __("Delete");?></td>
</tr>
</table>
   </div>
</div>
</div>


 <datalist id="query">
  <?php foreach ($types as $type) {
	?>
<option value="<?php echo $type['TypeComponent']['description'] ?>-<?php echo ''.$type['TypeComponent']['id']; ?>">
	</option>
<?php
} ?>
   </datalist>
   <div id="listegroupe"></div>


  





   