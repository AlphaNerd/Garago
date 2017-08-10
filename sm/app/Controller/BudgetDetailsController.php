<?php
App::uses('AppController', 'Controller');
/**
 * BudgetDetails Controller
 *
 * @property BudgetDetail $BudgetDetail
 */
class BudgetDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BudgetDetail->recursive = 0;
		$this->set('budgetDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BudgetDetail->exists($id)) {
			throw new NotFoundException(__('Invalid budget detail'));
		}
		$options = array('conditions' => array('BudgetDetail.' . $this->BudgetDetail->primaryKey => $id));
		$this->set('budgetDetail', $this->BudgetDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BudgetDetail->create();
			if ($this->BudgetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The budget detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget detail could not be saved. Please, try again.'));
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
		if (!$this->BudgetDetail->exists($id)) {
			throw new NotFoundException(__('Invalid budget detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BudgetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The budget detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BudgetDetail.' . $this->BudgetDetail->primaryKey => $id));
			$this->request->data = $this->BudgetDetail->find('first', $options);
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
		$this->BudgetDetail->id = $id;
		if (!$this->BudgetDetail->exists()) {
			throw new NotFoundException(__('Invalid budget detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BudgetDetail->delete()) {
			$this->Session->setFlash(__('Budget detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Budget detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
