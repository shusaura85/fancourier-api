<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCourierOrders as GetCourierOrdersResponse;

class GetCourierOrders extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/orders';
	protected $method = 'GET';

    private $date = '';
    private $page = 0;
    private $perPage = 10;

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCourierOrdersResponse();
		
		$this->date = date("d-m-Y");
    }

    public function pack()
    {
        $arr = [
				'clientId' => $this->auth->getClientId(),
				'date' => $this->date,
				];
		
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date Date as string in the dd-mm-YYYY format
	 * 					  Accepts YYYY-mm-dd format as well and will be converted internally to the dd-mm-YYYY format
     * @return GetCourierOrders
     */
    public function setDate($date)
    {
		$parts = explode("-", $date);
		if (strlen($parts[0]) == 4)
			{
			// we have Y-m-d but CourierOrder expects date as d-m-Y  -_-
			$date = $parts[2].'-'.$parts[1].'-'.$parts[0];
			}
        $this->date = $date;
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
