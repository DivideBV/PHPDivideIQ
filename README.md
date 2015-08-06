PHPDivideIQ
===========
[![Latest Stable Version](https://poser.pugx.org/dividebv/phpdivideiq/v/stable)](https://packagist.org/packages/dividebv/phpdivideiq)
[![Total Downloads](https://poser.pugx.org/dividebv/phpdivideiq/downloads)](https://packagist.org/packages/dividebv/phpdivideiq)
[![Latest Unstable Version](https://poser.pugx.org/dividebv/phpdivideiq/v/unstable)](https://packagist.org/packages/dividebv/phpdivideiq)
[![License](https://poser.pugx.org/dividebv/phpdivideiq/license)](https://packagist.org/packages/dividebv/phpdivideiq)

A PHP library to connect to [Divide.IQ](http://www.divide.nl).

Example Usage
=============

```php
use DivideBV\PHPDivideIQ\PHPDivideIQ;

$username = 'user';          // You will receive this from the provider.
$password = 'password';      // You will receive this from the provider.
$environment = 'production'; // May also be `staging` or an arbitrary URL.

// Create a DivideIQ client.
$client = new DivideIQ($username, $password, $environment);

// Access a resource provided by this Divide.IQ server.
$result = $client->request('stockbase_stock');
```
