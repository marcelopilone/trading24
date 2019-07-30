<?php

class AllTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All model tests');
        //$path = App::pluginPath('app');
        $suite->addTestDirectoryRecursive(  'Test' . DS .'Case');
        return $suite;
    }
}