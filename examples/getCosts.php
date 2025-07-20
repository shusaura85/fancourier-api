<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCosts();
$request
    ->setParcels(1)
    ->setWeight(1)
    ->setCounty('Arad')
    ->setCity('Aciuta')
    ->setDeclaredValue(125);
/*
Functions in GetCosts REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setPaymentType($paymentType) 
->setCity($city)
->setCounty($county)
->setSenderCity($city)
->setSenderCounty($county)
->setEnvelopes($envelopes)
->setParcels($parcels)
->setWeight($weight)
->setLength($length)
->setWidth($width)
->setHeight($height)
->setDeclaredValue($value)
->addOption($option)	// add a single option
->resetOptions()		// clear set options
->setOptions($options)	// set all options as a single string, replaces already added options with addOption
->setService($service)
*/

$response = $fan->getCosts($request);

/*
Functions in GetCosts RESPONSE (only get* functions are available)
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