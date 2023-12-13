<?php

namespace Fancourier\Request;

use Fancourier\Response\DeleteAwb as DeleteAwbResponse;

class DeleteAwb extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'awb';
	protected $method = 'DELETE';

    private $awb;

    public function __construct()
    {
        parent::__construct();
        $this->response = new DeleteAwbResponse();
    }

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
			'awb'		=> $this->awb
			];
		
		return $arr;
    }

    /**
     * @return mixed
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @param mixed $awb
     * @return DeleteAwb
     */
    public function setAwb($awb)
    {
        $this->awb = $awb;
        return $this;
    }
}
