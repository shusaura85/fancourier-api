<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCitiesExternal();
$request
    ->setCountry('Moldova')
    ->setCounty('Basarabeasca')
    ->setPerPage(100);
/*
Functions in GetCitiesExternal REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setCountry($country) 
->setCounty($county)
->setPage($page)
->setPerPage($perPage)
*/
	
$response = $fan->getCitiesExternal($request);
/*
Functions in GetCitiesExternal RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of CityExternal objects
->getTotal()
->getPerPage()
->getCurrentPage()
->getTotalPages()
*/

if (!$response->isOk())
	{
    var_dump($response->getErrorMessage());
	}
else
	{
	// get remaining pages
	while ($response->isOk() && ($response->getCurrentPage() <= $response->getTotalPages()) )
		{
		echo "Total: ".$response->getTotal()."<br />";
		echo "Page: ".$response->getCurrentPage()."<br />";
		echo "Results per page: ".$response->getPerPage()."<br />";
		echo "Total pages: ".$response->getTotalPages()."<br />";
		echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
		echo "<hr />";
		
		
		// if not the last page, request the next page
		if ($response->getCurrentPage() < $response->getTotalPages())
			{
			$request
				->setPage( $response->getCurrentPage()+1 );
			
			$response = $fan->getCitiesExternal($request);
			}
		else
			{
			break;
			}
		}
	
	}


/*
The CityExternal object has the following functions:
->getId()
->getName()
->getCounty()
->getCountry()
*/