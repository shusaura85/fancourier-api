<?php

namespace Fancourier\Request;

use Fancourier\Response\GetAwbConfirmations as GetAwbConfirmationsResponse;

/**
 * Class GetAwbConfirmations
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class GetAwbConfirmations extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'reports/get-awb-confirmations';
	protected $method = 'GET';
	
	protected $awbList = [];

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetAwbConfirmationsResponse();
    }

    public function pack()
    {
		$arr = [
				"clientId" => $this->auth->getClientId(), //obligatoriu 
				"awb" => [] // shipments
				
			];
		
		foreach ($this->awbList as $awb)
			{
			$arr['awb'][] = $awb;
			}
		
		return $arr;
	
    }
	
	public function addAwb(string $awb)
	{
		$this->awbList[] = $awb;
		return $this;
	}
	
	public function setAwb(string $awb)
	{
		return $this->addAwb($awb);
	}
	
	
	public function resetAwbs()
	{
		$this->awbList = [];
		return $this;
	}

}
