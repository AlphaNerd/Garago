<?php
App::uses('AppController', 'Controller');
/**
 * Actions Controller
 *
 * @property Action $Action
 */
class CollaborationsController extends AppController {
	public function index()
	{
		$this->loadModel('Group');
		$this->loadModel('GroupeUser');
		$this->loadModel('User');
		$this->loadModel('Plan');
		 $this->loadModel('Project');
            $this->loadModel('Tach');
		$id=$this->Session->read('id');
		$groupes=$this->Group->find('all',['conditions'=>['Group.responsable'=>$id]]);
		$plans=$this->Plan->find('all',array('conditions'=>array('Plan.profile_id'=>$id)));
            $projects=$this->Project->find('all',['conditions'=>['Project.plan_id'=>$plans[0]['Plan']['id']]]);
              $taches=$this->Tach->find('all',['conditions'=>['Tach.project_id'=>$projects[0]['Project']['id']]]);
       foreach ($groupes as $groupe)
             $groupe[]=$groupe['Group']['id'];
             $groupeusers=$this->GroupeUser->find('all',['conditions'=>['GroupeUser.group_id']]);
       foreach ($groupeusers as $groupeuser)
            $groupesUsers[]=$groupeuser['GroupeUser']['users_id'];
             $users=$this->User->find('all',['conditions'=>['User.id'=>$groupesUsers]]);
             $id=$this->Session->read('id');
            $plans=$this->Plan->find('first',array('conditions'=>array('Plan.profile_id'=>$id)));
             $projects=$this->Project->find('first',
                  ['conditions'=>['Project.plan_id'=>$plans['Plan']['id']]]);
            $taches=$this->Tach->find('all',
            ['conditions'=>['Tach.project_id'=>$projects['Project']['id']]]);
           
            $comments="";
            $plans=$this->Plan->find('all',['conditions'=>['Plan.profile_id'=>$id]]);
            if($plans)
            {
            foreach ($plans as $plan) 
                  $id_plans[]=$plan['Plan']['id'];
                  $this->loadModel('Comment');
                  $comments=$this->Comment->find('all',array('conditions'=>['plan_id'=>$id_plans]));
            }

       $this->set(compact('projects','taches','plans','groupes','users','comments'));
}










	public function task($liste=null)
	{
		$taches=array();
		$this->loadModel('Tach');
		$this->loadModel('Plan');
			 $this->loadModel('Project');
			 $Projects=null;
      if($liste!=null)
      {
      	$liste=explode(',', $liste);
      	if($liste[0]=='Project')
      	{
         $taches=$this->Tach->find('all',['conditions'=>['Tach.project_id'=>$liste[1]]]);
      	}
      	else if ($liste[0]=="Plan")
      	 {
      	 	 $projects=$this->Project->find('all',
      	 	 	['conditions'=>['Project.plan_id'=>$liste[1]]]);
      	
      	 	 foreach ($projects as $project)
      	 	  {
                $Projects[]=$project['Project']['id'];
              }
       $taches=$this->Tach->find('all',['conditions'=>['Tach.project_id'=>$Projects]]);
      	 } 
      	 elseif($liste[0]=="Task")
      	 {
      	 	$taches=$this->Tach->find('all',['conditions'=>['Tach.id'=>$liste[1]]]);
      	 }
      }else
      {
      	
     $this->set(compact('taches'));
	}
}
}