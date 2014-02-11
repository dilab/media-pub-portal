<?php
class AllModelTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All model tests');
        $suite->addTestDirectoryRecursive(APP .DS.'Plugin'.DS.'Cakeuser'.DS.'Test'.DS. 'Case'.DS.'Model');
        return $suite;
    }
}