<?php

class LanguesController extends Controller {

    public function index($lang) {
    	echo $lang;
    	die();
        $this->Session->write('Config.language', $lang);
        $detail= array(
'id'=>1,
'langue'=>$lang

  );
  
        $this->redirect(array('controller' =>'pages', 'action' => 'index'));
    }

}

?>