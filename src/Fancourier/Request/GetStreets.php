<?php

namespace Fancourier\Request;

use Fancourier\Response\GetStreets as GetStreetsResponse;

class GetStreets extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/streets';
	protected $method = 'GET';

    private $county = '';
    private $city = '';
    private $page = 0;
    private $perPage = 100;

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetStreetsResponse();
    }

    public function pack()
    {
        $arr = [];
		if ($this->county != '')
			{
			$arr['county'] = $this->county;
			}
		
		if ($this->city != '')
			{
			$arr['locality'] = $this->city;
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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return GetRates
     */
    public function setCity($city)
    {
        $this->city = $city;
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
