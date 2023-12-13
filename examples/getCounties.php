<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

/*
GetCounties REQUEST has no options that can be set. Just call the function without a request
*/

$response = $fan->getCounties();

/*
Functions in GetCosts RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// get an array of County objects
->getCounty($county)	// get the County object for the specified county name
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The County object has the following functions:
->getId()
->getName()
*/