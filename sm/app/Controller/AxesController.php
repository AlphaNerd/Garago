<?php
App::uses('AppController', 'Controller');
/**
 * Axes Controller
 *
 * @property Axis $Axis
 */
class AxesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Axis->recursive = 0;
		$this->set('axes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Axis->exists($id)) {
			throw new NotFoundException(__('Invalid axis'));
		}
		$options = array('conditions' => array('Axis.' . $this->Axis->primaryKey => $id));
		$this->set('axis', $this->Axis->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Axis->create();
			if ($this->Axis->save($this->request->data)) {
				$this->flash(__('Axis saved.'), array('action' => 'index'));
			} else {
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
		if (!$this->Axis->exists($id)) {
			throw new NotFoundException(__('Invalid axis'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Axis->save($this->request->data)) {
				$this->flash(__('The axis has been saved.'), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('Axis.' . $this->Axis->primaryKey => $id));
			$this->request->data = $this->Axis->find('first', $options);
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
		$this->Axis->id = $id;
		if (!$this->Axis->exists()) {
			throw new NotFoundException(__('Invalid axis'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Axis->delete()) {
			$this->flash(__('Axis deleted'), array('action' => 'index'));
		}
		$this->flash(__('Axis was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
