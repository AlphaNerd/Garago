<div class="auth-block">
    <h1>Sign up to Garago Software</h1>
    <?php 
echo $this->Html->link( "New to Garago Software? Sign In!",   array('controller'=>'users','action'=>'logout'),array('class'=>'auth-link') ); 
?>
<?php echo $this->Form->create('User'); ?> 
    <form class="form-horizontal">

                            <div class="form-group">
                               <?php echo $this->Form->input('username',array('placeholder'=>'Name','label'=>false,'class'=>'form-control ')); ?>
                               
                            </div>
                             <div class="form-group">
                              
                                <?php echo $this->Form->input('first_name',array('placeholder'=>'First Name','label'=>false,'class'=>'form-control ')); ?>
                            </div>
                            
                            <div class="form-group">
                                <?php echo $this->Form->input('email',array('placeholder'=>'Email','label'=>false,'class'=>'form-control ')); ?>
                                
                            </div>
                            <div class="form-group">
                                
                                <?php echo $this->Form->input('password',array('placeholder'=>'Password','label'=>false,'class'=>'form-control ')); ?>
                            </div>
                            <div class="form-group">
                               <?php echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'placeholder' => 'Confirm password', 'type'=>'password','class'=>'form-control ','label'=>false)); ?>
                               
                            </div>
                         <?php   echo $this->Form->hidden('role', array(
            'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
        ));?>
                           
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn " style="background-color: rgba(36, 59, 50, 0.38);color: aliceblue;margin-left: -74px;">Sign Up</button>
         
        </div>
      </div>
     <br>
     <div><span>____________________ </span>or Sign up with one click<sapn>  ____________________ </span>

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

   
                            
