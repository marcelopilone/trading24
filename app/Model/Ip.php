<?php
App::uses('AppModel', 'Model');
/**
 * Ip Model
 *
 */
class Ip extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
