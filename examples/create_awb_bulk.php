<?php

require __DIR__.'../src/autoload.php';

$fan = Fancourier\Fancourier::testInstance();

// estimate shipping cost

$request = new Fancourier\Request\CreateAwbBulk();
$request
	->setService(Fancourier\Request\CreateAwb::SERVICE_CONT_COLECTOR)
	->setPaymentType(Fancourier\Request\CreateAwb::TYPE_SENDER)
	->setParcels(1)
	->setWeight(1)
	->setReimbursement(199.99)
	->setDeclaredValue(1000)
	->setNotes('testing notes')
	->setContents('SKU-1, SKU-2')
	->setRecipient("John Ivy TEST 1")
	->setPhone('0723000000')
	->setRegion('Arad')
	->setCity('Aciuta')
	->setStreet('Str Lunga nr 1')
	->save()
	// second awb (this will cause an error)
	->setService(Fancourier\Request\CreateAwb::SERVICE_CONT_COLECTOR)
	->setPaymentType(Fancourier\Request\CreateAwb::TYPE_SENDER)
	->setParcels(0)
	->setWeight(0)
	->setReimbursement(199.99)
	->setDeclaredValue(1000)
	->setNotes('testing notes')
	->setContents('SKU-3, SKU-4')
	->setRecipient("John Ivy TEST 2")
//	->setPhone('0723000000')
//	->setRegion('Arad')
//	->setCity('Aciuta')
	->setStreet('Str Lunga nr 1')
	->save()
	// 3rd awb
	->setService(Fancourier\Request\CreateAwb::SERVICE_CONT_COLECTOR)
	->setPaymentType(Fancourier\Request\CreateAwb::TYPE_SENDER)
	->setParcels(1)
	->setWeight(1)
	->setReimbursement(234.99)
	->setDeclaredValue(1000)
	->setNotes('testing notes')
	->setContents('SKU-5, SKU-6')
	->setRecipient("John Ivy TEST 3")
	->setRecipient("John Smith")
	->setPhone('0722000000')
	->setRegion('Bucuresti')
	->setCity('Bucuresti')
	->setStreet('Str Aviatorilor nr 1')
	->save();

// $request->save() can be skipped for the final awb entry (it will be called automatically if new awb data is inserted but not saved)

$response = $fan->createAwbBulk($request);
if ($response->isOk()) {
	var_dump($response->getBody());
} else {
	var_dump($response->getErrorMessage());
}


/*********************************************************
* $response->getBody() will contain the following array
**********************************************************

array(
  1 => 
  array (
    'line' => 1,
    'awb' => '2279000120233',
    'cost' => '75.00',
    'error' => false,
    'message' => NULL,
  ),
  2 => 
  array (
    'line' => 2,
    'awb' => NULL,
    'cost' => NULL,
    'error' => true,
    'message' => 'Probleme la campurile obligatorii',
  ),
  3 => 
  array (
    'line' => 3,
    'awb' => '2279000120234',
    'cost' => '75.00',
    'error' => false,
    'message' => NULL,
  ),
);

*/



// the format of the response is as following. the line number is the same order as the awb data was inserted in the request

/*
array(
	array('line' => 1, 'awb' => 'awb_no', 'error' => false, 'message' => null),
	array('line' => 2, 'awb' => 'awb_no', 'error' => false, 'message' => null),
	array('line' => 3, 'awb' => '', 'error' => true, 'message' => 'error message here'),
	array('line' => 4, 'awb' => 'awb_no', 'error' => false, 'message' => null),
);
*/