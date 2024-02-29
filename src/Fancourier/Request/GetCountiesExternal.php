<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCountiesExternal as GetCountiesExternalResponse;

class GetCountiesExternal extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/external-counties';
	protected $method = 'GET';

    protected $country = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCountiesExternalResponse();
    }

    public function pack()
    {
		$arr = [];
		if ($this->country != '')
			{
			$arr['country'] = $this->country;
			}

		return $arr;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return GetCities
     */
    public function setCountry($county)
    {
        $this->country = $county;
        return $this;
    }

}
