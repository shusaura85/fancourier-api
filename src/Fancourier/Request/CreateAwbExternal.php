<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwbExternal as CreateAwbExternalResponse;

use Fancourier\Objects\AwbExtern;

/**
 * Class CreateAwbExternal
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class CreateAwbExternal extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'extern-awb';
	protected $method = 'POST';
	
	protected $awbList = [];

    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateAwbExternalResponse();
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
	
	public function addAwb(AwbExtern $awb)
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
