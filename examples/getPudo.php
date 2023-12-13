<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetPudo();
$request
    ->setType(Fancourier\Request\GetPudo::PUDO_FANBOX);	// PUDO_OFFICE / PUDO_PAYPOINT
/*
Functions in GetPudo REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setType($pudoType)		// the type of PUDO to get info about. can be "fanbox", "paypoint", "office"
->setId($pudoId)			// get the information about a single pudo point. If specified, pudoType is ignored
*/

$response = $fan->getPudo($request);

/*
Functions in GetPudo RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of Pudo objects
->get($pudoId = null) 			// returns the requested Pudo object (leave param as null to get the first entry or if using setId on the request, otherwise the id of the pudo point you want)
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
} else {
    var_dump($response->getErrorMessage());
}


/*
The Pudo object has the following functions:
->getId()
->getName()
->getRoutingLocation()
->getDescription()
->getLatitude()
->getLongitude()
->getAddress()
->getSchedule()
->getDrawer()
->getPhones()
->getEmail()
->getArray()
*/