<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

/****************************************
Documentatia specifica ca se pot folosi servicii "Export" si "Export-Cont Colector"
dar in realitate, serverul raspunde cu serviciu invalid in cazul "Export-Cont Colector"
Asadar se poate specifica doar "Export" ca serviciu (cel putin la momentul actual).
Aparent pentru cont colector la export, trebuie setat campul "repayment" (functia ->setCoD(valoare) )
->setCurrency() momentan nu influenteaza in nici un fel requestul. Aparent moneda e setata automat in functie de contul si contractul clientului
*****************************************/


// create a new AWB object
$awb = new Fancourier\Objects\AwbExtern();
$awb
	->setService("Export")		// "Export" sau "Export-Cont Colector"
	->setDeliveryMode('rutier')				// "document" sau "non document"
	->setDocumentType('document')				// "document" sau "non document"
	->setBank('RAIFFEISEN BANK ROMANA')
	->setIban('RO53RZBR0000060009520959')
	->setParcels(1)
	->setWeight(1)	// in kg
	->setReimbursement(199.99)
	->setCurrency('BGN')
	->setDeclaredValue(1000)
	->setSizes(10,5,1) // in cm // or use setLength(), setHeight(), setWidth()
	->setNotes('testing notes')
	->setContents('SKU-1, SKU-2')
	
	->setSenderName("John Ivy")
	->setSenderPhone('0723000000')
	->setSenderCounty('Arad')
	->setSenderCity('Aciuta')
	->setSenderStreet('Str Lunga')
	->setSenderNumber('1')

	->setRecipientName("John Ivy")
	->setPhone('0723000000')
	->setCountry('Bulgaria')
	->setCounty('Sofia')
	->setCity('Sofia')
	->setStreet('ul. Ivan Denkoglu')
	->setNumber('17')
	->setBuilding('B9')
	->setEntrance('69')
	->setFloor('6')
	->setApartment('9')
	->setPostalCode('1000')
	->addOption('S');

// create a new request object
$request = new Fancourier\Request\CreateAwbExternal();
$request->addAwb($awb);

/*
Functions in CreateAwbExternal REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->addAwb(AwbExtern $awb)	// add a new AwbExtern object to the request. You can add as many as you need
->resetAwbs()			// clears the added AwbExtern objects from the request
->setPlatformId($platformId)	// use only if needed and you have a platformId number received from Fan Courier
*/

$response = $fan->createAwbExternal($request);

/*
Functions in CreateAwbExternal RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array with the updated AwbExtern objects
*/

if ($response->isOk()) {
	var_dump($response->getData());
//	file_put_contents('awb_extern.txt', json_encode($response->getData()) );
	
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
			echo "Errors: ".print_r($awbr->getErrors(),1)."<br />";
			echo '<hr />';
			}
		}
	
} else {
	var_dump($response->getErrorMessage());
}

/*
The AwbExtern object is used both in the request as well as in the response (the objects are updated with the response data).
The AwbExtern object has the following functions:

**********************************************************
The following functions can be used before processing the request
**********************************************************
All set* functions here have an equivalent get* function
******

->isValid()		// this function is not yet implemented - validate the awb data before sending it
->setService($service)
->setDeliveryMode($deliveryMode)			// "rutier" / "aerian" depending on destination country (use GetCountries() to get available delivery modes)
->setDocumentType($documentType)			// "document" or "non document"
->setBank($bank)
->setIban($iban)
->setEnvelopes($envelopes)
->setParcels($parcels)
->setWeight($weight)
->setSizes($length_cm, $height_cm, $width_cm)		// shortcut function for setHeight() setLength() and setWidth()
->setHeight($height)
->setLength($length)
->setWidth($width)
->setReimbursement($cod)				// cash on delivery (ramburs)
->setCurrency($currency)	// most likely not used in the api. field is set if you read the awb information, but doesn't appear to do anything when sent
->setDeclaredValue($declaredValue)
->setPaymentType($paymentType)
->setRefund($refund)
->setReturnPayment($reimbursementPaymentType)
->setNotes($notes)
->setContents($contents)
->setCostCenter($costCenter)
->getOptions()					// get the set options (array)
->addOption($option)			// add a option
->resetOptions()				// clear options
->setSenderName($recipient)
->setSenderContactPerson($contactPerson)
->setSenderPhone($phone)
->setSenderAltPhone($phone)
->setSenderEmail($email)
->setSenderCounty($county)
->setSenderCity($city)
->setSenderStreet($street)
->setSenderNumber($number)
->setSenderPostalCode($postalCode)
->setSenderBuilding($building)
->setSenderEntrance($entrance)
->setSenderFloor($floor)
->setSenderApartment($apartment)
->setRecipientName($recipient)
->setContactPerson($contactPerson)
->setPhone($phone)
->setAltPhone($phone)
->setEmail($email)
->setCountry($country)
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
->getAwb()				// returns the AWB number assigned to this AwbExtern object
*/

