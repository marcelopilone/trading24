<?php

class DetectShell extends AppShell {

    public function main() {

        $Currency   = ClassRegistry::init('Currency');

    	$currencies = $Currency->find('all');

		$totalChange24 = array();
		$totalChange1  = array();
    	foreach( $currencies as $c ){

    		$percentChange24 = $c['Currency']['percent_change_24h'];
    		$percentChange1  = $c['Currency']['percent_change_1h'];

    		if( $percentChange24 > 500 ){
    			$totalChange24[] = $c;
    		}
    		if( $percentChange1 > 50 ){
    			$totalChange1[] = $c;
    		}

    	}

    	debug($totalChange1);

    }

}