<?php

require_once('Autoloader.php');

class AppTest extends PHPUnit_Framework_TestCase {

    private $app;

    public function setUp()
    {
         $this->app = new App();
    }

    public function testCustomerFileExists()
    {
        $this->assertFileExists('customers.txt');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testNoFileNameAsParameter()
    {
        $this->app->getLines();
    }
}