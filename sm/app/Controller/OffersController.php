<?php
App::uses('AppController', 'Controller');
/**
 * Offers Controller
 *
 * @property Offer $Offer
 */
class OffersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($liste=null) {
		$this->Offer->recursive = 0;
		$this->set('offers', $this->paginate());
        $this->loadModel('Regulation');
        $this->loadModel('Item');
        $Items = $this->Item->find('all');
        $Regulations = $this->Regulation->find('all');
        $this->set(compact('Items', 'Regulations'));
		if($liste)
		{
			$index=explode(',-,',$liste);
			$data=array(
				'name'=>$index[0],
				 'date'=>date("Y-m-d"),
				 'total_price'=>$index[1],
				 'description'=>$index[2],
				 'period'=>$index[3]
				 );
        $this->Regulation->create();
        $this->Regulation->save($data);
        $Regulation_id=$this->Regulation->getLastInsertID();
        $listeItem=explode(',',$index[3]);
        for ($i=0; $i <count($listeItem); $i++) { 
        	$offers=array(
        		'nombre'=>'1',
        		'price_ligne'=>'0',
        		'regulation_id'=>$Regulation_id,
        		'items_id'=>$listeItem[$i]);
        	$this->Offer->create();
			$this->Offer->save($offers);
        }
		}
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Offer->exists($id)) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$options = array('conditions' => array('Offer.' . $this->Offer->primaryKey => $id));
		$this->set('offer', $this->Offer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Offer->create();
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
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
		if (!$this->Offer->exists($id)) {
			throw new NotFoundException(__('Invalid offer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Offer.' . $this->Offer->primaryKey => $id));
			$this->request->data = $this->Offer->find('first', $options);
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
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Offer->delete()) {
			$this->Session->setFlash(__('Offer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
