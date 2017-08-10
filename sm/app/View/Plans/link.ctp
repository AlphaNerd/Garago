<script type="text/javascript">

$(document).ready(function(){
$(".notificationdiv").html("<div><a><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></a>Thank you for your participation. Your comment has been submitted!</div>");
// $(".notificationdiv").show();

});
</script>
<style type="text/css">
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: rgba(234, 227, 227, 0.33);
    padding: 20px;
}
.notificationdiv>div {
     width: 542px; 
    margin: 0 auto;
    border-radius: 10px;
    background: #dfb81c;
    color: #fff;
    padding: 16px;
    margin-top: -16%;
    position: fixed;
    margin-left: 30%;
}
.header{
  width: 100%;
  height: 40px;
  background-color: rgba(255,255,255,1);
}
.body{
margin-top: 2px;
}
.logoPlan
{
    padding: 10px;
    width: 126px;
    float: left;
     background-color: rgba(255,255,255,1);
}

.item>div
{
      margin-left: 130px;
    padding: 10px;
    background-color: rgba(255,255,255,1);
    height: 45px;
    margin-top: 2px;
}
.item>div:hover
{
background: rgba(36, 36, 243, 0.68);
}
.form-control{
 background-color: rgba(255,255,255,1);
   margin: 8px;
    border-style: double;
    border-color: rgba(154, 205, 50, 0.5);
    color: rgba(0,0,0,0.5);
}
.contact{
  padding-bottom: 20px;

}
</style>
<body>
<div class="header"><?php echo  __("Planification");?> </div>

<div class="body">
  <div class="logoPlan">
        <img src="./sm/<?php  echo $plans['Plan']['logo'];?>"style=" width: 120px;height: 120px;">
      </div>
      <div class="item">
         <div ><?php  echo $plans['Plan']['adress'];?>
         </div>
          <div><?php  echo $plans['Plan']['titre'];?>
         </div>
          <div><?php  echo $plans['Plan']['date_creation'];?>
         </div>
        
      </div>
</div>
<hr>
<table  class="table"  cellspacing="0" >
        <thead>
            <tr id="typecomposante">
              <?php for ($i=1; $i <$coordonners[0] ; $i++) { 
               ?>
                <td bgcolor="<?php  echo $detailplans[1][$i]['color'];?>"> 
                 
  <?php  echo explode('-',$detailplans[1][$i]['type'])[0];?>
   
              </td>
               <?php }?>
            </tr>
        </thead>
        <tbody>
<?php for ($i=2; $i <$coordonners[0] ; $i++) { ?>
<tr>
 
  <?php for ($j=1; $j <$coordonners[1] ; $j++) {
   ?>
  <td bgcolor="<?php  echo $detailplans[$i][$j]['color'];?>" >
    <div style="
         display: flex;
    float: right;
    width: 10px;
    height: 10px;
">
  <?php echo $i.'.'.$j ?>


</div>
<div  style="min-height:50px;min-width:50px;">
  <?php 

$x=str_replace("a9a", "/",$detailplans[$i][$j]['data']);
$x=str_replace("..", ":",$x);
$y= html_entity_decode($x);
//echo $y;
  echo htmlspecialchars_decode($y); ?>
</div>

</td>
 <?php }?>
  </tr>
  <?php } ?>
        </tbody>  
    </table>


<datalist id="query">
  <option value="ALL"></option>
<?php for ($i=2; $i <$coordonners[0] ; $i++) { ?> 
 <?php for ($j=1; $j <$coordonners[1] ; $j++) {?> 
<option value="<?php echo $i.'.'.$j ?>">
  </option>
<?php
} }?>
   </datalist>
<form action="." method="POST">
  <input type="hidden" value="<?php echo $plans['Plan']['id']?>" name="id">
<div class="col-md-6 contact" >
<input name="ref" type="text" list="query" class="form-control input-lg" placeholder="<?php echo ('Enter your Numero cellule');?>">
<input  name="email" class="form-control input-lg" placeholder="<?php echo ('Enter your Email');?>">
<input name="name" class="form-control input-lg" placeholder="<?php echo ('Enter your name'):?>">
<input name="organization" class="form-control input-lg" placeholder="Enter your organization">
<button class="form-control input-lg"><?php echo  __("Envoyer");?></button>
</div>
<div class="col-md-6 contact">
  <textarea class="form-control input-lg" rows="8" name="message"><?php echo __("Message...");?>
  </textarea></div>
</form>
</body>
<div style="display:none "class="notificationdiv"  id="notification">
  <div>