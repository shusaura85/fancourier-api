<?php

namespace Fancourier\Tests;

use Fancourier\Request\CreateAwb;
use Fancourier\Objects\AWBIntern;
use Fancourier\Request\DeleteAwb;
use Fancourier\Request\PrintAwb;
use Fancourier\Request\TrackAwb;
use PHPUnit\Framework\TestCase;
use Fancourier\Fancourier;
use Fancourier\Request\GetCosts;

class FancourierTest extends TestCase
{

    public $fan;
	public $awbNo;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->fan = Fancourier::testInstance();
    }

    /** @test */
    public function it_can_get_costs()
    {
        $request = new GetCosts();
        $request
            ->setParcels(1)
            ->setWeight(2)
            ->setCounty('Arad')
            ->setCity('Aciuta')
            ->setDeclaredValue(125);

        $response = $this->fan->getCosts($request);

        $this->assertTrue($response->isOk());
        $this->assertIsArray($response->getData());
    }

    /** @test */
    public function it_can_create_an_awb()
    {
        $awb = new \Fancourier\Objects\AwbIntern();
        $awb
            ->setParcels(1)
            ->setWeight(2)
            ->setReimbursement(125)
            ->setDeclaredValue(125)
            ->setSizes(10,5,1) // in cm // or use setLength(), setHeight(), setWidth()
            ->setNotes('testing notes')
            ->setContents('SKU-1, SKU-2')
            ->setRecipientName("John Ivy")
            ->setPhone('0723000000')
            ->setCounty('Arad')
            ->setCity('Aciuta')
            ->setStreet('Str Lunga')
            ->setNumber('1');
            
        $request = new CreateAwb();
        $request->addAwb($awb);

        $response = $this->fan->createAwb($request);

        $this->assertTrue($response->isOk());
		if ($response->isOk()) {
		
		$this->awbNo = $awb->getAwb();
		}
        $this->assertIsArray($response->getData());
        $this->assertIsInt($awb->getAwb());
    }

    /** @test */
    public function it_can_track_an_existing_awb()
    {
        $request = new TrackAwb();
        $request
            ->setAwb('2347300120337');

        $response = $this->fan->trackAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsArray($response->getData());
    }

    /** @test */
    public function it_can_get_a_printable_pdf_awb()
    {
        $request = new PrintAwb();
        $request->setPdf(true)->setAwb('2347300120337');

        $response = $this->fan->printAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getData());
    }

    /** @test */
    public function is_can_get_a_html_version_for_an_awb()
    {
        $request = new PrintAwb();
        $request->setPdf(false)->setAwb('2347300120337');

        $response = $this->fan->printAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getData());
     //   $this->assertStringContainsString('<html>', $response->getData());
    }

    /** @test */
    public function it_can_delete_an_existing_awb()
    {
        $request = new DeleteAwb();
        $request->setAwb('2347300120340');

        $response = $this->fan->deleteAwb($request);

        $this->assertIsBool($response->getData());
    //    $this->assertTrue($response->getData());
    }

    /** @test */
	/*
    public function it_can_track_multiple_aws_in_bulk()
    {
        $request = new TrackAwbBulk();
        $request->setAwbs(['2162900120047']);

        $response = $this->fan->trackAwbBulk($request);

        $this->assertTrue($response->isOk());
        $this->assertIsArray($response->getBody());
        $this->assertCount(1, $response->getBody());
    }
	*/
}
