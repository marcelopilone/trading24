<?php

class LoadShell extends AppShell {

    public function main() {

        $Currency = ClassRegistry::init('Currency');

        $currencies = $Currency->find('list');
        foreach( $currencies as $c ){
			
        }


    }

}