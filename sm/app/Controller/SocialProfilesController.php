<?php
App::uses('AppController', 'Controller');
/**
 * SocialProfiles Controller
 *
 * @property SocialProfile $SocialProfile
 */
class SocialProfilesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SocialProfile->recursive = 0;
		$this->set('socialProfiles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SocialProfile->exists($id)) {
			throw new NotFoundException(__('Invalid social profile'));
		}
		$options = array('conditions' => array('SocialProfile.' . $this->SocialProfile->primaryKey => $id));
		$this->set('socialProfile', $this->SocialProfile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SocialProfile->create();
			if ($this->SocialProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The social profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->SocialProfile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SocialProfile->exists($id)) {
			throw new NotFoundException(__('Invalid social profile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SocialProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The social profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social profile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SocialProfile.' . $this->SocialProfile->primaryKey => $id));
			$this->request->data = $this->SocialProfile->find('first', $options);
		}
		$users = $this->SocialProfile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SocialProfile->id = $id;
		if (!$this->SocialProfile->exists()) {
			throw new NotFoundException(__('Invalid social profile'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SocialProfile->delete()) {
			$this->Session->setFlash(__('Social profile deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Social profile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
