<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\CreateCourierOrder();
$request
	->setOrderType('Standard')		// Standard sau "Express Loco ..."
	
	->setParcels(1)
	->setEnvelopes(1)
	->setWeight(1)	// in kg
	->setSizes(10,5,1) // in cm // or use setLength(), setHeight(), setWidth()
	->setNotes('testing notes')
	
	->setPickupDate(date("Y-m-d", time()+86400))
	->setPickupHours("09:00", "16:30")
/*
	->setRecipientName("John Ivy")
	->setPhone('0723000000')
	->setCounty('Arad')
	->setCity('Aciuta')
	->setStreet('Str Lunga')
	->setNumber(1)
	*/
	;

/*
Functions in CreateCourierOrder REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setAwb($awb)
->setEnvelopes($envelopes)
->setParcels($parcels)
->setWeight($weight)		// weight in kilograms
->setSizes($length_cm, $height_cm, $width_cm)
->setHeight($height)
->setLength($length)
->setWidth($width)
->setOrderType($orderType)	// serviciile "Standard" si "Express Loco ..."
->setPickupDate($date)
->setPickupHours($firstHour, $lastHour)		// there must be a 2 hour difference between the first and second hours
->setNotes($notes)
->setRecipientName($recipient)
->setContactPerson($contactPerson)
->setPhone($phone)
->setAltPhone($phone)
->setEmail($email)
->setCounty($county)
->setCity($city)
->setStreet($street)
->setNumber($number)
->setPostalCode($postalCode)
->setBuilding($building)		// bloc
->setEntrance($entrance)		// scara
->setFloor($floor)		// etaj
->setApartment($apartment)		// apartament
*/


$response = $fan->createCourierOrder($request);

/*
Functions in CreateCourierOrder RESPONSE (only get* functions are available)
->getData() 		// returns the created order id
*/

if ($response->isOk()) {
	var_dump($response->getData());
} else {
	var_dump($response->getErrorMessage());
}

/*
There is no dedicated object for this request
*/