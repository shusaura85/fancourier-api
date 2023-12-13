<?php

namespace Fancourier\Request;

use Fancourier\Response\GetBranches as GetBranchesResponse;

class GetBranches extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/branches';
	protected $method = 'GET';

    private $county = '';
    private $city = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetBranchesResponse();
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
     * @return GetBranches
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
     * @return GetBranches
     */
    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }


}
