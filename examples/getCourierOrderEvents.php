<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCourierOrderEvents();
$request
    ->setLanguage('ro');
/*
Functions in GetCourierOrderEvents REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setLanguage($lang)	the language for the returned event strings. "ro" or "en"
*/
	
$response = $fan->getCourierOrderEvents($request);

/*
Functions in GetCourierOrderEvents RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of CourierOrderEvent objects
->getEvent($courierEventId) 			// returns the CourierOrderEvent object with the specified id (or false if not found)
*/


if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The CourierOrderEvent object has the following functions:
->getId()
->getName()
*/