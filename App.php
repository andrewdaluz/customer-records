<?php

class App {

    public $customerFile = 'customers.txt';

    public static function start()
    {
        $createCustomer = function(string $customerJson)
        {
            $customerJson = json_decode($customerJson);
            return (new Customer())->populate($customerJson);
        };

        $app = new App();
        $customers = $app->getLines($app->customerFile, $createCustomer);
        $nearestCustomers = $app->getNearestCutomers($customers);
        /*
        ksort() is used to sort key values as it is user_id values
         */
        ksort($nearestCustomers);
        $app->showCustomers($nearestCustomers);
    }

    public function getLines(string $filename, $function = null)
    {
        $file = fopen($filename, 'r');
        if ($file === false) {
            throw new Exception("Unable to read file");
        }

        $lines = [];

        /**
         * string with ontent of each line read from file
         * @var string $lineContent
         */
        while($lineContent = fgets($file)) {
            $lines[] = $function ? $function($lineContent) : $lineContent;
        }

        fclose($file);
        return $lines;
    }

    public function getNearestCutomers($customers)
    {
        $customersNearest = [];
        foreach ($customers as $customer) {
            if ($customer->isNear(100,'53.339428', '-6.257664')) {
                $customersNearest[$customer->getUserId()] = $customer;
            }
        }

        return $customersNearest;
    }

    public function showCustomers($customers)
    {
        foreach ($customers as $customer) {
            echo $customer->getUserId(), ' - ', $customer->getName(), "<br />\n";
        }
    }
}
