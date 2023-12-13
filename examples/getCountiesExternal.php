<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCountiesExternal();
$request
    ->setCountry('Moldova');
/*
Functions in GetCountiesExternal REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setCountry($country) 
*/
	
$response = $fan->getCountiesExternal($request);

/*
Functions in GetCountiesExternal RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of CountyExternal objects
->getKmCost()
->getWeightCost()
->getInsuranceCost()
->getOptionsCost()
->getFuelCost()
->getCost()
->getCostVat()
->getCostTotal()
*/



if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The CountyExternal object has the following functions:
->getId()
->getName()
->getCode()
->getCountry()
*/