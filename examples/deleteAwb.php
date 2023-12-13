<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\DeleteAwb();
// set the properties
$request->setAwb('2339300120181');
// run the request and get the response
$response = $fan->deleteAwb($request);

// check if valid response
if ($response->isOk()) {
    var_dump($response->getData());
	// getData() will return true if delete succeded or false if there's an error
} else {
    var_dump($response->getErrorMessage());
}