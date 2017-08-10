<?php
App::uses('AppController', 'Controller');
/**
 * Sectors Controller
 *
 * @property Sector $Sector
 */
class SectorsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==2)
      {
		
			$data=array('id'=>$index[0],'description'=>$index[1]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Sector->save($data);
	}else if(count($index)==1)
	{
	$data=array('description'=>$index[0]);
	$this->Sector->create();
	$this->Sector->save($data);
	}else if(count($index)>2)
	{
$this->Sector->id = $index[0];
$this->Sector->delete();
	}
	}

		$this->Sector->recursive = 0;
		$this->set('sectors', $this->paginate());

}
	
}
