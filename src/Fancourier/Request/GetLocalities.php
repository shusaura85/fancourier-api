<?php

namespace Fancourier\Request;

use Fancourier\Response\GetLocalities as GetLocalitiesResponse;


class GetLocalities extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/localities';
    protected $method = 'GET';

    private $county = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetLocalitiesResponse();
    }

    public function pack()
    {
        $arr = [];
        if($this->county != '')
        {
            $arr['county'] = $this->county;
        }
        return $arr;
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
}
