<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwb as CreateAwbResponse;

use Fancourier\Objects\AwbIntern;

/**
 * Class CreateAwb
 * @package Fancourier\Request
 */
class CreateAwb extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'intern-awb';
	protected $method = 'POST';

	protected $platformId;

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

		if (isset($this->platformId))
			{
			$arr['platformId'] = $this->platformId;
			}

		return $arr;

    }

	public function addAwb(AwbIntern $awb)
	{
		$this->awbList[] = $awb;
		return $this;
	}


	public function resetAwbs()
	{
		$this->awbList = [];
		return $this;
	}

	public function setPlatformId($platformId)
	{
		$this->platformId = $platformId;
		return $this;
	}
}
