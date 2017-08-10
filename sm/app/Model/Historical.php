<?php
App::uses('AppModel', 'Model');
/**
 * Historical Model
 *
 * @property Regulation $Regulation
 * @property User $User
 * @property PersonalOffer $PersonalOffer
 */
class Historical extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Regulation' => array(
			'className' => 'Regulation',
			'foreignKey' => 'regulation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PersonalOffer' => array(
			'className' => 'PersonalOffer',
			'foreignKey' => 'historical_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
