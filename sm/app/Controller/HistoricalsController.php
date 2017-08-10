<?php
App::uses('AppController', 'Controller');
/**
 * Historicals Controller
 *
 * @property Historical $Historical
 */
class HistoricalsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Historical->recursive = 0;
		$this->set('historicals', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Historical->exists($id)) {
			throw new NotFoundException(__('Invalid historical'));
		}
		$options = array('conditions' => array('Historical.' . $this->Historical->primaryKey => $id));
		$this->set('historical', $this->Historical->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historical->create();
			if ($this->Historical->save($this->request->data)) {
				$this->Session->setFlash(__('The historical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historical could not be saved. Please, try again.'));
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
		if (!$this->Historical->exists($id)) {
			throw new NotFoundException(__('Invalid historical'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historical->save($this->request->data)) {
				$this->Session->setFlash(__('The historical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historical could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Historical.' . $this->Historical->primaryKey => $id));
			$this->request->data = $this->Historical->find('first', $options);
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
		$this->Historical->id = $id;
		if (!$this->Historical->exists()) {
			throw new NotFoundException(__('Invalid historical'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Historical->delete()) {
			$this->Session->setFlash(__('Historical deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Historical was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
