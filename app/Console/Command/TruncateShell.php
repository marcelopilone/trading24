<?php

class TruncateShell extends AppShell {

    public function main() {

        $Currency = ClassRegistry::init('Currency');

        $Currency->query('truncate ips');

        //$Currency->query("UPDATE currencies SET votes=0 WHERE votes !=0");

    }

}