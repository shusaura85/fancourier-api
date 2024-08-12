<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwbRetur as CreateAwbResponse;

use Fancourier\Object\AwbInternRetur;

/**
 * Class CreateAwbRetur
 * @package Fancourier\Request
 */
class CreateAwbRetur extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'intern-awb';
	protected $method = 'POST';
	
	protected $awbList = [];

    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateAwbResponse();
    }

    public function pack()
    {
		$this->response->setAwbList($this->awbList);
		
		
		$arr = [
				"clientId" => $this->auth->getClientId(), //obligatoriu 
				"shipments" => [] // shipments
			];
		
		foreach ($this->awbList as $awb)
			{
			$arr['shipments'][] = $awb->pack();
			}
		
		return $arr;
	
    }
	
	public function addAwb(AwbInternRetur $awb)
	{
		$this->awbList[] = $awb;
		return $this;
	}
	
	
	public function resetAwbs()
	{
		$this->awbList = [];
		return $this;
	}


}

