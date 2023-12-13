<?php

namespace Fancourier\Request;

use Fancourier\Response\GetShippingSlip as GetShippingSlipResponse;

class GetShippingSlip extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/awb';
	protected $method = 'GET';

    private $date = '';
    private $page = 0;
    private $perPage = 100;

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetShippingSlipResponse();
		
		$this->date = date("Y-m-d");
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
     * @param mixed $usedate
     * @return GetBankTransfers
     */
    public function setDate($usedate)
    {
        $this->date = $usedate;
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
     * @return GetBankTransfers
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
     * @return GetBankTransfers
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
