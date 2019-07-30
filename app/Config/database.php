<?php
class DATABASE_CONFIG {

        public $default = array(
                 'datasource' => 'Database/Mysql',
                'persistent' => false,
                'host' => '127.0.0.1',
                'login' => 'root',
                'password' => 'marce0684',
                'database' => 'trading_24',
                'prefix' => '',
                'encoding' => 'utf8',
        );

        public $test = array(
                'datasource' => 'Database/Mysql',
                'persistent' => false,
                'host' => 'localhost',
                'login' => 'root',
                'password' => 'marce0684',
                'database' => 'trading_24_test',
                'prefix' => '',
                'encoding' => 'utf8',
        );
        
}