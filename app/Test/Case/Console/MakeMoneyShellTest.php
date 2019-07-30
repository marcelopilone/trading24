<?php
App::uses('MakeMoneyShell', 'Console/Command');
App::uses('ConsoleOutput', 'Console');
App::uses('ConsoleInput', 'Console');
App::uses('Shell', 'Console');

/**
 * Currency Test Case
 */
class MakeMoneyShellTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.currency',
		'app.movimiento',
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
		$this->MakeMoneyShell = new MakeMoneyShell;
		$this->Movimiento   = ClassRegistry::init('Movimiento');
	}

/**
 * tearDown method
 *
 * @return void
 */


	public function testAnalizarComprarSiNo(){

		$operacionParaGuardar = 'https://bittrex.com/api/v1.1/public/getmarketsummary?market=usdt-neo';

        $json = file_get_contents($operacionParaGuardar);
		$cur  = json_decode($json);
		$c    = get_object_vars($cur);
		$c['result'][0]->Last = 109.80878345;
		$resultado = $this->MakeMoneyShell->analizarComprarSiNo( $c );

		$this->assertFalse( $resultado );

		$c['result'][0]->Last = 20;
		$resultado = $this->MakeMoneyShell->analizarComprarSiNo( $c );

		$this->assertNotEmpty( $resultado );


	}

	public function testCalcularPorcentajeGanado(){

		$args = array(
			0 => 4,
 		);

		$resultado = $this->MakeMoneyShell->calcularPorcentajeGanado( $args );

		$this->assertFalse( $resultado );

		$args = array(
			0 => 100,
 		);
 		
		$resultado = $this->MakeMoneyShell->calcularPorcentajeGanado( $args );

		$this->assertNotEmpty( $resultado );



	}

	public function testComprar(){

		$operacionParaGuardar = 'https://bittrex.com/api/v1.1/public/getmarketsummary?market=usdt-neo';

        $json = file_get_contents($operacionParaGuardar);
		$cur  = json_decode($json);
		$c    = get_object_vars($cur);

		$cantDeMovimientosAntes = $this->Movimiento->find('count');

		$this->MakeMoneyShell->comprar( $c,$cantInicialFinal=150 );

		$cantDeMovimientosDespues = $this->Movimiento->find('count');		

		$this->assertEquals( $cantDeMovimientosAntes+1,$cantDeMovimientosDespues );


	}

	public function testVender(){

		$operacionParaGuardar = 'https://bittrex.com/api/v1.1/public/getmarketsummary?market=usdt-neo';

        $json = file_get_contents($operacionParaGuardar);
		$cur  = json_decode($json);
		$c    = get_object_vars($cur);

		$cantDeMovimientosAntes = $this->Movimiento->find('count');

		$movimientoParaAnalizar = array(
			'Movimiento' => array(
				'id' => 1,
				'cant_monedas' => 150,
			),
		);

		$this->MakeMoneyShell->vender( $c,$cantInicialFinal=0.25,$movimientoParaAnalizar );

		$movimientoDeVentaGuardado = $this->Movimiento->find('first',array(
			'recursive'  => -1,
			'conditions' => array(
				'Movimiento.id' => 1,
			),
		));

		$this->assertEquals( 0.25,$movimientoDeVentaGuardado['Movimiento']['porcentaje'] );

		$cantDeMovimientosDespues = $this->Movimiento->find('count');		

		$this->assertEquals( $cantDeMovimientosAntes,$cantDeMovimientosDespues );


	}

}
