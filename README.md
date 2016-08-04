PHPDivideIQ
===========

[![Latest Stable Version](https://poser.pugx.org/dividebv/phpdivideiq/v/stable)](https://packagist.org/packages/dividebv/phpdivideiq)
[![Total Downloads](https://poser.pugx.org/dividebv/phpdivideiq/downloads)](https://packagist.org/packages/dividebv/phpdivideiq)
[![Latest Unstable Version](https://poser.pugx.org/dividebv/phpdivideiq/v/unstable)](https://packagist.org/packages/dividebv/phpdivideiq)
[![License](https://poser.pugx.org/dividebv/phpdivideiq/license)](https://packagist.org/packages/dividebv/phpdivideiq)

A PHP library to connect to [Divide.IQ](http://www.divide.nl).

Installation
============

## Composer

`composer require dividebv/phpdivideiq`

Example Usage
=============

```php
use DivideBV\PHPDivideIQ\DivideIQ;

$username = 'user';          // You will receive this from the provider.
$password = 'password';      // You will receive this from the provider.
$environment = 'production'; // May also be `staging` or an arbitrary URL.

// A file storing the connection status.
$file = new SplFileObject('persist.iq.txt', 'c+');

if ($file->getSize()) {
    // The file already exists, instantiate DivideIQ using the file.
    $divideIq = DivideIQ::fromFile($file);
} else {
    // File doesn't exist. Instantiate DivideIQ using the constructor.
    $divideIq = new DivideIQ($username, $password, $environment);
    $divideIq->setFile($file);
}

// Access a resource provided by this Divide.IQ server.
$result = $divideIq->request('stockbase_stock');
```

Example Usage orderRequest POST
===============================
```php
use DivideBV\PHPDivideIQ\DivideIQ;
use DivideBV\PHPDivideIQ\Models;
 

$person = new Models\Person(); // Requires surname of customer.
$address = new Models\Address(); // Requires Street, StreetNumber, Zipcode, City and CountryCode in ISO3 format. (NLD)
$orderDelivery = new Models\OrderDelivery(); // Holds Person and Address to deliver.
$orderLine1 = new Models\Orderline(); // Holds EAN, Amount, and Number of the number of orderline (1).
$orderLine2 = new Models\Orderline(); // Holds EAN, Amount, and Number of the number of orderline (2).
$orderHeader = new Models\OrderHeader(); // Holds orderNumber, Timestamp, and additional information.
$orderRequest = new Models\OrderRequest(); // Holds orderHeader, OrderLines, and OrderDelivery
 
$person->setGender('Male');
$person->setInitials('J.');
$person->setFirstName('John');
$person->setSurname('Doe');
$person->setCompany('JohnDoeCompany');
 
$address->setStreet('Examplestreet');
$address->setStreetNumber('33');
$address->setStreetNumberAdditition('b');
$address->setZipcode('1234AB');
$address->setCity('Amsterdam');
$address->setCountryCode('NLD');
 
$orderLine1->setNumber(1); // Line number
$orderLine1->setEan('2000000000003'); // EAN
$orderLine1->setAmount(3); // Amount/Quantity
 
$orderLine2->setNumber(2);
$orderLine2->setEan('2000000000002');
$orderLine2->setAmount(10);
 
$orderHeader->setOrderNumber(40001);
$orderHeader->setAttention("Testorder");
$orderHeader->setTimestamp(new DateTime());
 
$orderDelivery->setPerson($person);
$orderDelivery->setAddress($address);
 
// OrderLines are not implemented to support REST yet
// $orderRequest->addOrderLine($orderLine1);
// $orderRequest->addOrderLine($orderLine2);
 
$orderRequest->setOrderHeader($orderHeader);
$orderRequest->setOrderDelivery($orderDelivery);

 
header('Content-Type: application/json');
 
// Try to do the POST with orderRequest Model.
try {
    $postResponse = $divideIq->request('stockbase_orderrequest', $orderRequest->toArray(), 'POST');
     
    if($postResponse->StatusCode == 1){
        echo 'stockbase orderRequest posted successfully. ' . PHP_EOL . PHP_EOL;
         
        // Will return result object with created Items.
        print_r($postResponse->Items); 
    }
} catch (RequestException $e) {
    echo $e->getRequest() . "\n";
    if ($e->hasResponse()) {
        echo $e->getResponse() . "\n";
    }
}
```
