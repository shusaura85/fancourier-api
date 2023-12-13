<?php

namespace Fancourier\Request;

use Fancourier\Response\GetServices as GetServicesResponse;

class GetServices extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/services';
	protected $method = 'GET';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetServicesResponse();
    }

    public function pack()
    {
		return [];
    }
}
