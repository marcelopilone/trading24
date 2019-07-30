<?php
App::uses('AppModel', 'Model');
/**
 * Currency Model
 *
 */
class Currency extends AppModel {

    public $hasMany = array(
        'CurrenciesHystory' => array(
            'className' => 'CurrenciesHystory',
            'foreignKey' => 'currency_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
		
		'votes' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	  /**
    ** 
    ** @param $porcentaje integer
    ** @param $veces integer
    ** @param $cantInicial integer
    ** @return integer
    **/
    
    public function calcularGanancia( $porcentaje,$veces,$cantInicial ){
       $resultadoSuperFinal = array();
       for ($i = 1; $i <= $veces; $i++) {
            if( $i > 1 ){
                $cantInicial = $cantFinal;
            }

            $cantidadParcial = $cantInicial * $porcentaje / 100;
            $cantFinal       = $cantidadParcial + $cantInicial;
            $resultadoSuperFinal[] = array(
            	'inicial' => money_format ( $cantInicial,2 ),
            	'vez' => $i,
            	'termino' => money_format ( $cantFinal,2 ),
            );
       }
    	
       return $resultadoSuperFinal;
    }

}
