<?php

namespace Fancourier\Request;

use Fancourier\Response\GetServiceOptions as GetServiceOptionsResponse;

class GetServiceOptions extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/service-options';
	protected $method = 'GET';

    private $service = 'Standard';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetServiceOptionsResponse();
    }

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
			'service'	=>	$this->service,
			];
		

		return $arr;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     * @return GetServiceOptions
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
}
