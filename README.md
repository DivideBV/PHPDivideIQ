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

Debugging
=========

If you implemented this library like the example above, then the first step in
debugging would be to remove the `persist.iq.txt` file. It's a JSON file with
connection credentials. Removing it will force the library to start afresh by
logging in with your username and password.

Note: this only helps when the connection previously worked.


Orderrequest
============
$this->result = $this->divideIq->request('stockbase_orderrequest', $this->payload, 'POST');

$this->payload = array(
                'OrderDelivery' => (object) $orderDelivery,
                'OrderHeader' => (object) $orderHeader,
                'OrderLines' => $orderLines,
            );
Example
============
$this->payload = {
       "OrderDelivery": {
         "Person": {
         "Gender": "Male",
         "Initials": "J",
         "FirstName": "John",
         "SurnamePrefix": "",
         "Surname": "Doe",
         "Company": "Stockbase",
         "EmailAddress": ""
       },
       "Address": {
         "Street": "Koraalrood",
         "StreetNumber": "33",
         "StreetNumberAddition": "A",
         "ZipCode": "2718SB",
         "City": "Zoetermeer",
         "CountryCode": "NLD"
       }
     },
     "OrderHeader": {
       "OrderNumber": "1574425588",
       "TimeStamp": "2019-11-15T15:56:36.1187035Z"
     },
     "OrderLines": 
     [{
      "Number": "1",
      "EAN": "8700000000001",
      "Amount": "1",
      "Price": "1.95"
     },
     {
      "Number": "2",
      "EAN": "8700000000002",
      "Amount": "1",
      "Price": "2.95"
    },
    {
     "Number": "3",
     "EAN": "8700000000003",
     "Amount": "1",
     "Price": "3.95"
    }]
  }
