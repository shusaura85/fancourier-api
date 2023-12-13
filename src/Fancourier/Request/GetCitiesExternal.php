<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCitiesExternal as GetCitiesExternalResponse;

class GetCitiesExternal extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/external-localities';
	protected $method = 'GET';

    private $country = '';
    private $county = '';
    private $page = 0;
    private $perPage = 100;

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCitiesExternalResponse();
    }

    public function pack()
    {
        $arr = [];
		if ($this->country != '')
			{
			$arr['country'] = $this->country;
			}
		
		if ($this->county != '')
			{
			$arr['county'] = $this->county;
			}
		
		if ($this->page > 0)
			{
			$arr['page'] = $this->page;
			}
		
		if ($this->perPage > 0)
			{
			$arr['perPage'] = $this->perPage;
			}
		
		
		return $arr;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return GetCitiesExternal
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $county
     * @return GetRates
     */
    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }


    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return GetRates
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return GetRates
     */
    public function setPerPage($perPage)
    {
		if ($perPage > 100)
			{	// FAN Courier API limits this to maximum 100 even if the documentation specifies 1000
			$perPage = 100;
			}
        $this->perPage = $perPage;
        return $this;
    }


}
