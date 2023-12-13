<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetAwbEvents();
$request
    ->setLanguage('ro');
/*
Functions in GetAwbEvents REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setLanguage($language = 'ro') // the language for the events. Accepted values: ro, en
*/

$response = $fan->getAwbEvents($request);

/*
Functions in GetAwbEvents RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of AwbEvent objects
->getEvent($eventId) 		// returns the AwbEvent object with the specified id (or false if $position not found)
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}

/*
The AwbEvent object has the following functions:
->getId()
->getName()
*/