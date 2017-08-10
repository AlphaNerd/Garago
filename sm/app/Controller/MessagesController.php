<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$user_id = $this->Session->read("id");
		$this->loadModel('SocialProfiles');
		$messages=$this->Message->find('all',array('conditions'=>['Message.id_profile_recu'=>$user_id]));
foreach ($messages as $message) {
	$tab[]=array(
		'id'=>$message['Message']['id'],
		'description'=>$message['Message']['description'],
		'date_message'=>$message['Message']['date_message'],
		'vu'=>$message['Message']['vu'],
		'profile'=>$this->SocialProfiles->find('first',array('conditions'=>['SocialProfiles.user_id'=>$message['Message']['id_profile_send']])),
		'id_profile_recu'=>$message['Message']['id_profile_recu']
		);

		$this->set(compact('tab',$tab));

	}
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($liste=null) {
$tab=explode(',', $liste);
$user_id = $this->Session->read("id");
if($liste[1]!="0")
{
	$message=array(
		'description'=>$tab[1],
		'date_message'=>date("F j, Y, g:i a"),
		'vu'=>'non',
		'id_profile_send'=>$tab[0],
		'id_profile_recu'=>$user_id
		);
	$this->Message->create();
	$this->Message->save($message);
}

$condition=array(
	'Message.id_profile_recu'=>$user_id,
	'Message.id_profile_send'=>$tab[0]
	);
$messages=$this->Message->find('all',array(
	'conditions'=>$condition));
$this->set(compact('messages'));

		// if ($this->request->is('post')) {
		// 	$this->Message->create();
		// 	if ($this->Message->save($this->request->data)) {
		// 		$this->Session->setFlash(__('The message has been saved'));
		// 		$this->redirect(array('action' => 'index'));
		// 	} else {
		// 		$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
		// 	}
		// }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Message was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
