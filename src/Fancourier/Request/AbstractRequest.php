<?php

namespace Fancourier\Request;

use Fancourier\Fancourier;
use Fancourier\Auth;
use Fancourier\Client;
use Fancourier\Response\Generic;

abstract class AbstractRequest implements RequestInterface
{
    const TYPE_RECIPIENT = 'destinatar';
    const TYPE_SENDER = 'expeditor';
	
	const PUDO_FANBOX = 'fanbox';
	const PUDO_PAYPOINT = 'paypoint';
	const PUDO_OFFICE = 'office';
	
	
	protected $gateway;
	protected $method;

    /** @var Auth */
    protected $auth;

    /** @var Client */
    protected $client;

    protected $clientOverrides = [
        'verify' => false,
        'timeout' => false
    ];

    /** @var Generic */
    protected $response;

    public function __construct()
    {
        $this->client = new Client();
        $this->response = new Generic();
    }

    public function authenticate(Auth $auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function setVerify($verifyHost = true, $verifyPeer = true)
    {
        if ($this->clientOverrides['verify'] !== true) {
            $this->client->set_verify($verifyHost, $verifyPeer);
            $this->clientOverrides['verify'] = true;
        }

        return $this;
    }

    public function setTimeout($conTimeout = 3, $timeout = 6)
    {
        if ($this->clientOverrides['timeout'] !== true) {
            $this->client->set_timeout($conTimeout, $timeout);
            $this->clientOverrides['timeout'] = true;
        }

        return $this;
    }

    /**
     * @return Generic
     */
    public function send()
    {
        if (empty($this->gateway)) {
            throw new \DomainException("No request gateway implemented");
        }
		
        if (empty($this->method)) {
            throw new \DomainException("No request method implemented");
        }

		$data = $this->pack();
				
		// add authorization token
		$this->client->headers_add('Authorization', 'Bearer '.$this->auth->getToken());
		
		if ($this->method == 'GET')
			{
			$get_params = http_build_query($data, '', '&');
			$responseString = $this->client->get(Fancourier::API_URL . $this->gateway . '?' .$get_params);
			}
		else
		if ($this->method == 'POST')
			{
			$responseString = $this->client->post_json(Fancourier::API_URL . $this->gateway, $data);
			}
		else
		if ($this->method == 'PUT')
			{
			$get_params = http_build_query($data, '', '&');
			$responseString = $this->client->set_put_request(true)->get(Fancourier::API_URL . $this->gateway . '?' .$get_params);
			}
		else
		if ($this->method == 'POSTPUT')
			{
			$responseString = $this->client->set_put_request(true)->post_ma(Fancourier::API_URL . $this->gateway, $data);
			}
		else
		if ($this->method == 'DELETE')
			{
			$get_params = http_build_query($data, '', '&');
			$responseString = $this->client->set_delete_request(true)->get(Fancourier::API_URL . $this->gateway . '?' .$get_params);
			}
		else
		if ($this->method == 'POSTDELETE')
			{
			$responseString = $this->client->set_delete_request(true)->post_ma(Fancourier::API_URL . $this->gateway, $data);
			}

        if (false === $responseString) {
            $this->response->setErrorCode(-1)->setErrorMessage($this->client->get_error());
        } else {
            $this->response->setData($responseString);
        }

        return $this->response;
    }

}
