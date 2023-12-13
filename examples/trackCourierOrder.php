<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\TrackCourierOrder();
$request
	->addOrder('18650990')
    ->setLanguage('ro');

/*
Functions in TrackCourierOrder REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->addOrder($orderId)
->setOrder($orderId)	// alias for addOrder
->resetOrders()			// clear added orders
->setLanguage($language)			// "ro", "en"
*/
	
$response = $fan->trackCourierOrder($request);

/*
Functions in TrackCourierOrder RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of CourierOrderTracker objects
->getOrder($orderId) 	// returns the CourierOrderTracker object with the specified id (or false if not found)
*/

if ($response->isOk()) {
    print_r($response->getData());
    echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
	echo '<hr />';
	$order = $response->getOrder('18650990');
	echo "Status: ".$order->getStatus()['date'].": ".$order->getStatus()['name'].'<br />';
} else {
    var_dump($response->getErrorMessage());
}

/*
The CourierOrderTracker object has the following functions:
->getOrderId()
->getOrderNo()
->getMessage()
->getEvents()
->getStatus()
*/