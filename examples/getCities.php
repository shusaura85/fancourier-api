<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCities();
$request
    ->setCounty('Ilfov');
	
/*
Functions in GetCities REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setCounty($county)
*/

$response = $fan->getCities($request);

/*
Functions in GetCities RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of City objects
->getCity($cityname) 		// returns the City object with the specified id (or false if $cityname not found)
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The City object has the following functions:
->getId()
->getName()
->getCounty()
->getAgency()
->getExtKm()
*/