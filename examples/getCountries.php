<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

/*
GetCountries REQUEST has no options that can be set. Just call the function without a request
*/

$response = $fan->GetCountries();

/*
Functions in GetCountries RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of Country objects
->getCountry($countryname) 		// returns the Country object with the specified name (or false if $position not found)
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The Country object has the following functions:
->getId()
->getName()
->getCode()
->getShipping()
->hasAirShipping()
->hasLandShipping()
*/