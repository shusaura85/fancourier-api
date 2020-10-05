# FANCourier API

## Table of contents
- <a href="#installation">Installation</a>
    - <a href="#composer">Requirements</a>
    - <a href="#composer">Composer</a>
    - <a href="#laravel">Laravel</a>
- <a href="#usage">Usage</a>
    - <a href="#authentication">Authentication</a>
    - <a href="#get-estimated-shipping-cost">Get estimated shipping cost</a>
    - <a href="#create-awb">Create AWB</a>
    - <a href="#create-awb-in-bulk">Create AWB in bulk</a>
    - <a href="#track-awb">Track AWB</a>
    - <a href="#print-awb">Print AWB</a>
    - <a href="#print-awb-html">Print AWB Html</a>
    - <a href="#delete-awb">Delete AWB</a>
    - <a href="#track-awb-in-bulk">Track awb in bulk</a>
    - <a href="#get-cities">Get cities</a>
- <a href="#contributing">Contributing</a>
- <a href="#license">License</a>

## Installation
### Requirements

* PHP >= 7.0

### Composer
Require the package via composer
```bash
composer require shusaura85/fancourier-api
```

### Manual
If used without composer, you will need to manually require the `autoload.php` file
```php
require_once '/path/to/fancourier-api/src/autoload.php';
```

## Usage
### Authentication
Create a new instance of `Fancourier.php` supplying the `client_id`, `username` and `password`.
```php
$clientId = 'your_client_id';
$username = 'your_username';
$password = 'your_password';

$fan = new Fancourier\Fancourier($clientId, $username, $password);
```

Or you can use the test instance static method:
```php
$fan = Fancourier\Fancourier::testInstance();
```

### Get estimated shipping cost
Request
```php
$request = new Fancourier\Request\GetRates();
$request
    ->setParcels(1)
    ->setWeight(2)
    ->setRegion('Arad')
    ->setCity('Aciuta')
    ->setDeclaredValue(125);
```
Response
```php
$response = $fan->getRates($request);
if ($response->isOk()) {
    var_dump($response->getBody());
} else {
    var_dump($response->getErrorMessage());
}
```

### Create AWB
Request
```php
$request = new Fancourier\Request\CreateAwb();
$request
    ->setParcels(1)
    ->setWeight(2)
    ->setReimbursement(125)
    ->setDeclaredValue(125)
    ->setNotes('testing notes')
    ->setContents('SKU-1, SKU-2')
    ->setRecipient("John Ivy")
    ->setPhone('0723000000')
    ->setRegion('Arad')
    ->setCity('Aciuta')
    ->setStreet('Str Lunga nr 1');
```
Response
```php
$response = $fan->createAwb($request);
if ($response->isOk()) {
    var_dump($response->getBody());
} else {
    var_dump($response->getErrorMessage());
}
```

### Create AWB in bulk
Request
```php
$request = new Fancourier\Request\CreateAwbBulk();
$request
    ->setParcels(1)
    ->setWeight(2)
    ->setReimbursement(125)
    ->setDeclaredValue(125)
    ->setNotes('testing notes')
    ->setContents('SKU-1, SKU-2')
    ->setRecipient("John Ivy")
    ->setPhone('0723000000')
    ->setRegion('Arad')
    ->setCity('Aciuta')
    ->setStreet('Str Lunga nr 1')
    ->save()
    // next awb
    ->setParcels(1)
    ->setWeight(2)
    ->setReimbursement(100)
    ->setDeclaredValue(100)
    ->setNotes('other testing notes')
    ->setContents('SKU-4, SKU-5')
    ->setRecipient("John Smith")
    ->setPhone('0722000000')
    ->setRegion('Bucuresti')
    ->setCity('Bucuresti')
    ->setStreet('Str Aviatorilor nr 1')
    ->save();
```
Response
```php
$response = $fan->createAwbBulk($request);
if ($response->isOk()) {
    foreach ($response->getBody() as $awb) {
        if ($awb['error']) {
            echo $awb['message'];
        }
        else {
            echo $awb['line'].' '.$awb['awb'];
        }
} else {
    var_dump($response->getErrorMessage());
}
```

### Track AWB
Request
```php
$request = new Fancourier\Request\TrackAwb();
$request
    ->setAwb('2150900120086')
    ->setDisplayMode(Fancourier\Request\TrackAwb::MODE_LAST_STATUS);
```
Response
```php
$response = $fan->trackAwb($request);
if ($response->isOk()) {
    var_dump($response->getBody());
} else {
    var_dump($response->getErrorMessage());
}
```

### Print AWB
Request
```php
$request = new Fancourier\Request\PrintAwb();
$request->setAwb('2150900120086');
```
Response
```php
$response = $fan->printAwb($request);
if ($response->isOk()) {
    echo $response->getBody();
} else {
    var_dump($response->getErrorMessage());
}
```

### Print AWB Html
Request
```php
$request = new Fancourier\Request\PrintAwbHtml();
$request->setAwb('2150900120086');
```
Response
```php
$response = $fan->printAwbHtml($request);
if ($response->isOk()) {
    echo $response->getBody();
} else {
    var_dump($response->getErrorMessage());
}
```

### Delete AWB
Request
```php
$request = new Fancourier\Request\DeleteAwb();
$request->setAwb('2150900120086');
```
Response
```php
$response = $fan->deleteAwb($request);
if ($response->isOk()) {
    var_dump($response->getBody());
} else {
    var_dump($response->getErrorMessage());
}
```

### Track awb in bulk
Request
```php
$request = new Fancourier\Request\TrackAwbBulk();
$request->setAwbs(['2162900120047']);
```
Response
```php
$response = $fan->trackAwbBulk($request);
if ($response->isOk()) {
    print_r($response->getBody());
} else {
    var_dump("ERROR: " . $response->getErrorMessage());
}
```

### Get cities
Request - There's no request for this method

Response - will return an array of cities (and other info)
```php
$response = $fan->getCities();
if ($response->isOk()) {
    print_r($response->getBody());
} else {
    var_dump("ERROR: " . $response->getErrorMessage());
}
```

## Original library

This library is base on [firewizard/fancourier-api](https://github.com/firewizard/fancourier-api).

## Contributing

Thank you for considering contributing to the Fancourier Api!

## License

Fancourier Api is open-source software licensed under the [MIT license](./LICENSE).



