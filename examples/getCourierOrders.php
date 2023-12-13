<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetCourierOrders();
$request
   // ->setDate(date("d-m-Y", time()-100000))
    ->setDate('24-11-2023')
    //->setDate('2023-11-24')
    ->setPerPage(10);
	
/*
Functions in GetCourierOrders REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setDate($date)	// Fan API expects only "dd-mm-YYYY" format in this request, but you can also set "YYYY-mm-dd" and will be converted internally to the expected format
->setPage($page = 1)
->setPerPage($perPage = 10)
*/

$response = $fan->getCourierOrders($request);

/*
Functions in GetCourierOrders RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of CourierOrder objects
->get($id) 			// returns the CourierOrder object with the specified id (or false if $cityname not found)
->getTotal() 		// total number of pages of results (yes, different from the other API's that return the total number of items)
->getPerPage() 		// how many items per page
->getCurrentPage()	// current page of results
->getTotalPages() 	// added as alias for getTotal()
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
		echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
		echo "<hr />";
		
		// if not the last page, request the next page
		if ($response->getCurrentPage() < $response->getTotalPages())
			{
			$request
				->setPage( $response->getCurrentPage()+1 );
			
			$response = $fan->getCourierOrders($request);
			}
		else
			{
			break;
			}
		
		}
	
	echo "Total: ".$response->getTotal()."<br />";
	echo "Page: ".$response->getCurrentPage()."<br />";
	echo "Results per page: ".$response->getPerPage()."<br />";
	echo "Total pages: ".$response->getTotalPages()."<br />";
	echo '<pre>'. print_r($response->getAll(), 1) . '</pre>';
	echo "<hr />";
	
	}

/*
The CourierOrder object has the following functions:
->getId()
->getNumber()
->getStatus()
->getDate()
->getHour()
->getEnvelopes()
->getParcels()
->getWeight()
->getDimensions()
->getHeight()
->getLength()
->getWidth()
->getPickupDate()
->getPickupHours()
->getNotes()
->getType()
->getAwbs()
->getSender()
*/