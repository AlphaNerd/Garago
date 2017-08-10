<?php
App::uses('AppController', 'Controller');
/**
 * ModePayments Controller
 *
 * @property ModePayment $ModePayment
 */
class ModePaymentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ModePayment->recursive = 0;
		$this->set('modePayments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ModePayment->exists($id)) {
			throw new NotFoundException(__('Invalid mode payment'));
		}
		$options = array('conditions' => array('ModePayment.' . $this->ModePayment->primaryKey => $id));
		$this->set('modePayment', $this->ModePayment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ModePayment->create();
			if ($this->ModePayment->save($this->request->data)) {
				$this->Session->setFlash(__('The mode payment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mode payment could not be saved. Please, try again.'));
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
		if (!$this->ModePayment->exists($id)) {
			throw new NotFoundException(__('Invalid mode payment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ModePayment->save($this->request->data)) {
				$this->Session->setFlash(__('The mode payment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mode payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ModePayment.' . $this->ModePayment->primaryKey => $id));
			$this->request->data = $this->ModePayment->find('first', $options);
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
		$this->ModePayment->id = $id;
		if (!$this->ModePayment->exists()) {
			throw new NotFoundException(__('Invalid mode payment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ModePayment->delete()) {
			$this->Session->setFlash(__('Mode payment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mode payment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
