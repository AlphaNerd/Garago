
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
 $('.cp1').colorpicker({
  })
    .on('change.color', function(evt, color){
        colors=$(this).val();
        var index = $(this).attr('id');
       colors=colors.substring(1);
       var coordonners=$("#NBRCOLONE").val();
       var liste=Array(index,colors,coordonners);
       alert(liste)
         $.ajax({
         type: "POST",
         url:"sm/plans/colors/"+liste
      })
         //$("#refersh").show();
    })
    .on('mouseover.color', function(evt, color){
            if(color){
                $(this).parent().parent().css('background-color',color);
                 $(this).parent().css('background-color',color);
            }
    });
 RowSorter('table', {
    handler: 'td.sorter',
    stickFirstRow : true,
    stickLastRow  : false,
    onDragStart: function(tbody, row, index){},
    onDrop: function(tbody, row, new_index, old_index){
    alert(tbody+"-"+row+"-"+"-"+new_index+"-"+old_index) ;}
}); 
 $('.fa-arrows-h').click(function(){
$("#example").colResizable({
    liveDrag:true, 
      gripInnerHtml:"<div class='grip'></div>", 
      draggingClass:"dragging", 
            resizeMode:'fit'
        });
 });
  function callback() {
      setTimeout(function() {
        $( ".notificationdiv:visible" ).removeAttr( "style" ).fadeOut();
      }, 1000 );
    };
  $('.composantVertical').dblclick(function(){
var coordonners=$(this).attr('id');
var type=$("#"+coordonners.split(',')[1]).val();
var liste=Array(coordonners,type);
if(type=="")
{
$(".notificationdiv").html("<div><a><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></a>Select Type Component SVP!!</div>");
$(".notificationdiv").show('drop',null,500,callback);
}else if(type=="Budget")
  {
$.ajax({
  type: "POST",
  url:"sm/plans/budget/"+liste
}).done(function(result) {
     $("#detail").html(result);
     $("#detail").show();
 });
  }else if(type=="Jobs"){
$.ajax({
  type: "POST",
  url:"sm/plans/jobs/"+liste
}).done(function(result) {
     $("#detail").html(result);
     $("#detail").show();
 });
  }else if(type=="Resources"){
$.ajax({
  type: "POST",
  url:"sm/plans/resources/"+liste
}).done(function(result) {
     $("#detail").html(result);
     $("#detail").show();
 });
  }else
   {
$.ajax({
  type: "POST",
  url:"sm/plans/composant/"+liste
}).done(function(result) {
     $("#detail").html(result);
     $("#detail").show();
 });
}
 });
$('.input2').focus(function(){
$(this).val("");
});
$('.input2').focusout(function(){
var color=$(this).val();
var colone=$(this).attr('id');
var coordonners=$("#NBRCOLONE").val();
var liste=Array(colone,color,coordonners);
$.ajax({
  type: "POST",
  url:"sm/plans/typeCom/"+liste
})
$("#refersh").show();
 });

$('.dis').click(function(){
  var display=$(this).attr('id');
var coordonners=$("#NBRCOLONE").val();
liste=Array(display,coordonners);
$.ajax({
  type: "POST",
  url:"sm/plans/displaycol/"+liste
})

$("#refersh").show();
 });
// $("#bilel").on('change',function(){
//   $('table').css( "font-size", $(this).val()+"px" );
// })

$(".del").click(function(){
var id=$(this).attr("attr");
var cor=$("#NBRCOLONE").val();
var liste = Array(cor,id);
$.ajax({
  type: "POST",
  url:"sm/plans/deletecolone/"+liste
})
$("#refersh").show();
})
$(".del-ligne").click(function(){
var id=$(this).attr("attr");
// var cor=$("#NBRCOLONE").val();
// var liste = Array(cor,id);
$.ajax({
  type: "POST",
  url:"sm/plans/deleteligne/"+id
})
$("#refersh").show();
})
$("td").click(function(){
  if ($(this).find(".divoutilcellule").is(":visible")) {
$(this).find(".divoutilcellule").hide();
  }else
  {
    $(this).find(".divoutilcellule").show();
  }
})
$(".ettiquetteInput").focusout(function(){
  var x=$("#"+$(this).attr('id')).val();
  var y=$("#ettiquetteId").val();
  var liste=Array(x,y);
  $.ajax({
  type: "POST",
  url:"sm/plans/EditEtiquette/"+liste
  })
})

</script>
<input type="hidden" value="<?php echo $coordonners[0].','.$coordonners[1]; ?>" id="NBRCOLONE">
<style>
table.sorting-table {cursor: move;}
table tr.sorting-row td {background-color: #8b8;}
table td.sorter {width: 15px; background-color: #2b3a41;}
</style>
<?php if(count($TableTails))
{?>
<table id="example" class="table-border" style="width:100%;color: white;">
        <thead>
            
            <tr id="typecomposante">
              <td class="sorter">  </td>
             <?php for ($i=0; $i <$coordonners[1] ; $i++) { 
               ?>
                <td bgcolor="<?php  echo $TableTails[0][$i]['color'];?>"> 
                 
   <input list="query" style="background-color:none; display:<?php echo $TableTails[0][$i]['display']?>;pointer-events: <?php echo $TableTails[0][$i]['duplicate'];?> color:#ffffff;"placeholder='ITEM' class="form-control2 input2" id="<?php echo $i;?>" 
   value="<?php  echo explode('-',$TableTails[1][$i]['type'])[0];?>"
   />
              </td>
               <?php }?>   
            </tr>
        </thead>
        <tbody style="background: white;color: black;">
<?php for ($i=1; $i <$coordonners[0] ; $i++) { ?>
<tr>
  <td class="sorter">
<i class="fa fa-minus-circle del-ligne" aria-hidden="true" attr="<?php echo $i ?>"style="pointer-events: <?php echo $TableTails[0][0]['duplicate'] ?>"></i>
   <div style="position: absolute; margin-top: -6px;">
    <input class="cp1 color-tr" id="<?php echo $i.',0'; ?>" type="hidden"/> 
  </div>
  </td>
  <?php
  $tab=array(1); 
foreach ($ettiquette as $ettiquett) {
  $tab[]=$ettiquett['id'];
}
  if(in_array($i, $tab)){
    ?><td colspan="<?php echo $coordonners[1]?>">
<textarea type="hidden" class="inputplan ettiquetteInput" value="<?php //echo $ettiquette[0]['description']?>" placeholder="" id="inputEttiquette<?php echo $i; ?>"style="text-align: center;" ettiquetteId="<?php $i ?>"></textarea>
  </td><?php } else {?>                                                            
    <?php for ($j=0; $j <$coordonners[1] ; $j++) {
   $index=($coordonners[1]+1)*$i+$j;?>
  <td bgcolor="<?php  echo $TableTails[$i][$j]['color'];?>" class="tdevent" >
   
<textarea type="hidden" class="inputplan ettiquetteInput" value="<?php //echo $ettiquette[0]['description']?>" placeholder="" id="" style="" ettiquetteId=""></textarea>

</td>
 <?php } } ?>
  </tr>
  <?php } ?>
        </tbody>  
        <tr><th class="sorter"></th>
              <?php for ($i=0; $i <$coordonners[1] ; $i++) { 
               ?><th> 
                  <div class='colorcp'style="display:none;float: right;">
                 </div>   
                   <?php if($TableTails[0][$i]['display']=="none"){ ?>
                  <i class="fa fa-eye dis"  aria-hidden="true" id="<?php echo $i ?>.block"></i>
                 <?php } else { ?>
                  <i class="fa fa-eye-slash dis"  aria-hidden="true" id="<?php echo $i ?>.none"></i>
                  <i class="fa fa-minus-circle del" aria-hidden="true" attr="<?php echo $i ?>"style="pointer-events: <?php echo $TableTails[0][0]['duplicate'] ?>"></i><i style="float: right;">
                  <input class="cp1" id="<?php echo '0,'.$i; ?>" type="hidden"/><i>
                   <?php }?>
                </th>
               <?php }
               ?>
            </tr>
        </table>
<?php } ?>
<div   style="display:none;position: fixed;top: 166px;left: 25%;" id="detail">
        
</div>

