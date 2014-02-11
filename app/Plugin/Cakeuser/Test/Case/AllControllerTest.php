<?php
class AllControllerTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All controller tests');
        $suite->addTestDirectoryRecursive(APP .DS.'Plugin'.DS.'Cakeuser'.DS.'Test'.DS. 'Case'.DS.'Controller');
        return $suite;
    }
}