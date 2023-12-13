<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCities as GetCitiesResponse;

class GetCities extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/localities';
	protected $method = 'GET';
	
    protected $county = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCitiesResponse();
    }

    public function pack()
    {
		$arr = [];
		if ($this->county != '')
			{
			$arr['county'] = $this->county;
			}
		
		return $arr;
    }

    /**
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param string $county
     * @return GetCities
     */
    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }

}
