<?php
App::uses('AppController', 'Controller');
/**
 * PersonalOffers Controller
 *
 * @property PersonalOffer $PersonalOffer
 */
class PersonalOffersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PersonalOffer->recursive = 0;
		$this->set('personalOffers', $this->paginate());
		$this->loadModel('Offer');
		$offers=$this->Offer->find('all');
        $this->loadModel('Regulation');
        $this->loadModel('Item');
        $Items = $this->Item->find('all');
        $Regulations = $this->Regulation->find('all');
        $this->set(compact('Items', 'Regulations','offers'));
	}


		function subscribe($id=null)
{
  $this->loadModel('Regulation');
    $this->loadModel('Transaction');
     $Regulations = $this->Regulation->find('first',array('conditions'=>['Regulation.id'=>$id]));

$periode=$Regulations['Regulation']['period'];
if($periode!='12')
  $message="$periode month";
else
  $message="1 Year";
    $user_id=$this->Session->read('id');
  	$url=$this->Transaction->requestPaypal($Regulations['Regulation']['total_price'],
      "Compte premium $message","action=subscribe&uid=$user_id&duration=$message");
  	if($url)
  		{
  		//	$this->redirect($url);
  			$this->succes($id);
  		}
}
function succes($id)
{
  
  $user_id=$this->Session->read('id');
  $this->loadModel('Regulation');
  $this->loadModel('Historical');
   $this->loadModel('PersonalOffer');
   $this->loadModel('Offer');
  $Regulations = $this->Regulation->find('first',array('conditions'=>['Regulation.id'=>$id]));
  $this->loadModel('Historical'); 
$periode=$Regulations['Regulation']['period'];
  $data=array('period'=>date("Y-m-d")."=>".date("Y-m-d",strtotime('+'.$periode.'month')),
    'rabais'=>'1',
    'regulation_id'=>$id,
    'user_id'=>$user_id);
  $this->Historical->create();
  $this->Historical->save($data);
  $Historical_id=$this->Historical->getLastInsertID();
 $offers=$this->Offer->find('all',array('conditions'=>['Offer.regulation_id'=>$id]));
 foreach ($offers as $offer) {
  $data=['nombre'=>$offer['Offer']['nombre'],
         'price_ligne'=>$offer['Offer']['price_ligne'],
         'historical_id'=>$Historical_id,
         'item_id'=>$offer['Offer']['items_id']
        ];
  $this->PersonalOffer->create();
  $this->PersonalOffer->save($data);
$this->redirect("../");
 }
}

}
