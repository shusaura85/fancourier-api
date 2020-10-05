<?php

require_once 'app/Mage.php';
Mage::setIsDeveloperMode(true);
Mage::app()->getConfig();

//since magento 1 has its own autoloader, this PSR-4 approach won't work. 
//just include the autoload file and you should be good to go

require_once 'fancourier-api/src/autoload.php';


$fan = Fancourier\Fancourier::testInstance();

//---- get cities list ----
//$response = $fan->getCities();
//if ($response->isOk()) {
//    print_r($response->getBody());
//} else {
//    print_r($response->getErrorMessage());
//}
//die;
// ----

//---- get estimated shipping cost ----
//$request = new Fancourier\Request\GetRates();
//$request
//    ->setParcels(1)
//    ->setWeight(2)
//    ->setRegion('Arad')
//    ->setCity('Aciuta')
//    ->setDeclaredValue(125);
//
//$response = $fan->getRates($request);
//if ($response->isOk()) {
//    var_dump($response->getBody());
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;
// ----

// ---- create awb ----
//$request = new Fancourier\Request\CreateAwb();
//$request
//    ->setParcels(1)
//    ->setWeight(2)
//    ->setReimbursement(125)
//    ->setDeclaredValue(125)
//    ->setNotes('testing notes')
//    ->setContents('SKU-1, SKU-2')
//    ->setRecipient("John Ivy")
//    ->setPhone('0723000000')
//    ->setRegion('Arad')
//    ->setCity('Aciuta')
//    ->setStreet('Str Lunga nr 1')
//    ;
//
//$response = $fan->createAwb($request);
//if ($response->isOk()) {
//    var_dump($response->getBody());
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;

// ---- track awb ----
//$request = new Fancourier\Request\TrackAwb();
//$request
//    ->setAwb('2150900120086')
//    ->setDisplayMode(Fancourier\Request\TrackAwb::MODE_LAST_STATUS)
//    ;
//
//$response = $fan->trackAwb($request);
//if ($response->isOk()) {
//    var_dump($response->getBody());
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;


// ---- print awb ----
//$request = new Fancourier\Request\PrintAwb();
//$request->setAwb('2150900120086');
//
//$response = $fan->printAwb($request);
//if ($response->isOk()) {
//    echo $response->getBody();
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;


// ---- print awb html ----
//$request = new Fancourier\Request\PrintAwbHtml();
//$request->setAwb('2150900120086');
//
//$response = $fan->printAwbHtml($request);
//if ($response->isOk()) {
//    echo $response->getBody();
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;


// ---- delete awb ----
//$request = new Fancourier\Request\DeleteAwb();
//$request->setAwb('2150900120086');
//
//$response = $fan->deleteAwb($request);
//if ($response->isOk()) {
//    var_dump($response->getBody());
//} else {
//    var_dump($response->getErrorMessage());
//}
//die;


// ---- track awb in bulk ----
//$request = new Fancourier\Request\TrackAwbBulk();
//$request->setAwbs(['2162900120047']);
//
//$response = $fan->trackAwbBulk($request);
//if ($response->isOk()) {
//    print_r($response->getBody());
//} else {
//    var_dump("ERROR: " . $response->getErrorMessage());
//}
//die;
