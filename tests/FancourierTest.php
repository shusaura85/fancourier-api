<?php

namespace Fancourier\Tests;

use Fancourier\Request\CreateAwb;
use Fancourier\Request\DeleteAwb;
use Fancourier\Request\PrintAwb;
use Fancourier\Request\PrintAwbHtml;
use Fancourier\Request\TrackAwb;
use Fancourier\Request\TrackAwbBulk;
use PHPUnit\Framework\TestCase;
use Fancourier\Fancourier;
use Fancourier\Request\GetRates;

class FancourierTest extends TestCase
{

    public $fan;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->fan = Fancourier::testInstance();
    }

    /** @test */
    public function it_can_get_rates()
    {
        $request = new GetRates();
        $request
            ->setParcels(1)
            ->setWeight(2)
            ->setRegion('Arad')
            ->setCity('Aciuta')
            ->setDeclaredValue(125);

        $response = $this->fan->getRates($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getBody());
    }

    /** @test */
    public function it_can_create_an_awb()
    {
        $request = new CreateAwb();
        $request
            ->setParcels(1)
            ->setWeight(2)
            ->setReimbursement(125)
            ->setDeclaredValue(125)
            ->setNotes('testing notes')
            ->setContents('SKU-1, SKU-2')
            ->setRecipient("John Ivy")
            ->setPhone('0723000000')
            ->setRegion('Arad')
            ->setCity('Aciuta')
            ->setStreet('Str Lunga nr 1');

        $response = $this->fan->createAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getBody());
    }

    /** @test */
    public function it_can_track_an_existing_awb()
    {
        $request = new TrackAwb();
        $request
            ->setAwb('2150900120086')
            ->setDisplayMode(TrackAwb::MODE_LAST_STATUS);

        $response = $this->fan->trackAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getBody());
    }

    /** @test */
    public function it_can_get_a_printable_pdf_awb()
    {
        $request = new PrintAwb();
        $request->setAwb('2150900120086');

        $response = $this->fan->printAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getBody());
    }

    /** @test */
    public function is_can_get_a_html_version_for_an_awb()
    {
        $request = new PrintAwbHtml();
        $request->setAwb('2150900120086');

        $response = $this->fan->printAwbHtml($request);

        $this->assertTrue($response->isOk());
        $this->assertIsString($response->getBody());
        $this->assertStringContainsString('<html>', $response->getBody());
    }

    /** @test */
    public function it_can_delete_an_existing_awb()
    {
        $request = new DeleteAwb();
        $request->setAwb('2150900120086');

        $response = $this->fan->deleteAwb($request);

        $this->assertTrue($response->isOk());
        $this->assertIsBool($response->getBody());
        $this->assertTrue($response->getBody());
    }

    /** @test */
    public function it_can_track_multiple_aws_in_bulk()
    {
        $request = new TrackAwbBulk();
        $request->setAwbs(['2162900120047']);

        $response = $this->fan->trackAwbBulk($request);

        $this->assertTrue($response->isOk());
        $this->assertIsArray($response->getBody());
        $this->assertCount(1, $response->getBody());
    }
}
