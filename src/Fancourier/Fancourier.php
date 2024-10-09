<?php

namespace Fancourier;

use Fancourier\Request\RequestInterface;
use Fancourier\Request\CreateAwb;
use Fancourier\Request\CreateAwbExternal;
use Fancourier\Request\DeleteAwb;
use Fancourier\Request\GetServices;
use Fancourier\Request\GetServiceOptions;
use Fancourier\Request\GetCountries;
use Fancourier\Request\GetCounties;
use Fancourier\Request\GetCountiesExternal;
use Fancourier\Request\GetCities;
use Fancourier\Request\GetCitiesExternal;
use Fancourier\Request\GetStreets;
use Fancourier\Request\GetCosts;
use Fancourier\Request\GetCostsExternal;
use Fancourier\Request\GetPudo;
use Fancourier\Request\PrintAwb;

use Fancourier\Request\CreateCourierOrder;
use Fancourier\Request\DeleteCourierOrder;

use Fancourier\Request\GetShippingSlip;
use Fancourier\Request\GetAwbEvents;
use Fancourier\Request\TrackAwb;
use Fancourier\Request\GetBankTransfers;
use Fancourier\Request\GetAwbConfirmations;

use Fancourier\Request\GetCourierOrders;
use Fancourier\Request\GetCourierOrderEvents;
use Fancourier\Request\TrackCourierOrder;

use Fancourier\Request\GetBranches;

class Fancourier
{
    const TEST_CLIENT_ID = 7032158;
    const TEST_USERNAME = 'clienttest';
    const TEST_PASSWORD = 'testing';

    const API_URL			= 'https://api.fancourier.ro/';

    /** @var Auth */
    protected $auth;

    protected $verifyHost = true;
    protected $verifyPeer = true;

    protected $conTimeout = 3;
    protected $timeout = 6;

    public function __construct($clientId, $username, $password, $bearer_token = '')
    {
        $this->auth = new Auth($clientId, $username, $password, $bearer_token);
    }

    /**
     * Use this if you need to skip host/peer verification
     * @param bool $verifyHost
     * @param bool $verifyPeer
     */
    public function setVerify($verifyHost = true, $verifyPeer = true)
    {
        $this->verifyHost = $verifyHost;
        $this->verifyPeer = $verifyPeer;
        $this->auth->setVerify($verifyHost, $verifyPeer);
        return $this;
    }

    /**
     * Use this if you need to set a custom request timeout
     * @param int $conTimeout
     * @param int $timeout
     */
    public function setTimeout($conTimeout = 3, $timeout = 6)
    {
        $this->conTimeout = $conTimeout;
        $this->timeout = $timeout;
        $this->auth->setTimeout($conTimeout, $timeout);
        return $this;
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
     * @param CreateAwbExternal $request
     * @return \Fancourier\Response\CreateAwbExternal
     */
    public function createAwbExternal(CreateAwbExternal $request)
    {
        return $this->send($request);
    }

    /**
     * @param PrintAwb $request
     * @return \Fancourier\Response\PrintAwb
     */
    public function printAwb(PrintAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param DeleteAwb $request
     * @return \Fancourier\Response\DeleteAwb
     */
    public function deleteAwb(DeleteAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetCosts $request
     * @return \Fancourier\Response\GetCosts
     */
    public function getCosts(GetCosts $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetCostsExternal $request
     * @return \Fancourier\Response\GetCostsExternal
     */
    public function getCostsExternal(GetCostsExternal $request)
    {
        return $this->send($request);
    }

//    public function requestCourier(RequestCourier $request)
//    {
//        todo implement return $this->send($request);
//    }

    /**
     * @return \Fancourier\Response\GetServices
     */
    public function getServices()
    {
        return $this->send(new GetServices());
    }

    /**
     * @param GetServiceOptions $request
     * @return \Fancourier\Response\GetServiceOptions
     */
    public function getServiceOptions(GetServiceOptions $request)
    {
        return $this->send($request);
    }

    /**
     * @return \Fancourier\Response\GetCounties
     */
    public function getCounties()
    {
        return $this->send(new GetCounties());
    }

    /**
     * @param GetCities $request
     * @return \Fancourier\Response\GetCities
     */
    public function getCities($request)
    {
        return $this->send($request);
    }

    /**
     * @param GetStreets $request
     * @return \Fancourier\Response\GetStreets
     */
    public function getStreets($request)
    {
        return $this->send($request);
    }

    /**
     * @param GetPudo $request
     * @return \Fancourier\Response\GetPudo
     */
    public function getPudo($request)
    {
        return $this->send($request);
    }

    /**
     * @param GetShippingSlip $request
     * @return \Fancourier\Response\GetShippingSlip
     */
    public function getShippingSlip(GetShippingSlip $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetAwbEvents $request
     * @return \Fancourier\Response\GetAwbEvents
     */
    public function getAwbEvents(GetAwbEvents $request)
    {
        return $this->send($request);
    }

    /**
     * @param TrackAwb $request
     * @return \Fancourier\Response\Generic
     */
    public function trackAwb(TrackAwb $request)
    {
        return $this->send($request);
    }

    /**
     * @return \Fancourier\Response\GetCountries
     */
    public function getCountries()
    {
        return $this->send(new GetCountries());
    }

    /**
     * @param GetCountiesExternal $request
     * @return \Fancourier\Response\GetCountiesExternal
     */
    public function getCountiesExternal(GetCountiesExternal $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetCitiesExternal $request
     * @return \Fancourier\Response\GetCitiesExternal
     */
    public function getCitiesExternal(GetCitiesExternal $request)
    {
        return $this->send($request);
    }

    /**
     * @param CreateCourierOrder $request
     * @return \Fancourier\Response\CreateCourierOrder
     */
    public function createCourierOrder(CreateCourierOrder $request)
    {
        return $this->send($request);
    }

    /**
     * @param DeleteCourierOrder $request
     * @return \Fancourier\Response\DeleteCourierOrder
     */
    public function deleteCourierOrder(DeleteCourierOrder $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetCourierOrders $request
     * @return \Fancourier\Response\GetCourierOrders
     */
    public function getCourierOrders(GetCourierOrders $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetCourierOrderEvents $request
     * @return \Fancourier\Response\GetCourierOrderEvents
     */
    public function getCourierOrderEvents(GetCourierOrderEvents $request)
    {
        return $this->send($request);
    }

    /**
     * @param TrackCourierOrder $request
     * @return \Fancourier\Response\TrackCourierOrder
     */
    public function trackCourierOrder(TrackCourierOrder $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetBankTransfers $request
     * @return \Fancourier\Response\GetBankTransfers
     */
    public function getBankTransfers(GetBankTransfers $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetBranches $request
     * @return \Fancourier\Response\GetBranches
     */
    public function getBranches(GetBranches $request)
    {
        return $this->send($request);
    }

    /**
     * @param GetAwbConfirmations $request
     * @return \Fancourier\Response\GetAwbConfirmations
     */
    public function getAwbConfirmations(GetAwbConfirmations $request)
    {
        return $this->send($request);
    }

    /**
     * @param RequestInterface $request
     * @return \Fancourier\Response\ResponseInterface
     */
    protected function send(RequestInterface $request)
    {
        return $request
            ->authenticate($this->auth)
            ->setVerify($this->verifyHost, $this->verifyPeer)
            ->setTimeout($this->conTimeout, $this->timeout)
            ->send();
    }

    /**
     * @param bool Force token refresh even if token given in constructor
     * @return string|false
     */
    public function getToken(bool $refresh = false)
    {
        return $this->auth->getToken($refresh);
    }

    /**
     * @return string
     */
    public function getTokenExpiresAt()
    {
        return $this->auth->getTokenExpiresAt();
    }

    /**
     * @return string
     */
    public function getTokenMessage()
    {
        return $this->auth->getTokenMessage();
    }

    public static function testInstance($token = '')
    {
        return new self(
            self::TEST_CLIENT_ID,
            self::TEST_USERNAME,
            self::TEST_PASSWORD,
            $token
        );
    }
}
