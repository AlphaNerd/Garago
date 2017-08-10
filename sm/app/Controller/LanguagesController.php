<?php
App::uses('AppController', 'Controller');

class LanguagesController extends AppController {

	public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==3)
      {
		
			$data=array('id'=>$index[0],'name'=>$index[1],'abbreviation'=>$index[2]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Language->save($data);
	}else if(count($index)==2)
	{
	$data=array('name'=>$index[0],'abbreviation'=>$index[1]);
	$this->Language->create();
	$this->Language->save($data);
	}else if(count($index)==1)
	{
$this->Language->id = $index[0];
$this->Language->delete();
	}
	}

		$this->Language->recursive = 0;
		$this->set('languages', $this->paginate());

}

}
