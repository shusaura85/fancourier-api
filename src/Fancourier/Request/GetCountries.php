<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCountries as GetCountriesResponse;

class GetCountries extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/countries';
	protected $method = 'GET';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCountriesResponse();
    }

    public function pack()
    {
		return [];
    }

}
