

<div class="auth-block">
    <h1>Sign in to Garago Software</h1>
    <?php 
echo $this->Html->link( "New to Garago Software? Sign up!",   array('controller'=>'users','action'=>'add'),array('class'=>'auth-link') ); 
?>
<?php echo $this->Form->create('User'); ?> 
    <form class="form-horizontal">
    
       <div class="form-group">
                                 <?php echo $this->Form->input('username',array('placeholder'=>'Email','label'=>false,'class'=>'form-control')); ?>
                            </div>
                            <div class="form-group">

                                <?php echo $this->Form->input('password',array('placeholder'=>'Password','label'=>false,'class'=>'form-control')); ?>

                            </div>
      
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn " style="background-color: rgba(36, 59, 50, 0.38);color: aliceblue;margin-left: -74px;">Sign in</button>
          <a href="" class="forgot-pass">Forgot password?</a>
        </div>
      </div>
     <br>
     <div><span>____________________ </span>or Sign in with one click<sapn>  ____________________ </span>

 </div>
    </form>
<br>
  <?php echo $this->Form->end(__('')); ?>
    

    <div class="al-share-auth">
      <button type="button" class="btn btn-fb" style=" background: #6e78ec;"><i class="fa fa-facebook">
                            <?php   echo $this->Html->link("", array(
    "alt" => "Signin with Facebook",
    'url' => array('action'=>'social_login', 'Facebook')

));?></i></button>

  <button type="button" class="btn btn-gplus" style=" background: red;"><i class="fa fa-google-plus">
                            <?php   echo $this->Html->link("", array(
    "alt" => "Signin with Google",
    'url' => array('action'=>'social_login', 'Google')

));?></i></button>
                         <button type="button" class="btn btn-tw" style="background: cornflowerblue;"><i class="fa fa-twitter">       
                            <?php    echo $this->Html->link("", array(
    "alt" => "Signin with Twitter",
    'url' => array('action'=>'social_login', 'Twitter')
));

?>       </i></button>   <button type="button" class="btn btn-li" style="background: steelblue;"><i class="fa fa-linkedin">
                                 <?php 
                 echo $this->Html->link("", array(
    "alt" => "Signin with Twitter",
    'url' => array('action'=>'social_login', 'LinkedIn')
));

?>
           </i></button>    
    </div>
  </div>

   
                            
                              