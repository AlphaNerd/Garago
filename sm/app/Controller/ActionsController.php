<?php
App::uses('AppController', 'Controller');
/**
 * Actions Controller
 *
 * @property Action $Action
 */
class ActionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {

$user_id = $this->Session->read("id");
$this->loadModel('SocialProfiles');
$this->loadModel('Document');
$user_id='12';
	$documents=$this->Document->find('all',array('conditions'=>array('Document.profile_id'=>$user_id)));
	
		foreach ($documents as $document) {
$document_id[]=$document['Document']['id'];
		}
		$Actions=$this->Action->find('all',array('conditions'=>array('Action.document_id'=>$document_id),'limit'=>20)); 
foreach ($Actions as $action)
 {
	$tab[]=array(
		'id'=>$action['Action']['id'],
		'document'=>$this->Document->find('first',array('conditions'=>array('Document.id'=>$action['Action']['document_id'])))['Document'],
	'profile'=>$this->SocialProfiles->find('first',array('conditions'=>
		array('SocialProfiles.user_id'=>
				$action['Action']['profile_id']))),
		'type'=>$action['Action']['type'],
		'date_action'=>$action['Action']['date_action']);		
}


$this->set(compact('tab'));

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Invalid action'));
		}
		$options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
		$this->set('action', $this->Action->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Action->create();
			if ($this->Action->save($this->request->data)) {
				$this->Session->setFlash(__('The action has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The action could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Invalid action'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Action->save($this->request->data)) {
				$this->Session->setFlash(__('The action has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The action could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
			$this->request->data = $this->Action->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Action->id = $id;
		if (!$this->Action->exists()) {
			throw new NotFoundException(__('Invalid action'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Action->delete()) {
			$this->Session->setFlash(__('Action deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Action was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
