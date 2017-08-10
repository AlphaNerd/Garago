<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 */
class TasksController extends AppController {
public function index($liste=null) {
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==4)
      {
			$data=array('id'=>$index[0],'description'=>$index[1],'references'=>$index[2],'Task_id'=>$index[3]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->Task->save($data);
	}else if(count($index)==3)
	{
	$data=array('description'=>$index[0],'references'=>$index[1],'Task_id'=>$index[2]);
	$this->Task->create();
	$this->Task->save($data);
	}else if(count($index)==1)
	{
$this->Task->id = $index[0];
$this->Task->delete();
	}
	}
		$this->loadModel('Item');
		$items=$this->Item->find('all');
	
		$Tasks=$this->Task->find("all");
		$this->set(compact('Tasks','items'));

}
}
