<?php
App::uses('AppController', 'Controller');
/**
 * GroupeUsers Controller
 *
 * @property GroupeUser $GroupeUser
 */
class GroupeUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupeUser->recursive = 0;
		$this->set('groupeUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupeUser->exists($id)) {
			throw new NotFoundException(__('Invalid groupe user'));
		}
		$options = array('conditions' => array('GroupeUser.' . $this->GroupeUser->primaryKey => $id));
		$this->set('groupeUser', $this->GroupeUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupeUser->create();
			if ($this->GroupeUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groupe user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupe user could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupeUser->User->find('list');
		$groups = $this->GroupeUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupeUser->exists($id)) {
			throw new NotFoundException(__('Invalid groupe user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupeUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groupe user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupe user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupeUser.' . $this->GroupeUser->primaryKey => $id));
			$this->request->data = $this->GroupeUser->find('first', $options);
		}
		$users = $this->GroupeUser->User->find('list');
		$groups = $this->GroupeUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GroupeUser->id = $id;
		if (!$this->GroupeUser->exists()) {
			throw new NotFoundException(__('Invalid groupe user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupeUser->delete()) {
			$this->Session->setFlash(__('Groupe user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Groupe user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
