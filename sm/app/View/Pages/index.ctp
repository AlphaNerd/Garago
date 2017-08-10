
<?php  $webroot="sm/"; ?>

</script>

  <style type="text/css">


label {
  position: relative;
  display: inline-block;
 
  &:after {
    content: '▼';
    position: absolute;
    width: 37px;
    color: #999;
    font-weight: bold;
    font-size: 16px;
    right: 2px;
    bottom: 8px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    pointer-events: none;
    z-index: 2;
  }
  &:before {
    content: '';
    right: 2px;
    top: 2px;
    width: 37px;
    height: 34px;
    background: #242424;
    position: absolute;
    pointer-events: none;
    display: block;
    z-index: 1;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
  }
  select,input {
    position: relative;
    width: 250px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #111;
    color: #999;
    border: none;
    outline: none;
    font-size: 14px;
    padding: 10px 9px;
    margin: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    cursor: pointer;
    height: 38px;
  }
  
}</style>
<?php 
echo $this->Html->css("styles"); ?>
<script type="text/javascript">
$(document).ready(function() {
  $('#view').live('click',function(){
    
  action("view");
});
  $('#favourite').live('click',function(){
action("favourite");
});
  $('#like').live('click',function(){
action("like");
});
  $('#unlike').live('click',function(){
action("unlike");
});
  $('#Send').live('click',function(){
action("Send");
});
  $('#download').live('click',function(){
action("download");
});
function action(typeAction)
{
var id_document=$('#id_document').val();
var id_profile=$('#id_profile').val();
var liste=Array(id_document,id_profile,typeAction);
if(typeAction=="download")
{
$('#downloadDocument').slideDown("show");
 $.ajax({
  type: "POST",
  url:"sm/pages/detail/"+liste
});
}
else if(typeAction=="view")
{
$("#openDocument").slideDown("show");
} else if(typeAction=="send")
{
   $.ajax({
  type: "POST",
  url:"sm/pages/detail/"+liste
}).done(function(result) {
     $('#body-detail').html(result);
});
}
else
{var etat=$("#favourite").attr('etat') 
alert(etat);
  $.ajax({
  type: "POST",
  url:"sm/pages/detail/"+liste
}).done(function(result) {
     $('#body-detail').html(result);
});
}
}

    $('#search-suggest').on('input',function(){
search();
});
  $('#languages').on('change',function(){
 if($('#search-suggest').val())
search();
});
    $('#sectors').on('change',function(){
        if($('#search-suggest').val())
search();
});
      $('#categorys').on('change',function(){
        if($('#search-suggest').val())
search();
});
      $('#customers').on('change',function(){
        if($('#search-suggest').val())
search();
});
      $('#date').on('change',function(){
        if($('#search-suggest').val())
search();
});
      $('#todate').on('change',function(){
        if($('#search-suggest').val())
search();
 });
      $('#attachments').on('change',function(){
       if($('#search-suggest').val())
search();
});
function search(){

    var language=$('#languages').val();
var sector=$('#sectors').val();
var category=$('#categorys').val();
var customer=$('#customers').val();
var date=$('#date').val();
var todate=$('#todate').val();
var attachment=$('#attachments').val();
if(!date)
date=0;
if(!todate)
todate=0;
var rechercher = $('#search-suggest').val(); 
var searchArray=Array(rechercher,language,sector,category,customer,date,todate,attachment);
//alert(searchArray);
$.ajax({
  type: "POST",
  url:"sm/pages/rechercher/"+searchArray
}).done(function(result) {
     $('#body-content').html(result);   
 });
}

$('#openfavourite').live('click',function(){
if($('#listefavourite').is(':visible'))
{
$('#listefavourite').hide(); 
$('#openfavourite').css('bottom','0px'); 

$('#spanfavourite').toggleClass("glyphicon-chevron-down glyphicon-chevron-up");

}else
{
$('#listefavourite').show();
$('#openfavourite').css('bottom','270px'); 
$('#spanfavourite').toggleClass("glyphicon-chevron-up glyphicon-chevron-down");
}
});


$('#close').live('click',function(){
$('#openDocument').hide("show");
});

$('#closeudownload').live('click',function(){
$('#downloadDocument').hide("show");
});


           
$('#optionsearch').live('click',function(){

if($('#paneloption').is(':visible'))
{
$('#paneloption').hide("");
$('#optionsearch').css('top','43px');
}
else
{
  $('#paneloption').show("");
$('#optionsearch').css('top','210px');
}
});



$('#view').live('click',function(){
$('#openDocument').slideDown("show");
$('#openDocument').css('overflow-y', 'auto');
var id_document=$(this).attr('documentID');

});



   });
</script>
  <script type="text/javascript">
  function openDocumentFavourite(id)
  {
    $.ajax({
  type: "POST",
  url:"sm/pages/detail/"+id
}).done(function(result) {
     $('#body-detail').html(result);
});
  }
 function colorswap(id)
{

$.ajax({
  type: "POST",
  url:"sm/pages/detail/"+id
}).done(function(result) {
     $('#body-detail').html(result);
});
}
function clearDetail()
{

  //document.getElmentById('body-detail').InnerHTML()="";
  //$('#body-detail').html("");

}
</script>
 
    <div class="container" style=" width: 100%;padding-top: 30px;padding-left: 40px;">
<div class="col-md-8 col-md-offset-2">  
<div ba-panel="" ba-panel-title="Standard Fields" ba-panel-class="with-scroll">
    <div  class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur="" style="background-size: 1530px 861px; background-position: 0px -64px; min-height: 41px">
      <div class="panel-heading clearfix" style="padding: 3px 27px;height: 42px;">
  <div class="form-group">
           



            <div class="input-group ng-scope">
              <input type="text" class="form-control with-danger-addon" placeholder="<?php echo __('Search for...');?>" id="search-suggest" list="query">
               <span class="input-group-btn">
                <button class="btn btn-danger" type="button"><?php echo __("Go!");?></button>
               </span>
             </div >
             <div class="form-control round-button" id="optionsearch" style="display:block;margin-top: 2px;">
             <span class="glyphicon glyphicon-chevron-up" style="color: rgb(117, 127, 130); margin-left: 13%; font-size: x-large; margin-top: -1px; display: inline-block;" >
             </span>
           </div>
          </div>

</div>
<div class="panel " style="display:none ;height: 132px;" id="paneloption">
            <form> 
           
            <div id="searchInContainer">
           
              <div class="col-2">
            <select  id="languages" class="form-control"  title="Language">
                <option value="0"><?php echo __("Language");?></option>
                <?php 
          foreach ($Languages as $language) {
                    
                 ?>
                <option value="<?php echo $language['Language']['id']; ?>">
                    <?php echo $language['Language']['name']; ?></option>
               <?php }?>
            </select>
     
     </div>
     <div class="col-2">
            <select id="sectors" class="form-control"  title="Sector">
                <option value="0"><?php echo __("Sector");?></option>
                <?php 
          foreach ($Sectors as $sector) {
                    
                 ?>
                <option value="<?php echo $sector['Sector']['id']; ?>">
                    <?php echo $sector['Sector']['description']; ?></option>
               <?php }?>
            </select> </div>
     <div class="col-2">
            <select  id="categorys" class="form-control"  title="Category">
                <option value="0"><?php echo __("Category");?></option>
                <?php 
          foreach ($Categorys as $category) {
                    
                 ?>
                <option value="<?php echo $category['Category']['id']; ?>"><?php echo $category['Category']['description']; ?></option>
               <?php }?>
            </select> </div>
     <div class="col-2">
            <select  id="customers" class="form-control"  title="Customers">
                <option value="0"><?php echo __("Customers");?></option>
                <?php 
          foreach ($Customers as $customers) {
                    
                 ?>
                <option value="<?php echo $customers['Customer']['id']; ?>"><?php echo $customers['Customer']['description']; ?></option>
               <?php }?>
            </select> </div>
     <div class="col-2">
            <select  id="attachments" class="form-control"  title="Type File">
                <option value="0"><?php echo __("Type File");?></option>
                <?php foreach ($extensions as $extension) {
                 ?>
                  <option value="<?php echo $extension['Attachment']['extension']; ?>"><?php echo $extension['Attachment']['extension']; ?></option>
              <?php } ?>
            </select>
          </div>
          <hr style="border-top: 1px solid #3d6468;width: 66%;">
          <div class="col-md-3">
           <span><?php __("From");?></span><input type="date" value="" id="date"  class="form-control">
    </div>
   <input type="reset" value="Reset" class="form-control round-button col-md-offset-5"style="width: 66px;"> 

    <div class="col-md-3 col-md-offset-4">
             
           <span><?php __("To");?></span><input type="date" value="" id="todate" class="form-control" >
            </div>
            </div>        
        
</form>
  
 </div>


</div>

</div>
 </div>
<div class="col-md-6" id="body-content">    

</div>
<div class="col-md-6" id="body-detail">    

</div>


<div class="col-md-12">
<div ba-panel="" ba-panel-class="with-scroll" id="listefavourite" 
style="display:none;position: fixed;bottom: -20px;right: 15px;">
    <div  class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur=""style="width: 237px;height: 307px;">

<div class="panel-heading clearfix">

</div>
<div class="panel" style="height: 240px;overflow: auto;">
<?php $favourite=0;
$documentFaforite=array();
foreach ($actions as $action)
 {
  if($action['Action']['type']=="favourite")
    {
      $favourite++; 
$documentFaforite[]=$action['Action']['document_id'];
    }
 }

foreach ($document_actionnes as $document_actionne) {
  for ($i=0; $i <count($documentFaforite) ; $i++) { 
    if($document_actionne['Document']['id']==$documentFaforite[$i])
    {?>
   <button  style=" background: none;border: none; display: flex;width: 100%;"
onclick=openDocumentFavourite("<?php echo $document_actionne['Document']['id'];?>")>
<?php echo  $document_actionne['Document']['name'];?>
</button>
     <?php
    }
  }
 
}
?>
</div>
</div>
   </div></div>

<div class="col-md-12">
<div ba-panel="" ba-panel-class="with-scroll" id="openfavourite" 
style="position: fixed;bottom: 0px;right: 15px;cursor: pointer;">
    <div  class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur=""style="width: 237px;height: 47px;bottom: -22px;">

<div class="panel-heading clearfix">
  <span class="glyphicon glyphicon-heart"></span>
  
  <?php echo __("My Favourites");?> (<?php echo $favourite; ?>)
  <span class="glyphicon glyphicon-chevron-up" id="spanfavourite"></span>

</div>
</div></div></div>
 <datalist id="query">
  <?php foreach ($documents as $document) {
    ?>
 <option value="<?php echo $document['documents']['description']; ?>">
    <?php
  }?>
   </datalist>

