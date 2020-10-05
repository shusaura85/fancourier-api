<?php

namespace Fancourier;

use Fancourier\Request\CreateAwb;
use Fancourier\Request\CreateAwbBulk;
use Fancourier\Request\DeleteAwb;
use Fancourier\Request\GetCities;
use Fancourier\Request\GetRates;
use Fancourier\Request\PrintAwb;
use Fancourier\Request\PrintAwbHtml;
use Fancourier\Request\RequestCourier;
use Fancourier\Request\RequestInterface;
use Fancourier\Request\TrackAwb;
use Fancourier\Request\TrackAwbBulk;

class Fancourier
{
    const TEST_CLIENT_ID = '7032158';
    const TEST_USERNAME = 'clienttest';
    const TEST_PASSWORD = 'testing';

    /** @var Auth */
    protected $auth;

    public function __construct($clientId, $username, $password)
    {
        $this->auth = new Auth($clientId, $username, $password);
    }

    /**
     * @param CreateAwb $request
     * @return \Fancourier\Response\CreateAwb
     */
    public function createAwb(CreateAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param CreateAwbBulk $request
     * @return \Fancourier\Response\CreateAwbBulk
     */
    public function createAwbBulk(CreateAwbBulk $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\Generic
     */
    public function printAwb(PrintAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\Generic
     */
    public function printAwbHtml(PrintAwbHtml $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\DeleteAwb
     */
    public function deleteAwb(DeleteAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\Generic
     */
    public function trackAwb(TrackAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\TrackAwbBulk
     */
    public function trackAwbBulk(TrackAwbBulk $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\GetRates
     */
    public function getRates(GetRates $request)
    {
        return $this->send($request);
    }

//    public function requestCourier(RequestCourier $request)
//    {
//        todo implement return $this->send($request);
//    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\GetCities
     */
    public function getCities()
    {
        return $this->send(new GetCities());
    }

    /**
     * @param RequestInterface $request
     * @return \Fancourier\Response\ResponseInterface
     */
    protected function send(RequestInterface $request)
    {
        return $request
            ->authenticate($this->auth)
            ->send();
    }

    public static function testInstance()
    {
        return new self(
            self::TEST_CLIENT_ID,
            self::TEST_USERNAME,
            self::TEST_PASSWORD
        );
    }
}
