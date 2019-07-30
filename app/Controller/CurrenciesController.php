<?php
App::uses('AppController', 'Controller');
/**
 * Currencies Controller
 *
 * @property Currency $Currency
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class CurrenciesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

	 public $paginate = array(
        'limit' => 100,
        'order' => array(
            'Currency.votes' => 'desc'
        )
    );


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('ranking','add_vote','all_currencies','calculate','simple','table');
        $this->Auth->deny('index');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		//debug( $this->Session->read() );
		$this->Currency->recursive = 0;
		$this->set('currencies', $this->Paginator->paginate());
	}

	public function table() {
		//debug( $this->Session->read() );
		$this->Currency->recursive = 0;

		$this->Paginator->settings = array(
        	'order' => array(
            	'Currency.rank' => 'asc'
        	),
        	'conditions' => array(
        		'Currency.rank >=' => 0,
        		'Currency.rank <=' => 100,
        	),
        	'limit' => 100
    	);
		$countCoins = $this->Currency->find('count');
		$countCoinsGreen = $this->Currency->find('count',array(
			'conditions' => array(
				'Currency.percent_change_24h >=' => 0
			)
		));
		$countCoinsRed = $this->Currency->find('count',array(
			'conditions' => array(
				'Currency.percent_change_24h <' => 0
			)
		));

		$this->set('currencies', $this->Paginator->paginate());
		$this->set('countCoins', $countCoins);
		$this->set('countCoinsGreen', $countCoinsGreen);
		$this->set('countCoinsRed', $countCoinsRed);
	}

	/**
 * index method
 *
 * @return void
 */
	public function ranking() {
		$conditions = array();

		$typeOfListen = '';
		if( !empty( $this->request->query ) ){
			$typeOfListen = 1;
		}
		
		
		$a = rand(1, 8);
		$b = rand(1, 8);

 		$Ip = ClassRegistry::init('Ip');
 
 		$ipNumber = removePoints( $this->request->clientIp() );
 
 		$existIpNumber = $Ip->find('count',array(
 			'conditions' => array(
 				'Ip.number' => $ipNumber
 			)
 		));

 		$mustVoteOrNot = false;
 		if( $existIpNumber >= MAX_OF_IP_FOR_VOTES ){
 			$mustVoteOrNot = true;
 		}

		$currencyName = '';
		if( !empty( $this->request->query['name'] ) ){
			$currencyName = $this->request->query['name'];
		}
		$currencyPrice = '';
		if( !empty( $this->request->query['price_usd'] ) ){
			$currencyPrice = $this->request->query['price_usd'];
		}

		$marketCapVolume = '';
		if( !empty( $this->request->query['market_cap_usd'] ) ){
			$marketCapVolume = $this->request->query['market_cap_usd'];
		}

		$availableSupply = '';
		if( !empty( $this->request->query['available_supply'] ) ){
			$availableSupply = $this->request->query['available_supply'];
		}

		$percent24 = '';
		if( !empty( $this->request->query['percent_change_24h'] ) ){
			$percent24 = $this->request->query['percent_change_24h'];
		}

		$currencyLess = '';
		if( !empty( $this->request->query['menorMayorPrecio'] ) && $this->request->query['menorMayorPrecio'] === 'less'){
			$currencyLess = 1;
			$conditions[] = array(
				'Currency.price_usd <=' => $currencyPrice,
			);
		}

		$currencyHigher = '';
		if( !empty( $this->request->query['menorMayorPrecio'] ) && $this->request->query['menorMayorPrecio'] === 'higher'){
			$currencyHigher = 1;
			$conditions[] = array(
				'Currency.price_usd >=' => $currencyPrice,
			);
		}

		$percentLess = '';
		if( !empty( $this->request->query['menorMayorPrecioPercent'] ) && $this->request->query['menorMayorPrecioPercent'] === 'less'){
			$percentLess = 1;
			$conditions[] = array(
				'Currency.percent_change_24h <=' => $percent24,
			);
		}

		$percentHigher = '';
		if( !empty( $this->request->query['menorMayorPrecioPercent'] ) && $this->request->query['menorMayorPrecioPercent'] === 'higher'){
			$percentHigher = 1;
			$conditions[] = array(
				'Currency.percent_change_24h >=' => $percent24,
			);
		}

		$marketCapLess = '';
		if( !empty( $this->request->query['menorMayorMarketCap'] ) && $this->request->query['menorMayorMarketCap'] === 'less'){
			$marketCapLess = 1;
			$conditions[] = array(
				'Currency.market_cap_usd <=' => $marketCapVolume,
			);
		}

		$marketCapHigher = '';
		if( !empty( $this->request->query['menorMayorMarketCap'] ) && $this->request->query['menorMayorMarketCap'] === 'higher'){
			$marketCapHigher = 1;
			$conditions[] = array(
				'Currency.market_cap_usd >=' => $marketCapVolume,
			);
		}

		$supplyLess = '';
		if( !empty( $this->request->query['menorMayorSupply'] ) && $this->request->query['menorMayorSupply'] === 'less'){
			$supplyLess = 1;
			$conditions[] = array(
				'Currency.available_supply <=' => $availableSupply,
			);
		}

		$supplyHigher = '';
		if( !empty( $this->request->query['menorMayorSupply'] ) && $this->request->query['menorMayorSupply'] === 'higher'){
			$supplyHigher = 1;
			$conditions[] = array(
				'Currency.available_supply >=' => $availableSupply,
			);
		}

		$this->Paginator->settings = array(
        	'conditions' => array(
        		'Currency.name LIKE' => '%'.$currencyName.'%',
        		$conditions
        	),
        	'order' => array(
            	'Currency.rank' => 'asc'
        	),
        	'limit' => 100
    	);
		$currenciesVoice = $this->Currency->find('list',array(
			'conditions' => array(
				'Currency.rank <=' => 100,
				'Currency.percent_change_24h >=' => 20,
			),
			'limit' => 15
		));

		$countCoins = $this->Currency->find('count');
		$countCoinsGreen = $this->Currency->find('count',array(
			'conditions' => array(
				'Currency.percent_change_24h >=' => 0
			)
		));
		$countCoinsRed = $this->Currency->find('count',array(
			'conditions' => array(
				'Currency.percent_change_24h <' => 0
			)
		));

		$this->Currency->recursive = 0;
		$this->set('currencies', $this->Paginator->paginate());
		//$this->set('currenciesAll', $currenciesAll);
		$this->set('currencyName', $currencyName);
		$this->set('currencyPrice', $currencyPrice);
		$this->set('currencyLess', $currencyLess);
		$this->set('currencyHigher', $currencyHigher);
		$this->set('marketCapLess', $marketCapLess);
		$this->set('marketCapHigher', $marketCapHigher);
		$this->set('marketCapVolume', $marketCapVolume);
		$this->set('availableSupply', $availableSupply);
		$this->set('supplyLess', $supplyLess);
		$this->set('supplyHigher', $supplyHigher);
		$this->set('percent24', $percent24);
		$this->set('percentLess', $percentLess);
		$this->set('percentHigher', $percentHigher);
		$this->set('currenciesVoice', $currenciesVoice);
		$this->set('typeOfListen', $typeOfListen);
		$this->set('countCoins', $countCoins);
		$this->set('countCoinsGreen', $countCoinsGreen);
		$this->set('countCoinsRed', $countCoinsRed);
		$this->set('mustVoteOrNot',$mustVoteOrNot);
		$this->set('a',$a);
		$this->set('b',$b);
		$this->set('existIpNumber',$existIpNumber);

		

		
	}


	public function simple() {

		$this->Paginator->settings = array(
        	'order' => array(
            	'Currency.rank ' => 'asc'
        	),
        	'limit' => 100
    	);
		$listSimple = $this->Paginator->paginate();

		$this->set('listSimple', $listSimple);

	}

	public function all_currencies() {

		$this->Paginator->settings = array(
        	'conditions' => array(
        		//'Currency.name LIKE' => '%'.$currencyName.'%',
        	),
        	'order' => array(
            	'Currency.rank' => 'asc'
        	),
        	'limit' => 100
    	);

		$this->Currency->recursive = 0;
		$this->set('currencies', $this->Paginator->paginate());
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Currency->exists($id)) {
			throw new NotFoundException(__('Invalid currency'));
		}
		$options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
		$this->set('currency', $this->Currency->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Currency->create();
			if ($this->Currency->save($this->request->data)) {
				$this->Flash->success(__('The currency has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The currency could not be saved. Please, try again.'));
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
		if (!$this->Currency->exists($id)) {
			throw new NotFoundException(__('Invalid currency'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Currency->save($this->request->data)) {
				$this->Flash->success(__('The currency has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The currency could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
			$this->request->data = $this->Currency->find('first', $options);
		}
	}

	/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function add_vote( ) {
		
		$Ip = ClassRegistry::init('Ip');

		$ipNumber = removePoints( $this->request->clientIp() );

		$existIpNumber = $Ip->find('count',array(
			'conditions' => array(
				'Ip.number' => $ipNumber
			)
		));

		$a = $this->request->data['Currency']['a'];
		$b = $this->request->data['Currency']['b'];
		$result = $a + $b;
		if( $this->request->data['Currency']['captcha'] != $result ){
			$this->Flash->revote(
				'Please insert again the Captcha, is incorrect, thanks.'
			);
			return $this->redirect(array('action' => 'ranking'));
		}


		if( $existIpNumber >= MAX_OF_IP_FOR_VOTES ){
			$this->Flash->revote(
				'You have already vote, you can re-vote, you can vote every 24 hours.'
			);
			return $this->redirect(array('action' => 'ranking'));
		}


		$currencySelect = $this->Currency->find('first',array(
			'conditions' => array(
				'Currency.id' => $this->request->data['Currency']['id']
			)
		));

		$this->request->data['Currency']['votes'] = $currencySelect['Currency']['votes']+1;

		if ($this->request->is(array('post', 'put'))) {

			$ipToSave = array(
				'Ip' => array(
					'number' => $ipNumber,
				)
			);

			if( !( $Ip->save( $ipToSave ) ) ) {
				debug( $Ip->validationErrors );
			}

			if ($this->Currency->save($this->request->data)) {
				$this->Flash->ok(__('The vote has been saved, thanks.'));
				return $this->redirect(array('action' => 'ranking'));
			} else {
				$this->Flash->error(__('The vote could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'ranking'));
			}

		} else {
			$options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
			$this->request->data = $this->Currency->find('first', $options);
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
		$this->Currency->id = $id;
		if (!$this->Currency->exists()) {
			throw new NotFoundException(__('Invalid currency'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Currency->delete()) {
			$this->Flash->success(__('The currency has been deleted.'));
		} else {
			$this->Flash->error(__('The currency could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function calculate(){

		$mount = '';
		if( !empty( $this->request->data['Currency']['mount'] ) ){
			$mount = $this->request->data['Currency']['mount'];
		}

		$times = '';
		if( !empty( $this->request->data['Currency']['times'] ) ){
			$times = $this->request->data['Currency']['times'];
		}

		$percent = '';
		if( !empty( $this->request->data['Currency']['percent'] ) ){
			$percent = $this->request->data['Currency']['percent'];
		}

		$result = $this->Currency->calcularGanancia( $percent,$times,$mount );

		$this->set('mount', $mount);
		$this->set('times', $times);
		$this->set('percent', $percent);
		$this->set('result', $result);

	}

}
