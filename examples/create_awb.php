<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new AWB object
$awb = new Fancourier\Objects\AwbIntern();
$awb
	->setService('Cont Colector')
	->setPaymentType(Fancourier\Request\CreateAwb::TYPE_SENDER)				// expeditor		(TYPE_RECIPIENT - destinatar)
	->setParcels(1)
	->setWeight(1)	// in kg
	->setReimbursement(199.99) // suma de incasat
	->setDeclaredValue(1000)
	->setSizes(10,5,1) // in cm // or use setLength(), setHeight(), setWidth()
	->setNotes('testing notes')
	->setContents('SKU-1, SKU-2')
	->setRecipientName("John Ivy")
	->setPhone('0723000000')
	->setCounty('Arad')
	->setCity('Aciuta')
	->setStreet('Str Lunga')
	->setNumber(1)
	->addOption('S')			// livrare sambata
	->addOption('X');			// ePod

// create a new request object
$request = new Fancourier\Request\CreateAwb();
$request->addAwb($awb);

/*
Functions in CreateAwb REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->addAwb(AWBIntern $awb)	// add a new AWBIntern object to the request. You can add as many as you need
->resetAwbs()			// clears the added AWBIntern objects from the request
->setPlatformId($platformId)	// use only if needed and you have a platformId number received from Fan Courier
*/

$response = $fan->createAwb($request);

/*
Functions in GetCities RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array with the updated AwbIntern objects
*/

if ($response->isOk()) {
	var_dump($response->getData());
//	file_put_contents('awb.txt', json_encode($response->getData()) );
	
	$al = $response->getAll();
	echo "Count: ".count($al)."<br />";
	foreach ($al as $awbr)
		{
		if ($awbr->hasErrors())
			{
			print_r($awbr->getErrors());
			}
		else
			{
			echo "AWB: ".$awbr->getAwb()."<br />";
			print_r($awbr->getDetails());
			echo '<hr />';
			}
		}
	
} else {
	var_dump($response->getErrorMessage());
}

/*
The AwbIntern object is used both in the request as well as in the response (the objects are updated with the response data).
The AwbIntern object has the following functions:

**********************************************************
The following functions can be used before processing the request
**********************************************************
All set* functions here have an equivalent get* function
******

->isValid()		// this function is not yet implemented - validate the awb data before sending it
->setService($service)
->setBank($bank)
->setIban($iban)
->setEnvelopes($envelopes)
->setParcels($parcels)
->setWeight($weight)
->setReimbursement($cod)				// cash on delivery (ramburs)
->setCurrency($currency)	// most likely not used in the api. field is set if you read the awb information, but doesn't appear to do anything when sent
->setDeclaredValue($declaredValue)
->setPaymentType($paymentType)		// expeditor/destinatar
->setRefund($refund)				// restituire
->setReturnPayment($reimbursementPaymentType)
->setNotes($notes)
->setContents($contents)
->setSizes($length_cm, $height_cm, $width_cm)		// shortcut function for setHeight() setLength() and setWidth()
->setHeight($height)
->setLength($length)
->setWidth($width)
->setCostCenter($costCenter)
->getOptions()					// get the set options (array)
->addOption($option)			// add a option
->resetOptions()				// clear options
->setRecipientName($recipient)
->setContactPerson($contactPerson)
->setPhone($phone)
->setAltPhone($phone)
->setEmail($email)
->setCounty($county)
->setCity($city)
->setStreet($street)
->setNumber($number)
->setPickupLocation($pudo)		// for PUDO deliveries
->setPostalCode($postalCode)
->setBuilding($building)
->setEntrance($entrance)
->setFloor($floor)
->setApartment($apartment)

**********************************************************
The following functions can be used after processing the response
**********************************************************
->hasErrors()			// if there was a problem creating the awb, this will return true
->getErrors()			// this will return an array wit the problems encountered when creating the awb
->getAwb()				// returns the AWB number assigned to this AWBIntern object
->getDetails()		// returns an array with aditional information
*/

