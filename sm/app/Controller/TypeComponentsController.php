<?php
App::uses('AppController', 'Controller');
/**
 * TypeComponents Controller
 *
 * @property TypeComponent $TypeComponent
 */
class TypeComponentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TypeComponent->recursive = 0;
		$this->set('typeComponents', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TypeComponent->exists($id)) {
			throw new NotFoundException(__('Invalid type component'));
		}
		$options = array('conditions' => array('TypeComponent.' . $this->TypeComponent->primaryKey => $id));
		$this->set('typeComponent', $this->TypeComponent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TypeComponent->create();
			if ($this->TypeComponent->save($this->request->data)) {
				$this->Session->setFlash(__('The type component has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type component could not be saved. Please, try again.'));
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
		if (!$this->TypeComponent->exists($id)) {
			throw new NotFoundException(__('Invalid type component'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TypeComponent->save($this->request->data)) {
				$this->Session->setFlash(__('The type component has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type component could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TypeComponent.' . $this->TypeComponent->primaryKey => $id));
			$this->request->data = $this->TypeComponent->find('first', $options);
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
		$this->TypeComponent->id = $id;
		if (!$this->TypeComponent->exists()) {
			throw new NotFoundException(__('Invalid type component'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TypeComponent->delete()) {
			$this->Session->setFlash(__('Type component deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Type component was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
