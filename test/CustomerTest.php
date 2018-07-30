<?php

require_once('Autoloader.php');

class CustomerTest extends PhpUnit_Framework_TestCase {

    private $customer;

    public function setUp()
    {
        $this->customer = new Customer();
    }

    /**
    @expectedException InvalidArgumentException
     */
    public function testCustomerPopulateIncompleteAttributes()
    {
        $this->customer->populate(json_decode("{'latitude':'-0.000'}"));
    }

    /**
    @expectedException InvalidArgumentException
     */
    public function testCustomerPopulateNoObjectParameter()
    {
        $this->customer->populate("a string parameter");
    }

    public function testIsNearCustomer()
    {
        /* Customer on Dublin - Ireland*/
        $this->customer->populate(
            json_decode('{"user_id": 1, "name": "Andre", "latitude": "53.339428", "longitude": "-6.257664"}')
        );

        /* Is not 100 KM near from Dublin to Kenmare */
        $this->assertFalse($this->customer->isNear(100,'52.5966787', '-9.0429501'));

        /* Is near 100KM from Dublin to Bray */
        $this->assertTrue($this->customer->isNear(100,'53.1970444', '-6.1308245'));

        /* Is near at same place on customer in Dublin cordinates */
        $this->assertTrue($this->customer->isNear(100,'53.339428', '-6.257664'));
    }
}