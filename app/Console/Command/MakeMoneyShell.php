<?php

App::uses('AppShell', 'Console/Command');

class MakeMoneyShell extends AppShell {

	public $uses = array(
		'Movimiento',
	);


    public function main() {
        /*Estos datos los tiene que tomar de base de datos*/
            $cantInicial = 100;

            $operacionParaGuardar = 'https://bittrex.com/api/v1.1/public/getmarketsummary?market=usdt-neo';

            $json = file_get_contents($operacionParaGuardar);
            $cur  = json_decode($json);
            $c    = get_object_vars($cur);
        /**/
        $cantMovimientos = $this->Movimiento->find('count');
        debug($this->args);
        if( empty( $cantMovimientos ) ){
                $this->out('<success>Iniciando el proceso de compra . . .</success>');

                return $this->comprar( $c,$cantInicial );
        }

        $calcularPorcentajeGanado = $this->calcularPorcentajeGanado( $this->args );
        
        if( $calcularPorcentajeGanado == false && $cantMovimientos != 0 ){
            $this->empezarOperaciones( $c );
        }        
    	

    }

    public function empezarOperaciones( $c ){
        $this->out('<info>Empezando las operaciones</info>');

        $cantCompraVenta = $this->Movimiento->find('count',array(
            'conditions' => array(
                'Movimiento.compra_o_venta' => false,
            )            
        ));
        
        if( !empty( $cantMovimientos ) && empty( $cantCompraVenta ) ){
            return $this->analizarComprarSiNo( $c );
        }

        $this->out('<info>Ya se hizo una compra, voy a analizar si se gano plata o no ..</info>');

        $this->seGanoPlataSiNo( $c );


    }

    
    public function vender( $c,$seGano,$movimientoParaAnalizar ){
    	
		$cantFinal = $c['result'][0]->Last * $movimientoParaAnalizar['Movimiento']['cant_monedas'];
		$guardarMovimientoVenta = array(
			'Movimiento' => array(
				'id' => $movimientoParaAnalizar['Movimiento']['id'],
				'precio_venta' => $c['result'][0]->Last,
				'porcentaje' => $seGano,
				'cantidad_final' => $cantFinal,
				'compra_o_venta' => true,
			),
		);

		return $this->Movimiento->save( $guardarMovimientoVenta );

    }

    public function comprar( $c,$cantInicialFinal ){

    	$guardarMovimiento = array(
			'Movimiento' => array(
				'moneda_de_intercambio' => $c['result'][0]->MarketName,
				'precio_compra'         => $c['result'][0]->Last,
				'cantidad_inicial'      => $cantInicialFinal,
				'cant_monedas'          => $cantInicialFinal / $c['result'][0]->Last,
			)
		);

    	return $this->Movimiento->save( $guardarMovimiento );

    }

    public function analizarComprarSiNo( $c ){
        
        $ultimoMovimiento = $this->Movimiento->find('first',array(
            'limit' => 1,
            'order' => array(
                'Movimiento.id DESC'
            )
        ));
        $seCompraSiNo = calcularPorcentaje( $ultimoMovimiento['Movimiento']['precio_venta'],$precioBittrex = $c['result'][0]->Last,$menorMayor = true );

        $finalizacionDeAnalisis = false;
        $this->out('<success>Si no aparece un cartel abajo es porque no compro ...</success>');
        if( !empty( $seCompraSiNo ) ){
            $this->out('<success>Va a comprar porque bajo de precio ...</success>');
            $finalizacionDeAnalisis = $this->comprar( $c,$ultimoMovimiento['Movimiento']['cantidad_final'] );
        }

        return $finalizacionDeAnalisis;



    }



    public function seGanoPlataSiNo( $c ){
         $movimientoParaAnalizar = $this->Movimiento->find('first',array(
                    'recursive' => -1,
                    'limit' => 1,
                    'conditions' => array(
                        'Movimiento.compra_o_venta' => false
                    ),
                ));
        $precioCompra = $movimientoParaAnalizar['Movimiento']['precio_compra'];
        $precioBittrex = $c['result'][0]->Last;

        $seGano = calcularPorcentaje( $precioCompra,$precioBittrex );

        if( !empty( $seGano ) ){
            $this->vender( $c,$seGano,$movimientoParaAnalizar );

            $this->out('<success>****************Se vendio************************</success>');

        }else{
            $this->out('<info>Se compro por: '.$precioCompra.' y el precio actual es: '.$precioBittrex.'</info>');
            $this->out('<info>Todavia no hubo ganancia</info>');
        }

    }

    /**
    * $args array
    * return true|false    
    */

    public function calcularPorcentajeGanado( $args ){

        $porcentajeGanado = false;
        $sumaDeTodosLosMovimientos = $this->Movimiento->find('all',array(
            'recursive' => -1,
            'fields' => array(
                'sum(porcentaje) as porcentajeGanado'
            ),
            'conditions' => array(
                'Movimiento.precio_venta is not null'
            )
        ));
        $sumaDeTodosLosMovimientos = Hash::extract($sumaDeTodosLosMovimientos, '{n}.{n}.{s}');
        if( $args[0] >= $sumaDeTodosLosMovimientos[0] && !empty( $sumaDeTodosLosMovimientos[0] ) ){
            $this->out('<info>Ya se gano lo suficiente, volvelo a configurar</info>');
            $porcentajeGanado = true;
        }

        return $porcentajeGanado;


    }


}