<?php 

App::uses('AppShell', 'Console/Command');

class BotMoneyShell extends AppShell {

    public $uses = array(
        'Movimiento',
    );

    public function main() {
    	
    	$valorIndicador = $this->valorIndicador( $tipoIndicador = 'rsi',$exchange = 'binance',$cambio = 'BTCUSDT' );

		$precioMoneda = $this->precioMoneda( $pares = 'BTCUSDT' );

        $ultimaOperacion = $this->dameUltimaOperacion();

        $this->comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion );

    }

    /**
     * [valorIndicador devuelve el valor del indicador segun exchange y tipo de cambio]
     * @param  [string] $tipoIndicador 
     * @param  [string] $exchange      
     * @param  [string] $cambio      
     * @return [array]               
     */
    public function valorIndicador( $tipoIndicador,$exchange,$cambio ){

    	$apiInicial = API_GENERICA.$tipoIndicador.'?secret=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im1kcGlsb25lQGdtYWlsLmNvbSIsImlhdCI6MTU1NzI1ODYwOSwiZXhwIjoxNTg4Nzk0NjA5fQ.7pHDKwkxzC6yul9XUKW8pyAeSo6WDoNwVtRUBFihmCA';

		$apiIndicador = $apiInicial.'&exchange='.$exchange.'&symbol='.$cambio.'&interval=5m';
        $json         = file_get_contents($apiIndicador);
        $cur          = json_decode($json);
        $indicator    = get_object_vars($cur);

        $this->out("<info>El valor del rsi es de:".$indicator['value']."</info>");
        return $indicator;

    }

    /**
     * devuelve el precio de la moneda en binance
     * @param  [string] $pares [description]
     * @return [int]        [description]
     */
    public function precioMoneda( $pares ){

    	$precio = 'https://api.binance.com/api/v1/ticker/price?symbol='.$pares;

    	$json         = file_get_contents($precio);
        $cur          = json_decode($json);
        $p            = get_object_vars($cur);

        return $p['price'];

    }
    /**
     * [comprar_si_o_no description]
     * @param  [array] $valorIndicador [description]
     * @return [type]                 [description]
     */
    public function comprar_si_o_no_rsi( $valorIndicador,$precioMoneda,$ultimaOperacion ){

        $valorIndicador = $valorIndicador['value'];
        //vendo si comparado con el ultimo precio ya bajo un 5%
        if( !empty( $ultimaOperacion ) ){
            $porcentajeDeGanancia = $this->damePorcentajeDeGananciaActual( $ultimaOperacion,$precioMoneda );
            if( $porcentajeDeGanancia ){
                $this->out("<info>Voy a vender porque de mi ultima compra voy abajo un 5% o menos</info>");
                return $this->vender( $valorIndicador,$precioMoneda );
            }
        }

        if( $valorIndicador <= 30 ){
            // comprar si la ultima operacion no es una compra
            if( empty( $ultimaOperacion ) ){
                $this->out("<info>Voy a comprar porque el rsi es menor a 30(primera compra)</info>");
                return $this->comprar( $valorIndicador,$precioMoneda );
            }elseif( $ultimaOperacion['Movimiento']['compra_o_venta'] != TIPO_COMPRA  ){
                // poner stop loss si el ultimo valor del movimiento de compra es un 5% menos esto tiene que interactuar con la api
                // $this->ponerStopLoss();
                $this->out("<info>Voy a comprar porque el rsi es menor a 30</info>");
                return $this->comprar( $valorIndicador,$precioMoneda );
            }
            else{
                return $this->out("<info>El rsi es menor a 30 pero no voy a comprar porque ya hay una compra</info>");
            }
        }
        if( $valorIndicador >= 70 && !empty( $ultimaOperacion ) ){
            if( $ultimaOperacion['Movimiento']['compra_o_venta'] != TIPO_VENTA ){
                $this->out("<info>Voy a vender porque ya obtuve la ganancia que esperaba</info>");
                // vender si la ultima operacion no es una venta
                return $this->vender( $valorIndicador,$precioMoneda );
            }
        }

        $this->out("<info>No es momento ni de comprar ni de vender</info>");

    }

    
    /**
     * retorna true si la perdida fue mayor al 5%
     * @param  [type] $ultimaOperacion [description]
     * @param  [type] $precioMoneda    [description]
     * @return [type]                  [description]
     */
    public function damePorcentajeDeGananciaActual( $ultimaOperacion,$precioMoneda ){

        $porcentaje =  $precioMoneda * 100 /  $ultimaOperacion['Movimiento']['precio_compra'] - 100;

        $ret = false;
        if( $porcentaje <= -5 ){
            $ret = true;
        }

        return $ret;

    }

    /**
     * guarda el movimiento de compra
     * @param  [int] $valorIndicador [description]
     * @param  [int] $precioMoneda   [description]
     * @return [true]                 save
     */
    public function comprar( $valorIndicador,$precioMoneda ){

        $cantInicial = $this->dameCantidadInicial();
        $this->Movimiento->clear();
        $comprar = array(
            'Movimiento' => array(
                'cantidad_inicial' =>  $this->dameCantidadInicial(),
                'cant_monedas' =>  $this->dameCantidadDeMonedas( $cantInicial,$precioMoneda ),
                'precio_compra' => $precioMoneda,
                'moneda_de_intercambio' => 'BTCUSDT',
                'compra_o_venta' => TIPO_COMPRA,
                'rsi' =>  $valorIndicador,
            )
        );


        if( !( $this->Movimiento->save( $comprar ) ) ){
            throw new Exception("Error al guardar");
        }else{
            return true;
        }

    }

    /**
     * Vende la moneda guardando el movimiento
     * @param  [int] $valorIndicador [description]
     * @param  [int] $precioMoneda   [description]
     * @return [true]                 [description]
     */
    public function vender( $valorIndicador,$precioMoneda ){
        $ultimaOperacion = $this->dameUltimaOperacion();

        $cantFinalPorcentaje = $this->dameCantidadFinalConPorcentaje( $this->dameCantidadInicial(),$precioMoneda,$ultimaOperacion );

        $this->Movimiento->clear();
        $vender = array(
            'cantidad_inicial' =>  $this->dameCantidadInicial(),
            'cant_monedas' =>  $ultimaOperacion['Movimiento']['cant_monedas'],
            'precio_compra' => $ultimaOperacion['Movimiento']['precio_compra'],
            'precio_venta' =>  $precioMoneda,
            'moneda_de_intercambio' => 'BTCUSDT',
            'porcentaje' => $cantFinalPorcentaje['porcentaje'],
            'cantidad_final' => $cantFinalPorcentaje['cant_final'],
            'compra_o_venta' => TIPO_VENTA,
            'rsi' =>  $valorIndicador,
        );

        if( !( $this->Movimiento->save( $vender ) ) ){
            throw new Exception("Error al guardar");
        }else{
            return true;
        }        
            
    }

    /**
     * Devuelve la cantidad inicial de la ultima operacion
     * [dameCantidadInicial description]
     * @return [int] [description]
     */
    public function dameCantidadInicial(  ){

        $ultimaOperacion = $this->dameUltimaOperacion();

        $cantInicial = CANTIDAD_INICIAL;
        if( !empty( $ultimaOperacion ) ){
                $cantInicial = $ultimaOperacion['Movimiento']['cantidad_final'];
        }

        return $cantInicial;
    }

    /**
     * [dameCantidadFinalConPorcentaje devuelve el porcentaje de ganancia de la operacion y la cant final del balance]
     * @param  [int] $cantInicial     [description]
     * @param  [int] $precioMoneda    [description]
     * @param  [array] $ultimaOperacion [description]
     * @return [array]                  [description]
     */
    public function dameCantidadFinalConPorcentaje( $cantInicial,$precioMoneda,$ultimaOperacion ){

        $cantFinal = $ultimaOperacion['Movimiento']['cant_monedas'] * $precioMoneda;

        $resultadoFinal = array(
            'porcentaje' => $cantFinal * 100 / $ultimaOperacion['Movimiento']['cantidad_inicial'] - 100,
            'cant_final' => $cantFinal,
        );

        return $resultadoFinal;

    }

    /**
     * Devuelve la cant de monedas segun la cant inicial
     * @param  [int] $cantInicial  [description]
     * @param  [int] $precioMoneda [description]
     * @return int
     */
    public function dameCantidadDeMonedas( $cantInicial,$precioMoneda ){

        return $cantInicial / $precioMoneda;

    }

    /**
     * Devuelve el ultimo movimiento
     * @return [array] [description]
     */
    public function dameUltimaOperacion(){

        $ultimaOperacion = $this->Movimiento->find('first',array(
            'limit' => 1,
            'order' => array(
                'Movimiento.id DESC'
            )
        ));

        return $ultimaOperacion;

    }




}





