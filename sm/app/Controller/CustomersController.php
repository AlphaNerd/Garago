<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {


	public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==2)
      {
		
			$data=array('id'=>$index[0],'description'=>$index[1]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Customer->save($data);
	}else if(count($index)==1)
	{
	$data=array('description'=>$index[0]);
	$this->Customer->create();
	$this->Customer->save($data);
	}else if(count($index)>2)
	{
$this->Customer->id = $index[0];
$this->Customer->delete();
	}
	}

		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate());

}

}
