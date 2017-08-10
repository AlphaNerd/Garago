<?php
App::uses('AppController', 'Controller');
/**
 * Typebankaccounts Controller
 *
 * @property Typebankaccount $Typebankaccount
 */
class TypebankaccountsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Typebankaccount->recursive = 0;
		$this->set('typebankaccounts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Typebankaccount->exists($id)) {
			throw new NotFoundException(__('Invalid typebankaccount'));
		}
		$options = array('conditions' => array('Typebankaccount.' . $this->Typebankaccount->primaryKey => $id));
		$this->set('typebankaccount', $this->Typebankaccount->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Typebankaccount->create();
			if ($this->Typebankaccount->save($this->request->data)) {
				$this->Session->setFlash(__('The typebankaccount has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typebankaccount could not be saved. Please, try again.'));
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
		if (!$this->Typebankaccount->exists($id)) {
			throw new NotFoundException(__('Invalid typebankaccount'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Typebankaccount->save($this->request->data)) {
				$this->Session->setFlash(__('The typebankaccount has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typebankaccount could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Typebankaccount.' . $this->Typebankaccount->primaryKey => $id));
			$this->request->data = $this->Typebankaccount->find('first', $options);
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
		$this->Typebankaccount->id = $id;
		if (!$this->Typebankaccount->exists()) {
			throw new NotFoundException(__('Invalid typebankaccount'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Typebankaccount->delete()) {
			$this->Session->setFlash(__('Typebankaccount deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Typebankaccount was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
