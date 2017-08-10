<?php
App::uses('AppController', 'Controller');
/**
 * InvoiceDetails Controller
 *
 * @property InvoiceDetail $InvoiceDetail
 */
class InvoiceDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InvoiceDetail->recursive = 0;
		$this->set('invoiceDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InvoiceDetail->exists($id)) {
			throw new NotFoundException(__('Invalid invoice detail'));
		}
		$options = array('conditions' => array('InvoiceDetail.' . $this->InvoiceDetail->primaryKey => $id));
		$this->set('invoiceDetail', $this->InvoiceDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InvoiceDetail->create();
			if ($this->InvoiceDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The invoice detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invoice detail could not be saved. Please, try again.'));
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
		if (!$this->InvoiceDetail->exists($id)) {
			throw new NotFoundException(__('Invalid invoice detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InvoiceDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The invoice detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invoice detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InvoiceDetail.' . $this->InvoiceDetail->primaryKey => $id));
			$this->request->data = $this->InvoiceDetail->find('first', $options);
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
		$this->InvoiceDetail->id = $id;
		if (!$this->InvoiceDetail->exists()) {
			throw new NotFoundException(__('Invalid invoice detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InvoiceDetail->delete()) {
			$this->Session->setFlash(__('Invoice detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Invoice detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
