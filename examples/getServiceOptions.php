<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetServiceOptions();
$request
    ->setService('fanbox');
	
/*
Functions in GetServiceOptions REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setService($serviceName)
*/

$response = $fan->getServiceOptions($request);

/*
Functions in GetServiceOptions RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of ServiceOption objects
->getOption($optionCode) 		// returns the ServiceOption object with the specified code (or false if not found)
->hasOption($optionCode) 		// returns true if the service option with $optionCode is available for the specified service
*/


if ($response->isOk()) {
    print_r($response->getData());
    var_dump($response->getAll());
} else {
    var_dump($response->getErrorMessage());
}

/*
The ServiceOption object has the following functions:
->getCode()
->getName()
*/