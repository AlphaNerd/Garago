<?php
App::uses('AppController', 'Controller');
/**
 * JobeDetails Controller
 *
 * @property JobeDetail $JobeDetail
 */
class JobeDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->JobeDetail->recursive = 0;
		$this->set('jobeDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid jobe detail'));
		}
		$options = array('conditions' => array('JobeDetail.' . $this->JobeDetail->primaryKey => $id));
		$this->set('jobeDetail', $this->JobeDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobeDetail->create();
			if ($this->JobeDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The jobe detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobe detail could not be saved. Please, try again.'));
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
		if (!$this->JobeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid jobe detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->JobeDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The jobe detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobe detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('JobeDetail.' . $this->JobeDetail->primaryKey => $id));
			$this->request->data = $this->JobeDetail->find('first', $options);
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
		$this->JobeDetail->id = $id;
		if (!$this->JobeDetail->exists()) {
			throw new NotFoundException(__('Invalid jobe detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobeDetail->delete()) {
			$this->Session->setFlash(__('Jobe detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Jobe detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
