

<script>
  $('.jqte-test').jqte();
  
  // settings of status
  var jqteStatus = true;
  $(".status").click(function()
  { 
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({"status" : jqteStatus})
  });
var color;
 $('.cp2').colorpicker({
  }).on('change.color', function(evt, color){
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

  $(".open-close").click(function(){
    if($(".HIDE").is(':visible'))
  {
   
    $(".HIDE").hide();
    $(".preview").show(); 
    $("#body").hide()
        $("#vision").hide();
  }else
  {
    $(".HIDE").show();
    $(".preview").hide();
      $("#body").show() 
    $("#vision").show();
        
  }
  })
$(".plusLine").mouseover(function(){
  $(this).find('div').show();
})
$(".plusLine").mouseout(function(){
  $(this).find('div').hide();
})
$(".fa-reply").click(function(){
 var id=$("#selectionPlan").val();
var position=Number($("#position").val())+1;
 var liste= id+","+position;
   $.ajax({
         type: "POST",
         url:"sm/plans/getPlanning/"+liste
      }).done(function(result){
        $("#PlanShow").html(result)
       
         refresh();
      })
})

$(".fa-share").click(function(){
 var id=$("#selectionPlan").val();
var position=Number($("#position").val())-1;
 var liste= id+","+position;
   $.ajax({
         type: "POST",
         url:"sm/plans/getPlanning/"+liste
      }).done(function(result){
        $("#PlanShow").html(result)
       
         refresh();
      })


})
$(".lock").click(function(){
        if($(".fa-lock").is(":visible")){
          $(".fa-lock").hide()
          $(".fa-unlock-alt").show();
          $(".btnTachProject").hide()
          $("#example").css('pointer-events','auto');
          
          $(".check_overlay").hide();
                  }else{
          $(".fa-lock").show()
          $(".fa-unlock-alt").hide();
          $(".btnTachProject").show();
          $("#example").css('pointer-events','none');
          $(".check_overlay").show();
          $(".Activites").css('pointer-events','auto')
            
        }
      })
$(".share").click(function(){
  $(".projectTache").show()
$(".barre_Tache_projet").hide();
   $.ajax({
         type: "POST",
         url:"sm/plans/share/"+$("#id").val()
      }).done(function(result){
        $("#projectTache").html(result)
       $("#outiltable").hide();
      })
})

$("#addproject").click(function(){
var liste=""
alert('bil')
  $("td").find("input:checkbox:checked").each(function(){
  id=$(this).attr('id')
       liste=liste+" "+id 
  })
    $.ajax({
         type: "POST",
         url:"sm/plans/addProject/"+liste
      }).done(function(result){
        // $("i").hide();
      $("#projectTache").show()
       $("#projectTache").html(result)
      $("#outiltable").hide();
      })
  
})
$(".item ").dblclick(function(){
$(this).find('.textareaTitle').prop('disabled',false);
})
$('.textareaTitle').on('change',function(){
  $(this).prop('disabled',true);
});
$('.glyphicon-italic').click(function(){

  if($("#font-style").val()=='italic')
    $fontStyle='normal'
  else
    $fontStyle='italic'
var liste=$("#historical_plan_id").val()+",font-style,"+$fontStyle;
   $.ajax({
         type: "POST",
         url:"sm/plans/setStyle/"+liste
      }).done(function(result){
        getplaningapreMiseajour()
      })
});
$('.glyphicon-bold').click(function(){
if($("#font-weight").val()=='900')
    $fontWeight='400'
  else
    $fontWeight=Number($("#font-weight").val())+100;
var liste=$("#historical_plan_id").val()+",font-weight,"+$fontWeight;
   $.ajax({
         type: "POST",
         url:"sm/plans/setStyle/"+liste
      }).done(function(result){
         getplaningapreMiseajour()
      })
});
function getplaningapreMiseajour()
{
  var id=$("#selectionPlan").val();
var position=Number($("#position").val())-1;
 var liste= id+","+position;
   $.ajax({
         type: "POST",
         url:"sm/plans/getPlanning/"+liste
      }).done(function(result){
        $("#PlanShow").html(result)
         refresh();
      })
}
//refresh();
</script>

<input type="hidden" value="<?php echo  $id;?>" id="plan_id">
<input type ="hidden" value="<?php echo $id_hisorical ?>" id="historical_plan_id">
<input type ="hidden" value="<?php echo $his_id ?>" id="position">
<div class="body margin-top-2" id="body">
  <div class="logoPlan">
    <div style="border-style: solid;border-color: #fbf9f9;padding: 6px;">
      <label>
         <img src="data:image/jpeg;base64,<?php echo base64_encode($plans['Plan']['logo']); ?>"style=" width: 100px;height: 100px;" />
         </label>
      </div>
  </div>
        <div class="item">
        <textarea class="textareaTitle"disabled="disabled" id="Titre" style=" border: none;margin: 0px;width: 85%;height: 119px;resize: initial;overflow: hidden;"><?php if($plans) echo $plans['Plan']['title']; ?></textarea >
      </div>
</div>
<input type="hidden" value="" id="coordonners">
<input type="hidden" value="<?php if($plans) echo $plans['Plan']['id']; ?>" id="id_plans"> 
  <div class=" divPlanTable">
  <div id="outiltable">
   <div class="col-md-3" style="padding: 0px;margin-top:2px;">
             <i class="col-md-5 btn1212   left">
             <span><?php echo __("NORMAL");?></span>
              <i class="glyphicon glyphicon-triangle-bottom margin-top-2" aria-hidden="true" >
              </i>
            </i>
    <div class="col-md-5" style="padding: 0px;">
       <i class="glyphicon glyphicon-text-size col-md-6 btn1212 ">
      <i class="glyphicon glyphicon-triangle-bottom margin-top-2 margin-left--10" aria-hidden="true" >
        </i>
      </i>
        <i class="glyphicon glyphicon-text-color col-md-6 btn1212 ">
        <i class="glyphicon glyphicon-triangle-bottom margin-top-2 margin-left--12" aria-hidden="true">
        </i>
      </i>
 </div>
 <span>
      <i class="col-md-2 glyphicon glyphicon-bold btn1212 " aria-hidden="true"></i>
   </div> 
<div class="col-md-9" style="padding: 0px;margin-top:2px">
   <i class="col-md-1 glyphicon glyphicon-italic btn1212 " aria-hidden="true" ></i>
  <i class="col-md-1 glyphicon glyphicon-text-background btn1212 " aria-hidden="true">
    <i class="glyphicon glyphicon-triangle-bottom margin-top-2 margin-left--12" aria-hidden="true">
   </i>
  </i>
  <i class="fa fa-reply col-md-2 btn1212 " aria-hidden="true" id="reply" detailPlan="">
    <?php echo __(" UNDO");?>
  </i>
  <i class="fa fa-share col-md-2 btn1212 " aria-hidden="true" id="share" >
      <?php echo __(" REDO");?>
    </i>
  <i class="fa fa-floppy-o  col-md-2 btn1212" aria-hidden="true" id="share" >
    <?php echo __(" SAVE");?>
  </i>
    <i class="btn1212 col-md-2 fa fa-share-alt share">
        <?php echo __(" SHARE");?>
       </i>
  <i class="fa fa-lock col-md-1 btn1212 lock " style="display:none" aria-hidden="true" id="deletePlan" attr="<?php echo $plans['Plan']['id'] ?>" ></i>
<i class="fa fa-unlock-alt col-md-1 btn1212 lock "  aria-hidden="true" id="deletePlan" attr="<?php echo $plans['Plan']['id'] ?>" ></i>
  <i class="fa fa-trash col-md-1 btn1212 " style="background: red;" aria-hidden="true" id="deletePlan" attr="<?php echo $plans['Plan']['id'] ?>" ></i>
</div>
</div>
<div id="table_id">
  <?php  include("detail_plan.ctp"); ?>
</div>
</div>
<div class="barre_Tache_projet btnTachProject" style="display:none;"> 
<button type="button" class="btn-btn" id="addproject"><?php echo __("PROJET (+)");?></button>
<button type="button" class="btn-btn" id="addTask" ><?php echo __("TÂCHE (+)");?></button>
</div>
<div class="barre_Tache_projet"> 
 <div class="row">
  <div class="col-xs-12 col-md-80 white height-33 padding-top-5">
 <sapn> <?php echo __("Ajouter une ligne de texte"); ?>
</div>
</div>
</div>
<div id="projectTache" class="projectTache">
  </div>
<div id="printdiv" style="display:none;">
<table id="example1" class="table-border" style="width:100%;color: white;">
         <thead>
            <tr id="typecomposante">
             <?php
             $i=0;
             foreach ($type_Planning as $typePlan) {
              $i=$i+1;
               ?>
                <td  class="typecomposante" attr='<?php echo $i;?>'> 
              <span class="tooltip">    
                   <?php echo $typePlan['TypePlan']['description'] ?>
                   <span class="tooltiptext"><?php echo __("SAVE NEW HISTORICAL") ?></span>
              </span> 
              </td>
           <td> 
          </td>
               <?php  }
               $row=$i;?>
               <td>
               <td>   
            </tr>
        </thead>
        <tbody>
          <?php
           foreach ($axes as $axe) 
          {
           ?>
          <tr class="plusLines" id="<?php echo $axe['Axis']['id'];?>A">
          <td colspan="<?php echo 2*intval($axe['Axis']['row']);?>" >
           <div class="composantVertical1" 
                axes="<?php echo $axe['Axis']['id'];?>" style="resize: both;hieght:30px;">
                      <?php echo $axe['Axis']['title'];  ?>
                          </div>
                             </td>
                            </tr>
                <tr class="plusLines">
                  <td colspan="<?php echo 2*$row;?>" >
                   </td>
                 </tr>
        <?php for($i=1;$i<=$axe['Axis']['line'];$i++)
          { ?>
            <tr class="plusLines">
            <td colspan="<?php echo 2*$row;?>">
            <div>
          
            
           <div>
           </td>
         </tr>
          <tr id="<?php echo $axe['Axis']['id'].'-'.$i;?>L">

            <?php for($j=1;$j<=$axe['Axis']['row'];$j++)
              { 
              foreach ($axe['detail_planning'] as $detail_planning) 
                { 
                  if(($detail_planning['DetailPlan']['line']==$i)&&
                    ($detail_planning['DetailPlan']['row']==$j)
                     ){
                    ?>
                    <td class="tooltip" colspan="2" class="context-menu-one" 
                    liste="<?php echo $axe['Axis']['id'].','.$i.','.$row ?>">
                    
                    <div class="composantVertical" style="resize: both;">

                        <?php
                        $y= html_entity_decode($detail_planning['DetailPlan']['content'], ENT_COMPAT | ENT_HTML5,'utf-8');
                         echo htmlspecialchars_decode($y); 

                         ?>
                         <?php
                         if($detail_planning['DetailPlan']['budgets']['total']) 
                        { ?>
                        BUDGET [<?php echo $detail_planning['DetailPlan']['budgets']['total'];?>]
                        <?php }
                        if(count($detail_planning['DetailPlan']['projects']))
                          for($c=0;$c<count($detail_planning['DetailPlan']['projects']);$c++)
                            { ?>
                            Project [<?php echo $detail_planning['DetailPlan']['projects'][$c]['Project']['title'];?>
                            <?php }
                          ?>
                      
                    </div>
                     <span class="tooltiptext"><?php echo __("CLICK POUR MODIFIER ") ?></span>
                    </span>

                      </td>

                    <?php
                      }
                ?>
              <?php } ?>      
            <?php }?>
          </tr>
          
        <?php } ?>
      <?php } ?>
        </tbody>
</table>

</div>