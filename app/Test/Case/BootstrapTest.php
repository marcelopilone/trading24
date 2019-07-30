<?php

class BootstrapTest extends CakeTestCase {

	public function testCalcularPorcentaje(){

		$porcentaje = calcularPorcentaje( $precioCompra = 2,$precioBittrex=4 );

		$this->assertEquals( 100,$porcentaje );

		$porcentaje = calcularPorcentaje( $precioCompra = 2,$precioBittrex=3 );

		$this->assertEquals( 50,$porcentaje );

		$porcentaje = calcularPorcentaje( $precioCompra = 2,$precioBittrex=1 );

		$this->assertFalse( $porcentaje );

		$porcentaje = calcularPorcentaje( $precioCompra = 2,$precioBittrex=1,$menorMayor=true );

		$this->assertEquals( -50,$porcentaje );

		$porcentaje = calcularPorcentaje( $precioCompra = 110,$precioBittrex=110.75,$menorMayor=true );

		$this->assertFalse( $porcentaje );

		$porcentaje = calcularPorcentaje( $precioCompra = 110,$precioBittrex=105,$menorMayor=true );

		$this->assertEquals( -4.5454545454545467,$porcentaje );



	}


}