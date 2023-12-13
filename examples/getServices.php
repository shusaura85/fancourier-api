<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

/*
GetServices REQUEST has no options that can be set. Just call the function without a request
*/

$response = $fan->GetServices();

/*
Functions in GetServices RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// get an array of Service objects
->getService($serviceName)	// get the Service object for the specified service name
->hasService($serviceName)	// returns true if the service name is available
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The Service object has the following functions:
->getId()
->getName()
->getDescription()
*/