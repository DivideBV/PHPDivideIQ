PHPDivideIQ
===========

A PHP library to connect to [Divide.IQ](http://www.divide.nl).

Example Usage
=============

```php
use DivideBV\PHPDivideIQ\PHPDivideIQ;

$url = 'http://divide.iq.example.com/';
$username = 'user';
$password = 'password';

// Create a DivideIQ client.
$client = new DivideIQ($url, $username, $password);

// Access a resource provided by this Divide.IQ server.
$result = $client->request('stockbase/stock');
```
