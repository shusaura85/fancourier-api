# FANCourier API v2.0

## Table of contents
- <a href="#information">Information</a>
- <a href="#installation">Installation</a>
    - <a href="#requirements">Requirements</a>
    - <a href="#composer">Composer</a>
- <a href="#usage">Usage</a>
    - <a href="#authentication">Authentication</a>
    - <a href="#get-estimated-shipping-cost">Get estimated shipping cost</a>
    - <a href="#create-awb">Create AWB</a>
    - <a href="#create-awb-in-bulk">Create AWB in bulk</a>
    - <a href="#track-awb">Track AWB</a>
    - <a href="#track-awb-in-bulk">Track awb in bulk</a>
    - <a href="#fanbox">FANBox</a>
    - <a href="#print-awb">Print AWB</a>
    - <a href="#print-awb-html">Print AWB Html</a>
    - <a href="#delete-awb">Delete AWB</a>
- <a href="#license">License</a>

## Information
This version of the library for FANCourier API v2.0 is not yet finalized. The code works and there are examples for all API requests. 
But there are a lot of data types missing and certain functions may not seem obvious.  
  
All requests have the method `getData()` that returns the unprocessed response of the API. Aditional functions depend on the response object type to return processed data.  

## Installation
### Requirements

* PHP >= 7.0

**NOTE** At the moment it's designed to work with PHP 7.0 and newer.  
However, the plan is to add type and return type declarations for all functions that will push the requirements to PHP 8.1 at the minimum  

### Composer
Require the package via composer
```bash
composer require shusaura85/fancourier-api
```

*NOTE* At the moment, if you use composer, you will receive the old version of the library (version 1.2.1) that works with the old API that will stop working on March 1st 2024.  
If you want to use the new version, download the code and load it manually as specified below  

### Manual
If used without composer, you will need to manually require the `autoload.php` file
```php
require_once '/path/to/fancourier-api/src/autoload.php';
```

## Usage

At the moment complete and proper documentation is not yet available. However, there are examples for every request type you can make.  
Inside them you will also find comments with complete function list for each `request`, `response` and `object`.


### Authentication
Create a new instance of `Fancourier.php` supplying the `client_id`, `username`, `password` and `token`.
```php
$clientId = 'your_client_id';
$username = 'your_username';
$password = 'your_password';
$token = 'load from cache or leave as empty string';

$fan = new Fancourier\Fancourier($clientId, $username, $password, $token);
```
Or you can use the test instance static method:
```php
$fan = Fancourier\Fancourier::testInstance($token);
```

The generated token has a life time of 24 hours and must be refreshed after this period. You can get the generated token using the function:
```
$force_refresh = false;
$token = $fan->getToken($force_refresh);
```
If the specified token is empty when creating the instance, it will be generated automatically on the first request.  


### Get estimated shipping cost
Request
```php
$request = new Fancourier\Request\GetCosts();
$request
    ->setParcels(1)
    ->setWeight(1)
    ->setCounty('Arad')
    ->setCity('Aciuta')
    ->setDeclaredValue(125);
```
Response
```php
if ($response->isOk()) {
    var_dump($response->getData()); // raw data
    // or just the information you want
    echo "extraKmCost: ". $response->getKmCost().'<br />';
    echo "weightCost: ". $response->getWeightCost().'<br />';
    echo "insuranceCost: ". $response->getInsuranceCost().'<br />';
    echo "optionsCost: ". $response->getOptionsCost().'<br />';
    echo "fuelCost: ". $response->getFuelCost().'<br />';
    echo "costNoVAT: ". $response->getCost().'<br />';
    echo "vat: ". $response->getCostVat().'<br />';
    echo "total: ".$response->getCostTotal().'<br />';
} else {
    var_dump($response->getErrorMessage());
    print_r($response->getAllErrors());
}
```

### Create AWB
Request
```php
$awb = new Fancourier\Objects\AwbIntern();
$awb
    ->setService('Cont Colector')
    ->setPaymentType(Fancourier\Request\CreateAwb::TYPE_SENDER)
    ->setParcels(1)
    ->setWeight(1)    // in kg
    ->setCoD(199.99) // suma de incasat
    ->setDeclaredValue(1000)
    ->setSizes(10,5,1) // in cm
    ->setNotes('testing notes')
    ->setContents('SKU-1, SKU-2')
    ->setRecipientName("John Ivy")
    ->setPhone('0723000000')
    ->setCounty('Arad')
    ->setCity('Aciuta')
    ->setStreet('Str Lunga')
    ->setNumber(1)
    ->addOption('S')
    ->addOption('X');

$request = new Fancourier\Request\CreateAwb();
$request->addAwb($awb);

```
Response
```php
$response = $fan->createAwb($request);

if ($response->isOk()) {
    var_dump($response->getData()); // raw data
    // or the AWBIntern objects updated with the response information
    $al = $response->getAll();
    echo "Count: ".count($al)."<br />";
    foreach ($al as $awbr)
        {
        if ($awbr->hasErrors())
            {
            print_r($awbr->getErrors());
            }
        else
            {
            echo "AWB: ".$awbr->getAwb()."<br />";
            }
        }
    
} else {
    var_dump($response->getErrorMessage());
}
```

### Create AWB in bulk

Unlike the previous version, there is no longer a CreateAwbBulk request. Simply create as many AWBIntern objects and add them to the request  
  
Request
```php
$request = new Fancourier\Request\CreateAwb();

// create the first awb
$awb = new Fancourier\Objects\AwbIntern();
$awb
    ->setService('Cont Colector')
    ....
    ->addOption('X');

// add it to the request
$request->addAwb($awb);

// create another awb
$awb = new Fancourier\Objects\AwbIntern();
$awb
    ->setService('Cont Colector')
    ....
    ->addOption('X');

// add it to the request
$request->addAwb($awb);

// create another awb
$awb = new Fancourier\Objects\AwbIntern();
$awb
    ->setService('Cont Colector')
    ....
    ->addOption('X');

// add it to the request
$request->addAwb($awb);

```
Response
```php
$response = $fan->createAwb($request);

if ($response->isOk()) {
    var_dump($response->getData()); // raw data
    // or the AWBIntern objects updated with the response information
    $al = $response->getAll();
    echo "Count: ".count($al)."<br />";
    foreach ($al as $awbr)
        {
        if ($awbr->hasErrors())
            {
            print_r($awbr->getErrors());
            }
        else
            {
            echo "AWB: ".$awbr->getAwb()."<br />";
            }
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
    ->setAwb('2150900120086');
```
Response
```php
$response = $fan->trackAwb($request);

if ($response->isOk()) {
    print_r($response->getData()); // raw data
    print_r($response->getAll()); // array of AwbTracker objects
} else {
    var_dump($response->getErrorMessage());
}
```

### Track awb in bulk

Unlike previous version, you can use the same TrackAwb() object and add as many AWB's as you need to Track  

Request
```php
$request = new Fancourier\Request\TrackAwb();
$request
    ->addAwb('2150900120084')
    ->addAwb('2150900120085')
    ->addAwb('2150900120086');
```
Response
```php
$response = $fan->trackAwb($request);

if ($response->isOk()) {
    print_r($response->getData()); // raw data
    print_r($response->getAll()); // array of AwbTracker objects
} else {
    var_dump($response->getErrorMessage());
}
```

### FANBox

You can now easily get information about available FANBox and PayPoint locations. FAN Courier calls there PUDO (Pick Up Drop Off).  
When creating an AWB for them, set the address to the PUDO address as received here as well as calling the function `setPickupLocation(PUDO_ID)` with the ID of the selected PUDO.  

Request
```php
$request = new Fancourier\Request\GetPudo();
$request
    ->setType(Fancourier\Request\GetPudo::PUDO_FANBOX);
```
Response
```php
$response = $fan->getPudo($request);

if ($response->isOk()) {
    print_r($response->getData()); // raw data
    print_r($response->getAll()); // array of PUDO objects
} else {
    var_dump($response->getErrorMessage());
}
```

### Print AWB

The print request can print one or more AWBs using a single request.  
Please note that unlike the old selfawb API, the new API does not offer a way to manually specify AWB size and it is based only on the options when creating it.

Request
```php
$request = new Fancourier\Request\PrintAwb();
$request
    ->setPdf(true)
    ->setAwb('2150900120086');
```
Response
```php
$response = $fan->printAwb($request);
if ($response->isOk()) {
    echo $response->getData();
} else {
    var_dump($response->getErrorMessage());
    print_r($response->getAllErrors());
}
```

### Print AWB Html

If you want the AWB in a HTML format, just use ->setPdf(false) to get HTML data instead of PDF

Request
```php
$request = new Fancourier\Request\PrintAwb();
$request
    ->setPdf(false)
    ->setAwb('2150900120086');
```
Response
```php
$response = $fan->printAwb($request);
if ($response->isOk()) {
    echo $response->getData();
} else {
    var_dump($response->getErrorMessage());
    print_r($response->getAllErrors());
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
    var_dump($response->getData());
} else {
    var_dump($response->getErrorMessage());
}
```


## License

Fancourier Api is open-source software licensed under the [MIT license](./LICENSE).



