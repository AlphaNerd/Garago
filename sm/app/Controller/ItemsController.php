<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {
	
public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==4)
      {
		
			$data=array('id'=>$index[0],'name'=>$index[1],'price'=>$index[2],'description'=>$index[3]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Item->save($data);
	}else if(count($index)==3)
	{
	$data=array('name'=>$index[0],'price'=>$index[1],'description'=>$index[2]);
	$this->Item->create();
	$this->Item->save($data);
	}else if(count($index)==1)
	{
$this->Item->id = $index[0];
$this->Item->delete();
	}
	}

		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());

}
}
