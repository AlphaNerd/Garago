<?php
App::uses('AppController', 'Controller');
/**
 * Composants Controller
 *
 * @property Composant $Composant
 */
class ComposantsController extends AppController {

	public function index($liste=null) {
APP::import('Model','Sector');
$this->Sector = new Sector;
APP::import('Model','Category');
$this->Category = new Category;
APP::import('Model','Customer');
$this->Customer = new Customer;
APP::import('Model','Language');
$this->Language = new Language;
APP::import('Model','ComponentCategory');
$this->ComponentCategory = new ComponentCategory;
APP::import('Model','ComponentCustomer');
$this->ComponentCustomer = new ComponentCustomer;
APP::import('Model','TypeComponent');
$this->TypeComponent = new TypeComponent;
$this->loadModel('ComponentLanguage');
$this->loadModel('ComponentSector');
$Sectors = $this->Sector->find('all');
$Categorys = $this->Category->find('all');
$Customers = $this->Customer->find('all');
$Languges = $this->Language->find('all');
$TypeComponents = $this->TypeComponent->find('all');
$this->set(compact('Sectors', 'Categorys', 'Customers', 'Languges','TypeComponents'));
      if($liste){
      $index=explode(',-,',$liste);
      if(count($index)==8)
      {
      	$composant_language_ids=explode(',',$index[4]);
      $composant_Sector_ids=explode(',', $index[5]);
      $composant_customrs_ids=explode(',', $index[6]);
      $composant_category_ids=explode(',', $index[7]);
			$data=array('id'=>$index[0],
				'titre'=>$index[1],
				'description'=>$index[2],
				'type_id'=>$index[3]);
			$this->Composant->save($data);

        		$this->ComponentCategory->deleteAll(array('ComponentCategory.component_id'=>$index[0]));
		$this->ComponentCustome->deleteAll(array('ComponentCustome.component_id'=>$index[0]));
        $this->ComponentSector->deleteAll(array('ComponentSector.component_id'=>$index[0]));
        $this->ComponentLanguage->deleteAll(array('ComponentLanguage.component_id'=>$index[0]));
		
			foreach ($composant_category_ids as $value) {
    $data=array('component_id'=>$index[0],'category_id'=>$value);
	$this->ComponentCategory->create();
	$this->ComponentCategory->save($data);
		}
			foreach ($composant_language_ids as $value) {
    $data=array('component_id'=>$index[0],'language_id'=>$value);
	$this->ComponentLanguage->create();
	$this->ComponentLanguage->save($data);
		}

			foreach ($composant_Sector_ids as $value) {
    $data=array('component_id'=>$index[0],'sector_id'=>$value);
	$this->ComponentSector->create();
	$this->ComponentSector->save($data);
		}
			foreach ($composant_customrs_ids as $value) {
    $data=array('component_id'=>$index[0],'customer_id'=>$value);
	$this->ComponentCustomer->create();
	$this->ComponentCustomer->save($data);
		}
		
	}else if(count($index)==7)
	{	
		$composant_language_ids=explode(',',$index[3]);
      $composant_Sector_ids=explode(',', $index[4]);
      $composant_customrs_ids=explode(',', $index[5]);
      $composant_category_ids=explode(',', $index[6]);
	$data=array('titre'=>$index[0],
				'description'=>$index[2],
				'type_id'=>$index[1]);
	$this->Composant->create();
	$this->Composant->save($data);
	$composants_id=$this->Composant->getLastInsertID();


for ($i=0; $i <count($composant_category_ids) ; $i++) { 
    $data=array('component_id'=>$composants_id,'category_id'=>$composant_category_ids[$i]);
	$this->ComponentCategory->create();
	if($this->ComponentCategory->save($data))
    	echo $composant_category_ids[$i];
		}
			foreach ($composant_language_ids as $value) {
    $data=array('component_id'=>$composants_id,'language_id'=>$value);
	$this->ComponentLanguage->create();
	$this->ComponentLanguage->save($data);
		}

			foreach ($composant_Sector_ids as $value) {
    $data=array('component_id'=>$composants_id,'sector_id'=>$value);
	$this->ComponentSector->create();
	$this->ComponentSector->save($data);
		}
			foreach ($composant_customrs_ids as $value) {
    $data=array('component_id'=>$composants_id,'customer_id'=>$value);
	$this->ComponentCustomer->create();
	$this->ComponentCustomer->save($data);
		
		}
	}else if(count($index)==1)
	{
		
              $this->Composant->id = $index[0];
             $this->Composant->delete();
		$this->ComponentCategory->deleteAll(array('ComponentCategory.component_id'=>$index[0]));
		$this->ComponentCustome->deleteAll(array('ComponentCustome.component_id'=>$index[0]));
        $this->ComponentSector->deleteAll(array('ComponentSector.component_id'=>$index[0]));
        $this->ComponentLanguage->deleteAll(array('ComponentLanguage.component_id'=>$index[0]));

	}
	}

		$this->Composant->recursive = 0;
		$this->set('composants', $this->paginate());

}
}
