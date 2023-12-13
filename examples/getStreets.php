<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetStreets();
$request
    ->setCity('Braila')
    ->setCounty('Braila')
    ->setPerPage(100);
	
/*
Functions in GetStreets REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setCounty($county)
->setCity($county)
->setPage($page)
->setPerPage($perPage)
*/

	
$response = $fan->getStreets($request);

/*
Functions in GetStreets RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of Street objects
->getTotal() 		// the total number of streets found
->getPerPage() 		// how many items to return per page
->getCurrentPage() 	// the current page number (starts at 1)
->getTotalPages() 	// the total number of pages of results
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
		
		$request
			->setPage( $response->getCurrentPage()+1 );
		
		// if not the last page, request the next page
		if ($response->getCurrentPage() < $response->getTotalPages())
			{
			$request
				->setPage( $response->getCurrentPage()+1 );
			
			$response = $fan->getStreets($request);
			}
		else
			{
			break;
			}
		}
	
	}


/*
The Street object has the following functions:
->getId()
->getName()
->getCounty()
->getAgency()
->getExtKm()
*/