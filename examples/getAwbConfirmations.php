<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetAwbConfirmations();
$request
	->addAwb('7000011994717')
	->addAwb('7000012005411');
	
// please note that test awb's will always return error as they are not delivered by fan courier so you will need to test it will actual awb numbers


/*
Functions in GetAwbConfirmations REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->addAwb($awb)
->setAwb($awb)	// alias for addAwb()
->resetAwbs()	// clear currently added awb numbers
*/

$response = $fan->getAwbConfirmations($request);

/*
Functions in GetAwbConfirmations RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getRAWbytes() 	// returns the zip file as a string of bytes (as it comes from the API)
->getLength()	 	// returns the file size of the zip archive (bytes)
->saveToFile($filename)	 	// save the zip file to disc. returns the number of bytes written or false on error. you need to check if the destination file can be written
*/

if ($response->isOk()) {
	echo 'ZIP size in bytes: '.$response->getLength().'<br />';
	if ($response->saveToFile('./example.zip'))
		{
		echo 'Saved to example.zip';
		}
	else
		{
		echo 'Failed saving file';
		}
//    var_dump($response->getRAWbytes());
} else {
    var_dump($response->getErrorMessage());
}

/*
The zip file will contain JPEG images with the name of the AWB it's for. If the AWB has not been delivered/has no confirmation yet, the file for that AWB will not be available.
*/