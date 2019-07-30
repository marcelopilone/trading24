<?php
App::uses('BotMoneyShell', 'Console/Command');
App::uses('ConsoleOutput', 'Console');
App::uses('ConsoleInput', 'Console');
App::uses('Shell', 'Console');

/**
 * Currency Test Case
 */
class ImportShellTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.Movimiento',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
        $out = $this->getMock('ConsoleOutput', array(), array(), '', false);
        $in = $this->getMock('ConsoleInput', array(), array(), '', false);
		$this->BotMoney         = new BotMoneyShell;
		$this->Movimiento   = ClassRegistry::init('Movimiento');
	}

/**
 * tearDown method
 *
 * @return void
 */


	public function test__damePorcentajeDeGananciaActual(){

		$ultimaOperacion = array(
			'Movimiento' => array(
				'precio_compra' => 8
			),
		);

		$precioMoneda = 4;

		$ret = $this->BotMoney->damePorcentajeDeGananciaActual( $ultimaOperacion,$precioMoneda );

		$this->assertTrue($ret);

		$ultimaOperacion = array(
			'Movimiento' => array(
				'precio_compra' => 8
			),
		);

		$precioMoneda = 9;

		$ret = $this->BotMoney->damePorcentajeDeGananciaActual( $ultimaOperacion,$precioMoneda );

		$this->assertFalse($ret);

		$ultimaOperacion = array(
			'Movimiento' => array(
				'precio_compra' => 50
			),
		);

		$precioMoneda = 9;

		$ret = $this->BotMoney->damePorcentajeDeGananciaActual( $ultimaOperacion,$precioMoneda );

		$this->assertTrue($ret);

	}

	public function test__comprarOnoRsi(){

		if( !( $this->Movimiento->deleteAll( true) )){
			throw new Exception("Error Processing Request", 1);
		}

		//primer vuelta
		$valorIndicador = array('value'=>20.5);
		$precioMoneda = 8;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );

		// segunda vuelta
		$valorIndicador = array('value'=>70.5);
		$precioMoneda = 8.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );

		// tercer vuelta
		$valorIndicador = array('value'=>50.5);
		$precioMoneda = 8.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );

		// cuarta vuelta
		$valorIndicador = array('value'=>15.5);
		$precioMoneda = 9.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );


		$todosLosMovimientos = $this->Movimiento->find('all',array(
			'recursive' => -1,
		));

		// quinta vuelta
		$valorIndicador = array('value'=>80.5);
		$precioMoneda = 12.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );


		$todosLosMovimientos = $this->Movimiento->find('all',array(
			'recursive' => -1,
		));

		// sexta vuelta
		$valorIndicador = array('value'=>14.5);
		$precioMoneda = 11.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );


		$todosLosMovimientos = $this->Movimiento->find('all',array(
			'recursive' => -1,
		));

		// septima vuelta
		$valorIndicador = array('value'=>90.5);
		$precioMoneda = 4.5;

		$ultimaOperacion = $this->BotMoney->dameUltimaOperacion();

		$this->BotMoney->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );


		$todosLosMovimientos = $this->Movimiento->find('all',array(
			'recursive' => -1,
		));

		debug( $todosLosMovimientos );

	}

	

}

