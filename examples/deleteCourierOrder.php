<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\DeleteCourierOrder();
$request->setOrder('18680725');
/*
Functions in DeleteCourierOrder REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setOrder($orderId = 12345678) // set the order id you want to delete
*/

$response = $fan->deleteCourierOrder($request);

/*
Functions in GetBankTransfers RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
*/

// check if valid response
if ($response->isOk()) {
    var_dump($response->getData());
	// getData() will return true if delete succeded or false if there's an error
} else {
    var_dump($response->getErrorMessage());
}