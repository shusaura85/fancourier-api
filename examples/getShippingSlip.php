<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\GetShippingSlip();
$request
  //  ->setDate( date("Y-m-d") )
    ->setDate( '2023-11-20' )
    ->setPerPage(100);
/*
Functions in GetShippingSlip REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->setDate($date = 'YYYY-mm-dd') // set the day you want the shipping slips (borderouri) for
->setPage($page = 1)			// set the page of results to get
->setPerPage($page = 100)		// how many results per page
*/


$response = $fan->getShippingSlip($request);

/*
Functions in GetShippingSlip RESPONSE (only get* functions are available)
->getData() 		// returns the unprocessed response of the API as an array (available in all response objects)
->getAll() 			// returns an array of ShippingSlip objects
->get($position) 	// returns a ShippingSlip object (or false if $position not found)
->getTotal()		// returns int The total number of ShippingSlips done for that day
->getPerPage()		// how many results per page
->getCurrentPage()	// returns int the current page (should match what page you set in the request with setPage())
->getTotalPages()	// returns int the total page count (computed automatically from total results and perPage values)
*/

if (!$response->isOk())
	{ // show error message if error encountered
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
			
			$response = $fan->getShippingSlip($request);
			}
		else
			{
			break;
			}
		}
	}

/*
The ShippingSlip object has the following functions:
->getAwbNumber()
->getInfo()
->getService()
->getServiceId()
->getWeight()
->getHeight()
->getWidth()
->getLength()
->getPayment()
->getReturnPayment()
->getCoD()
->getDeclaredValue()
->getNotes()
->getContents()
->getEnvelopes()
->getParcels()
->getDateTime()
->getCost()
->getCostCenter()
->getRefund()
->getCurrency()
->getRecipient()
->getSender()
*/