<?php
App::uses('AppController', 'Controller');
/**
 * Budgets Controller
 *
 * @property Budget $Budget
 */
class BudgetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Budget->recursive = 0;
		$this->set('budgets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Budget->exists($id)) {
			throw new NotFoundException(__('Invalid budget'));
		}
		$options = array('conditions' => array('Budget.' . $this->Budget->primaryKey => $id));
		$this->set('budget', $this->Budget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Budget->create();
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'));
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
		if (!$this->Budget->exists($id)) {
			throw new NotFoundException(__('Invalid budget'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Budget.' . $this->Budget->primaryKey => $id));
			$this->request->data = $this->Budget->find('first', $options);
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
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Budget->delete()) {
			$this->Session->setFlash(__('Budget deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Budget was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
