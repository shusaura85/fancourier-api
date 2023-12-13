<?php

namespace Fancourier\Request;

use Fancourier\Response\DeleteCourierOrder as DeleteCourierOrderResponse;

class DeleteCourierOrder extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'order';
	protected $method = 'DELETE';

    private $orderId;

    public function __construct()
    {
        parent::__construct();
        $this->response = new DeleteCourierOrderResponse();
    }

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
			'id'		=> $this->orderId
			];
		
		return $arr;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     * @return DeleteCourierOrder
     */
    public function setOrder($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
}
