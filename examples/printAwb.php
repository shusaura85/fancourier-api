<?php
// initialize examples instance and autoloader
require __DIR__.'/_init.php';

// create a new request object
$request = new Fancourier\Request\PrintAwb();
$request
//    ->setPdf(false)
//    ->setZpl(true)
//    ->setDpi(203)
    ->setSize('A5')
    ->addAwb('2326300120204');
/*
Functions in PrintAwb REQUEST (only the set* functions are shown, the get* functions simply return the set values)
->addAwb($awb)				// add an AWB number to print
->setAwb($awb)				// alias for addAwb()
->setPdf($wantPdf)			// set this as true if you want to get a PDF for printing instead of HTML. Will automatically disable ZPL option if active
->setZpl($wantZpl)			// set this as true if you want to get a Zebra Programming Language (ZPL) file for use on label printers. Will automatically disable PDF option if active
->setDpi($dpivalue)			// Use this to specify the DPI value (dots per inch) you need for your label printer. Default not set. Set to -1 to disable if previously set
->setLang($language)		// "ro" or "en". The language to use for the generated AWB

Note that you can't enable PDF and ZPL at the same time
*/

$response = $fan->PrintAwb($request);

/*
Functions in PrintAwb RESPONSE (only get* functions are available)
->getData() 		// returns the HTML/PDF file contents
*/

if ($response->isOk()) {
    echo($response->getData());
} else {
    var_dump($response->getErrorMessage());
	print_r($response->getAllErrors());
}

/*
There is no dedicated object for PrintAwb()
*/