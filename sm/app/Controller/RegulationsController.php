<?php
App::uses('AppController', 'Controller');
/**
 * Regulations Controller
 *
 * @property Regulation $Regulation
 */
class RegulationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Regulation->recursive = 0;
		$this->set('regulations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Regulation->exists($id)) {
			throw new NotFoundException(__('Invalid regulation'));
		}
		$options = array('conditions' => array('Regulation.' . $this->Regulation->primaryKey => $id));
		$this->set('regulation', $this->Regulation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Regulation->create();
			if ($this->Regulation->save($this->request->data)) {
				$this->Session->setFlash(__('The regulation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The regulation could not be saved. Please, try again.'));
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
		if (!$this->Regulation->exists($id)) {
			throw new NotFoundException(__('Invalid regulation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Regulation->save($this->request->data)) {
				$this->Session->setFlash(__('The regulation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The regulation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Regulation.' . $this->Regulation->primaryKey => $id));
			$this->request->data = $this->Regulation->find('first', $options);
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
		$this->Regulation->id = $id;
		if (!$this->Regulation->exists()) {
			throw new NotFoundException(__('Invalid regulation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Regulation->delete()) {
			$this->Session->setFlash(__('Regulation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Regulation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
