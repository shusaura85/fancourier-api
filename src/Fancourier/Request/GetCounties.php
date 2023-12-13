<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCounties as GetCountiesResponse;

class GetCounties extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/counties';
	protected $method = 'GET';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCountiesResponse();
    }

    public function pack()
    {
		return [];
    }

}
