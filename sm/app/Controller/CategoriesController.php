<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {


public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==2)
      {
		
			$data=array('id'=>$index[0],'description'=>$index[1]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Category->save($data);
	}else if(count($index)==1)
	{
	$data=array('description'=>$index[0]);
	$this->Category->create();
	$this->Category->save($data);
	}else if(count($index)>2)
	{
$this->Category->id = $index[0];
$this->Category->delete();
	}
	}

		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());

}

}
