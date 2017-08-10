 <?php 
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
    echo $this->Html->css('main');
    ?>
    <?php echo $this->Html->css('jquery-te-1.4.0');?>
<?php echo $this->Html->script('jquery-te-1.4.0');?>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" type="text/javascript"></script>
      <?php echo $this->Html->css('jquery.contextmenu');?>
<?php echo $this->Html->script('jquery.contextmenu');?>
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
document.reload();
}
$(document).ready(function() {
  setInterval(function(){refresh()}, 500);
function refresh()
{
   if($("#refersh").is(':visible'))
      {
       if($("#historical_plan_id"))
        var id_historcal=$("#historical_plan_id").val()
         $.ajax({
          type: "POST",
          url:"sm/plans/detail_plan/"+id_historcal
        }).done(function(result) {
             $("#table_id").html(result);
         });
        $("#refersh").hide();
      }
}
 var id=$("#selectionPlan").val()
 if(id)
 {
  var liste=Array(id,0)
   $.ajax({
         type: "POST",
         url:"sm/plans/getPlanning/"+liste
      }).done(function(result){
        $("#PlanShow").html(result)
         
      })
    }
$("#selectionPlan").on('change',function(){
 var id=$(this).val()
 var liste= id+","+0;
   $.ajax({
         type: "POST",
         url:"sm/plans/getPlanning/"+liste
      }).done(function(result){
        $("#PlanShow").html(result)
       
         refresh();
      })
})
$("#addplan").click(function(){
  $("#MenuPlan").hide();
  $("#newPlan").show();
   $("#PlanShow").hide();
});
$("#cancelNewPlan").click(function(){
 $("#MenuPlan").show();
  $("#newPlan").hide();
   $("#PlanShow").show();
});
$("#savePLan").click(function(){
  $("#MenuPlan").show();
  $("#newPlan").hide();
   $("#PlanShow").show();
// var content=$("#Titre").val();
// $titre=$(".titlePlan").val();
//   var files=$(document).find('input[type="file"]')[0].files
//    if (files.length > 0) {
//   var file = files[0];
//   var liste=Array(content,file.name,titre);
//   // $.ajax({
//   //        type: "POST",
//   //        url:"sm/plans/newPlan/"+liste
//   //     }).done(function(result){
//   //   document.reload();
//   //     })
})
$("#print").click(function(){
    printDiv("printdiv");
  })
});
 //refresh();
 function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/\//g,'a9a').replace(/\:/g,'..');
}
 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#output')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

<div style="display:none "class="notificationdiv"  id="notification">
  <div>
</div>
</div>

<div class="row" id="MenuPlan">
  <div class="col-xs-12 col-md-80 white height-33">
 <button type="button"  class="open-close HIDE btn-btn">
   <?php echo __("HIDE"); ?>
   </button> 
   <button type="button"  class="open-close preview btn-btn" style="display:none">
  <?php echo __("PREVIEW"); ?>
   </button>
   <button type="button" id="print" class="btn-btn" >
<?php echo __("PRINT"); ?>
 </button>
   <button type="button" id="addplan" class="btn-btn">
  <?php echo __("PLANS (+)");?></button>
</div>

<div class="col-xs-12 col-md-2  right ">
<select id="selectionPlan" class="selectPlan margin-left-14 white ">
  
<?php
if($plans)
 foreach ($plans as $plan) { ?>
<option value="<?php echo $plan['Plan']['id'] ?>">
<?php echo  $plan['Plan']['title'];?>
</option>
  <?php } ?>
</select>
</div>
</div>
<form method="post" action="./sm/Plans/newPlan" enctype="multipart/form-data">
<div class="row" id="newPlan" style="display:none;">
   <div class="col-xs-12  white height-33">
    <?php echo $this->Form->input('Title',array('label'=>false,'type'=>'text','class'=>'titlePlan')); ?>
 <button type="submit"  class="btn-btn" id="savePLan1">
   <?php echo __("Save"); ?>
   </button> 
   <button type="button"  class="btn-btn" style="display:nones" id="cancelNewPlan">
  <?php echo __("Cancel"); ?>
   </button>
</div>
<div class="logoPlan">
     <div style="border-style: solid;border-color: #fbf9f9;padding: 6px;">
      <label>
        <img id="output" src="./sm/img/plans/vide.gif" style=" width: 100px;height: 100px;" for="inputupload"/>
        <?php echo $this->Form->input('.logo',array('label'=>false,'type'=>'file','id'=>'inputupload', 'options' => array('accept' => 'application/gzip,application/gzipped,application/octet-stream'),'onchange'=>'readURL(this);','style'=>'display: none')); ?>
         </label>
      </div>
</div>
      <div class="item margin-top-34">
        <?php echo $this->Form->input('description',array('label'=>false,'type'=>'textarea','class'=>'textareaNewPlan')); ?>
      </div>
</div>  
</form>     
<div id="PlanShow" class="col-xs-12 col-md-12 margin-bottom-13">
</div>
 <datalist id="query">
  <?php foreach ($types as $type) {
	?>
<option value="<?php echo $type['TypeComponent']['description'] ?>">
	</option>
<?php
} ?>
   </datalist>
   <div id="listegroupe"></div>
<div style="display:none"class="refreshdiv"  id="refersh">
  <div>
    <?php echo $this->Html->image("LoaderIcon.gif");?>
</div>
</div>
  

