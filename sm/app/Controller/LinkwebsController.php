<?php
App::uses('AppController', 'Controller');
/**
 * Linkwebs Controller
 *
 * @property Linkweb $Linkweb
 */
class LinkwebsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Linkweb->recursive = 0;
		$this->set('linkwebs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Linkweb->exists($id)) {
			throw new NotFoundException(__('Invalid linkweb'));
		}
		$options = array('conditions' => array('Linkweb.' . $this->Linkweb->primaryKey => $id));
		$this->set('linkweb', $this->Linkweb->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Linkweb->create();
			if ($this->Linkweb->save($this->request->data)) {
				$this->Session->setFlash(__('The linkweb has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linkweb could not be saved. Please, try again.'));
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
		if (!$this->Linkweb->exists($id)) {
			throw new NotFoundException(__('Invalid linkweb'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Linkweb->save($this->request->data)) {
				$this->Session->setFlash(__('The linkweb has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linkweb could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Linkweb.' . $this->Linkweb->primaryKey => $id));
			$this->request->data = $this->Linkweb->find('first', $options);
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
		$this->Linkweb->id = $id;
		if (!$this->Linkweb->exists()) {
			throw new NotFoundException(__('Invalid linkweb'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linkweb->delete()) {
			$this->Session->setFlash(__('Linkweb deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Linkweb was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
