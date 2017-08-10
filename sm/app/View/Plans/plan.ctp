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

function refresh(){
   if($("#refersh").is(':visible'))
  {
 $.ajax({
  type: "POST",
  url:"sm/plans/tableau/"
}).done(function(result) {
     $("#table_id").html(result);
 });
 $("#refersh").hide();
}
}
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
          var liste=Array("0,0",colors,coordonners);
          
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
    var x=$("#id_plans").val();
     $.ajax({
         type: "POST",
         url:"sm/plans/linkWeb/"+x
      }).done(function(result) {
        prompt("Link",result);
      });
    
})
$(".recording").click(function(){
  var id=$("#id_plans").val();
 $.ajax({
         type: "POST",
         url:"sm/plans/recording/"+id
      })
})


$("#addplan").click(function(){
  $("#newPlan").show();
  $(this).hide();
  $("#selectionPlan").hide();
   $("#savePLan").show();
    $("#cancelNewPlan").show();
});
$("#cancelNewPlan").click(function(){
  $(this).hide();
  $("#addplan").show();
  $("#savePLan").hide();
  $("#selectionPlan").show();
  $("#newPlan").hide();
});
$("#savePLan").click(function(){
  $(this).hide();
  $("#addplan").show();
  $("#cancelNewPlan").hide();
  $("#selectionPlan").show();
  $("#newPlan").hide();
  var titre=$("#Titre").val();
  var Adresse=$("#Adresse").val();
  var logo=$("#userImage").val();

  var attrOption=titre+"!!"+Adresse+"!!";
  $("#planAtrribute").find('.planAtrribute').each(function(il,el){
attrOption+=","+$(this).val();
$(this).parent().remove();
$(this).remove();
  });
  $.ajax({
         type: "POST",
         url:"sm/plans/newPlan/"+attrOption
      })
       
      
})
$("#plusAttributePlan").click(function(){
$("#planAtrribute").append("<div><input type='text' class='inputplan planAtrribute'></div>")
})

$(".deletefixedoption").click(function(){
$(this).parent().remove();
})
$(".deleteoption").click(function(){
 var id= $(this).attr('attr');
$("#"+id).remove();
$(this).remove();
})
$("#addproject").click(function(){
$("#projectTache").show();
$("#outiltable").hide();
  $.ajax({
         type: "POST",
         url:"sm/plans/project/"
          }).done(function(result){
            $("#projectTache").html(result) 
          })
 
})
$("#addTask").click(function(){
   $("#outiltable").hide();
  $.ajax({
         type: "POST",
         url:"sm/plans/task/"
          }).done(function(result){
            $("#projectTache").html(result) 
          })
 $("#projectTache").show();

})

$(".open-close").click(function(){
  if($(".glyphicon-eye-open").is(":visible"))
  {
    $("#body").show()
  }
  else
    $("#body").hide()
})
 $("#projectTache").click(function(){
    $("#projectTache").draggable();
   
  });
 $(".plusAxe").click(function(){
 ligne=-1;
 $('#example').find('tr').each(function(il,el) {
ligne++;
 });
 $.ajax({
  type: "POST",
  url:"sm/plans/ettiquette/"+ligne
}).done(function(result){
   mise("ligne");
   refresh()
})
 });
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
  } else{
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
   $.ajax({
  type: "POST",
  url:"sm/plans/tableau/"
}).done(function(result) {
     $("#table_id").html(result);
     
 });
 $('.plusLigne').click(function(){
  mise("ligne");
  });
 $('.plusColone').click(function(){
  mise("colone");
  });
$("#deletePlan").click(function(){
  var r = confirm("<?php echo __('Avez-vous Supprimer!');?>");
if (r == true) 
   {
    var x=$(this).attr("attr");
    alert(x)
 $.ajax({
  type: "POST",
  url:"sm/plans/deletePlan/"+x
});
   } 
   else
   {
  
   }
});
$("#sendMessage").click(function(){

})

function replay(liste)
{
  $.ajax({
  type: "POST",
  url:"sm/plans/plan/"+liste
}).done(function(result) {
   $("#table_id").html(result)
  
 });
}

$("#reply").click(function(){
var plan_id=$("#id_plans").val();                           
    var liste =Array(plan_id,1)
   replay(liste);
});

$("#share").click(function(){
  var plan_id=$("#id_plans").val();
 var liste =Array(plan_id,0)
 replay(liste);
})
});
 //refresh();
</script>
 <script>
 
  </script>
 
<style type="text/css">
.btnbtn{
    margin-top: -9px;

        height: 31px;
}

</style>
<div id="projectTache" class="auth-block" style="position: absolute;margin-left: 241px;width:700px; display:none">
  </div>


<div class="body" id="body">
  <div class="logoPlan">
    <div style="border-style: solid;border-color: #fbf9f9;padding: 6px;">
        <img src="./sm/img/plans/neguac.jpg"style=" width: 100px;height: 100px;">
      </div>
       </div>
      <div class="item">
         <div >
          <i class="fa fa-trash deletefixedoption" aria-hidden="true" style="float: right;color: #2389c6;font-size: large;margin-top: 15px;"></i>
<input type="text" class="inputplan" value="" placeholder="<?php echo $plans['Plan']['adress'] ?>" >
         </div>
          <div><i class="fa fa-trash deletefixedoption" aria-hidden="true" style="float: right;color: #2389c6;font-size: large;margin-top: 15px;"></i>
            <input type="text" class="inputplan" value="" placeholder="<?php echo $plans['Plan']['titre'] ?>">
         </div> 
          <?php $option =explode(',',$plans['Plan']['option'] );
             for ($K=0; $K <count($option) ; $K++) {  ?>
 <i class="fa fa-trash deleteoption" attr="option<?php echo $K?>" aria-hidden="true" style="float: right;color: #2389c6;font-size: large;margin-top: 15px;"></i>
        <div id="option<?php echo $K?>">
      
            <input type="text"  class="inputplan" value="" placeholder="
            <?php echo $option[$K]; ?>">
        </div>
             <?php } ?>  
         <div>
            <button type="button" class="btn btn-primary"><?php echo __("+");?>
            </button>
         </div>
      </div>
</div>
<input type="hidden" value="<?php echo $coordonners[0].','.$coordonners[1]; ?>" id="coordonners">
<input type="hidden" value="<?php if($plans) echo $plans['Plan']['id']; ?>" id="id_plans"> 
  <div class=" divPlanTable">
    <div class="outilTable" >
  <div id="outiltable">
    <div style="display:none;background: #ffffff;width: 97px;height: 36px;position: absolute;margin-left: -74px;" id="slider1" >
  <em style="color:black">
    <?php echo __("Font size:")?><span id="font" >8</span><?php echo __("px")?></em>
<div id="slider" ></div>
</div>

<div class="col-md-3" style="padding: 0px;margin-top:2px">
<i class="btn1212 col-md-4"><?php echo __("PARTAGER");?>
</i><i class=" btn1212 col-md-4"><?php echo __("EXPORTER");?>
</i><i  class=" recording btn1212 col-md-4"><?php echo __("SAUVEGARDER");?>
</i>
</div>
<div class="col-md-6" style="padding: 0px;margin-top:2px">
<i  class="glyphicon glyphicon-text-size col-md-1 btn1212"></i>
 <i class="fa fa-floppy-o col-md-1 btn1212" aria-hidden="true"></i>
  <i class="glyphicon glyphicon-text-color col-md-1 btn1212" aria-hidden="true"></i>
  <i class="glyphicon glyphicon-eye-open open-close col-md-1 btn1212" aria-hidden="true" style="display:none"></i>
   <i class="glyphicon glyphicon-eye-close open-close col-md-1 btn1212" aria-hidden="true" ></i>
   <i class="fa fa-reply col-md-1 btn1212" aria-hidden="true" id="reply"
    detailPlan="<?php echo '1'; ?>"></i>
    <i class="fa fa-share col-md-1 btn1212" aria-hidden="true" id="share" ></i>
    <i class="glyphicon glyphicon-print col-md-1 btn1212" aria-hidden="true" onclick="printDiv('maydiv')"></i>
    <i class="fa fa-envelope col-md-1 btn1212 " onclick="sendMessage()" id="esendMessage"aria-hidden="true"></i>
    <i class="fa fa-files-o col-md-1 btn1212 " aria-hidden="true"></i>
     <i class="col-md-1 btn1212"><input class="cp2" type="hidden" style="float:left"/></i>
       <i class="fa fa-comments col-md-1 btn1212" aria-hidden="true"></i>
       <i class="fa fa-trash col-md-1 btn1212 " style="background: red;" aria-hidden="true" id="deletePlan" attr="<?php echo $plans['Plan']['id'] ?>" ></i>
</div>
<div class="col-md-3" style="padding: 0px;margin-top:2px">
<i class="plusAxe col-md-4 btn1212" ><?php echo __("ÉTIQUETTE");?></i>
<i class="plusColone col-md-4 btn1212" ><?php echo __("COLONNE(+)");?></i>
<i class="plusLigne col-md-4 btn1212"><?php echo __("LIGNE(+)");?></i>
</div>   
</div>
  </div>
<div id="table_id">
</div>
</div>
<div style="background: white;float: right;margin-top: 7px;width: 100%;"> 
<button type="button" class="btn btn-primary" id="addproject"><?php echo __("PROJET (+)");?></button>
<button type="button" class="btn btn-primary" id="addTask" ><?php echo __("TÂCHE (+)");?></button>
<button type="button" class="btn btn-primary" ><?php echo __("ENVOYER MESSAGE");?></button>
</div>
<div style="background: white;float: right;margin-top: 7px;width: 100%;"> 
  <input type="text" value=""style="border: none;width: 50%;height: 100%;padding: 11px;text-transform: uppercase;">
<button type="button"  class="btn btn-primary"style="
    margin-top: 5px;"><?php echo __("+");?>
</button>
</div>
<div style="background: white;float: right;margin-top: 7px;width: 100%;"> 
&nbsp;&nbsp;&nbsp;<?php echo __("");?>
<button type="button" class="btn btn-primary recording"style="
    background-color: #286090;"><?php echo __("SAUVEGARDER");?>
</button>
</button>
</div>



<div id="maydiv" style="display:none">
<div class="body" id="body">
  <div class="logoPlan">
    <div style="border-style: solid;border-color: #fbf9f9;padding: 6px;">
        <img src="./sm/img/plans/neguac.jpg"style=" width: 100px;height: 100px;">
      </div>
       </div>
      <div class="item">
         <div >
      
<?php echo $plans['Plan']['adress'] ?>
         </div>
          <div>
            <?php echo $plans['Plan']['titre'] ?>
         </div> 
          <?php $option =explode(',',$plans['Plan']['option'] );
             for ($K=0; $K <count($option) ; $K++) {  ?>
        <div>
      <?php echo $option[$K]; ?>
        </div>
             <?php } ?>  
        
      </div>
</div>
<div>
</div>


</div>