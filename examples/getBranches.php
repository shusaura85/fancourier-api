<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetBranches();
$request
    ->setCity('Braila')
    ->setCounty('Braila');
/*
Functions in GetBranches REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setCity($city) 
->setCounty($county)
*/

/*
* desi documentatia api zice ca se pot specifica optional locality si county,
* specificarea acestora nu pare sa influenteze in nici un fel raspunsul serverului
*/

$response = $fan->getBranches($request);

/*
Functions in GetBranches RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of Branch objects
->get($id) 			// returns the Branch object with the specified id (or false if $position not found)
*/


if ($response->isOk()) {
	echo "Total: ".count($response->getData()['data']);
    echo '<pre>';
	print_r($response->getAll()) ;
	echo "<hr />";
    print_r($response->getData());
	
	echo '</pre>';
} else {
    var_dump($response->getErrorMessage());
}


/*
The Branch object has the following functions:
->getId()
->getName()
->getBank()
->getBankAccount()
->getEmail()
->getPhone()
->getSecondaryPhone()
->getContactPerson()
->getCounty()
->getCity()
->getCountyId()
->getCityId()
->getStreet()
->getStreetNo()
->getPostalCode()
->getBuilding()
->getEntrance()
->getFloor()
->getApartment()
*/