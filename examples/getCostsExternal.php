<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCostsExternal();
$request
    ->setParcels(1)
    ->setWeight(1)
	->setWidth(10)
	->setHeight(5)
	->setLength(10)
    ->setSenderCounty('Arad')
    ->setSenderCity('Aciuta')
    ->setCountry('Moldova');
/*
Functions in GetCostsExternal REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setDeliveryMode($deliveryMode)		the delivery method to use. The available options for each destionation can be found with the GetCountries() api. Can be "rutier" or "aerian" depending on destination country
->setDocumentType($documentType)		can be "document" or "non document"
->setSenderCity($city)
->setSenderCounty($county)
->setCountry($country)
->setEnvelopes($envelopes)
->setParcels($parcels)
->setWeight($weight)
->setLength($length)
->setWidth($width)
->setHeight($height)
->setDeclaredValue($value)
->setOptions($options)
->setService($service)
*/

$response = $fan->getCostsExternal($request);

/*
Functions in GetCostsExternal RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAllErrors() 	// if there are errors in the request, they can be read here
->getKmCost()
->getWeightCost()
->getInsuranceCost()
->getOptionsCost()
->getFuelCost()
->getCost()
->getCostVat()
->getCostTotal()
*/

if ($response->isOk()) {
    var_dump($response->getData());
	echo '<hr />';
	echo "extraKmCost: ". $response->getKmCost();	echo '<br />';
	echo "weightCost: ". $response->getWeightCost();	echo '<br />';
	echo "insuranceCost: ". $response->getInsuranceCost();	echo '<br />';
	echo "optionsCost: ". $response->getOptionsCost();	echo '<br />';
	echo "fuelCost: ". $response->getFuelCost();	echo '<br />';
	echo "costNoVAT: ". $response->getCost();	echo '<br />';
	echo "vat: ". $response->getCostVat(); echo '<br />';
	echo "total: ".$response->getCostTotal();	echo '<br />';
} else {
    var_dump($response->getErrorMessage());
	print_r($response->getAllErrors());
}

/*
There is no dedicated object for this request type
*/