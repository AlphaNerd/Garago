<?php
App::uses('AppController', 'Controller');
/**
 * PermissionAccesses Controller
 *
 * @property PermissionAccess $PermissionAccess
 */
class PermissionAccessesController extends AppController {
public function index($liste=null) {

      if($liste){
      $index=explode(',-,',$liste);
     
      if(count($index)==7)
      {
			$data=array(
				'id'=>$index[0],
				'permission'=>$index[1],
				'date_start'=>$index[2],
				'date_end'=>$index[3],
				'user_id'=>$index[4],
				'personal_offers_id'=>$index[5],
				'task_id'=>$index[6]);
		if ($this->request->is('post') || $this->request->is('put')) 
			$this->PermissionAccess->save($data);
	}else if(count($index)==6)
	{
	$data=array(
				'permission'=>$index[0],
				'date_start'=>$index[1],
				'date_end'=>$index[2],
				'user_id'=>$index[3],
				'personal_offers_id'=>$index[4],
				'task_id'=>$index[5]);
	$this->PermissionAccess->create();
	$this->PermissionAccess->save($data);
	}else if(count($index)==1)
	{
$this->PermissionAccess->id = $index[0];
$this->PermissionAccess->delete();
	}
	}
		$this->loadModel('PermissionAccess');
		$this->loadModel("User");
		$this->loadModel("Group");
		$this->loadModel("Task");
		$this->loadModel('Item');
		$this->loadModel("PersonalOffer");
		$this->loadModel("Offer");
		$Offers=$this->Offer->find("all");
		$PersonalOfefrs=$this->PersonalOffer->find('all');
		$PermissionAccesss=$this->PermissionAccess->find('all');
		$Items=$this->Item->find("all");
		$Users=$this->User->find("all");
		$Groups=$this->Group->find("all");
		$Tasks=$this->Task->find("all");


	$this->set(compact('Users','PermissionAccesss','Groups','Tasks','Items','PersonalOfefrs','Offers'));

}
}
