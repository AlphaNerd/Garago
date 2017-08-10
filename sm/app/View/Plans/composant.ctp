 <script>
  $('.jqte-test').jqte();
  
  // settings of status
  var jqteStatus = true;
  $(".status").click(function()
  { 
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({"status" : jqteStatus})
  });



function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/\//g,'a9a').replace(/\:/g,'..');
}


</script>
<script type="text/javascript">
$(document).ready(function() {


$('.unlock').click(function(){
var id=$(this).attr('id');
var returnText=$("#divx"+id).val();
    returnText=htmlEntities(returnText);
var ligne=$("#ligne").val();
    var liste=ligne+"-,"+$(this).attr('id')+"-,"+returnText;
  $.ajax({
   type: "POST",
  url:"sm/plans/exemple/"+liste
 }).done(function(result) {
 $(this).parent().hide();
  $("#refersh").show();

  });
});
$('.inputObjectif').on('change',function(){
  var tab=$(this).val();
  var id=$(this).attr('id');
  var returnText=$("#divx"+id).val();
    returnText=htmlEntities(returnText+"<br>"+tab);
var ligne=$("#ligne").val();
    var liste=ligne+"-,"+$(this).attr('id')+"-,"+returnText; 
     alert(liste);
  $.ajax({
   type: "POST",
  url:"sm/plans/exemple/"+liste
 });
   $("#refersh").show();
   $("#hidencordonne").attr("cord");
   var liste2=
  $.ajax({
  type: "POST",
  url:"sm/plans/composant/"+liste2
}).done(function(result) {
     $("#detail").html(result);
     $("#detail").show();
 });
});

$('.fa-times').click(function(){
 $(this).parent().hide();
  $("#refersh").show();

});
$('.inputObjectif').focus(function(){
	$(this).select();
})


$('.plusTd').click(function(){
	var id='#divligne'+$(this).attr('id');

		$('#NBRcolone').val(Number($('#NBRcolone').val())+1);
		var numColone=$('#NBRcolone').val();
		var numligne=$('#NBRLigne').val();
	var tab=Array(numligne,numColone);
	$.ajax({
  type: "POST",
  url:"sm/plans/colone/"+tab
}).done(function(result) {
     $(id).html(result);
 });
});
});
</script>
<?php echo $this->Html->css('w3'); ?>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}
function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("divslider");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>


<div class="auth-block2" style="width:100%;">
	<i class="fa fa-times" aria-hidden="true"></i>
<div class="divcomposant">

<div class="divligne" >
<input type="hidden" id="hidencordonne" cord="<?php echo $coordonner[0].','.$coordonner[1] ?>">

<input type="hidden" value="<?php echo $coordonner[0]; ?>" id="ligne">
<div style="resize: both;" class="titreTable" id="divcolone0-0">
	<div class="divTitreComposant"><?php echo $coordonner[2]; ?></div>
<input  list="<?php echo $TableTails[1][$coordonner[1]]['type'] ?>" class="inputObjectif" id="<?php echo $coordonner[1]; ?>">
<div class="composantVertical" style="resize: both;">
<div id="div<?php echo $coordonner[1] ?>"class="jqte-test">
 <?php
$x=str_replace("a9a", "/",$TableTails[$coordonner[0]][$coordonner[1]]['data']);
$x=str_replace("..", ":",$x);
$y= html_entity_decode($x, ENT_COMPAT | ENT_HTML5,'utf-8');
echo htmlspecialchars_decode($y); ?>

</div>
</div>
<button class="unlock btn btn-primary" id="<?php echo $coordonner[1]; ?>" style="
    height: 24px;
    padding: 0px;
    margin-top: -30px;
">
  <?php echo __("save");?></button>
<div>
</div>
</div>
<i class="fa fa-chevron-circle-left flech" aria-hidden="true" onclick="plusDivs(-1)"></i>


<?php for ($i=1; $i <count($TableTails[1]) ; $i++) { 
		$com=explode('-',$TableTails[1][$i]['type']);
if($i!=$coordonner[1]){

?>

<div style="resize: both;display:none; width:298px" class="titreTable divslider" >
	<div class="divTitreComposant"><?php echo $com[0]; ?></div>
<input  list="<?php echo $TableTails[1][$i]['type'] ?>" class="inputObjectif" id="<?php echo $i; ?>">
<div class="composantVertical jqte-test" id="divx<?php echo $i ?>">
<?php
$x=str_replace("a9a", "/",$TableTails[$coordonner[0]][$i]['data']);
$x=str_replace("..", ":",$x);
$y= html_entity_decode($x, ENT_COMPAT | ENT_HTML5,'utf-8');
//echo $y;
  echo htmlspecialchars_decode($y); 
  ?>

</div>
<button class="unlock btn btn-primary" id="<?php echo $i ?>"style="
    height: 24px;
    padding: 0px;
    margin-top: -30px;
" >
  <?php echo  __("save");?></button>

<div>

</div>
</div>
<?php
 } ?>
<datalist id="<?php echo $TableTails[1][$i]['type'] ?>">

  <?php foreach ($composants as $composant) 
if($com[1]==$composant['Composant']['type_id'])
{

	?>
<option value="<?php echo $composant['Composant']['titre'] ?>"><?php echo $composant['Composant']['description'] ?>
	</option>
<?php
} ?>
   </datalist>

<?php
 } ?>



<i class="fa fa-chevron-circle-right flech" aria-hidden="true" onclick="plusDivs(1)"></i>



</div>
</div>




</div>

 